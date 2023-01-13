<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Documents;
use App\Models\Paragraphs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Traversable;

class ParagraphSeeder extends Seeder
{
    /** User-Agent string for mimicking browser requests. */
    const USER_AGENT = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36";

    /** Retrieves the contents of a given URL, by issuing an HTTP GET request using cURL. */
    static public function get($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, self::USER_AGENT);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    static function addParagraphs($document_url, $extractor) {
        $docs_data = json_decode(file_get_contents($document_url), true)['data'];

        foreach($docs_data as $doc){
            // If entry data is a merger of metadata of multiple documents, retain the first
            if(is_array($doc['case_number']) or ($doc['case_number'] instanceof Traversable)) {
                $newdoc = [
                    'case_number'   => $doc['case_number'][0],
                    'title'         => $doc['title'][0],
                    'date'          => $doc['date'][0],
                    'document_href' => $doc['document_href'][0],
                    'paragraphs'    => array_key_exists("paragraphs", $doc) ? $doc['paragraphs'] : []
                ];
                $doc = $newdoc;
            }

            $ret=Documents::updateOrCreate(
                ['case_number' => $doc['case_number']],
                [
                    'case_number' => $doc['case_number'],
                    'title' => $doc['title'],
                    'date' => Carbon::createFromFormat('d/m/Y', $doc['date'])->format('Y-m-d'),
                    'document_link' => $doc['document_href']
                ]
            );

            $paragraphs_chunk=[];
            if(!array_key_exists("paragraphs", $doc)) continue;
            $paragraphs=$doc['paragraphs'][$extractor];
            foreach($paragraphs as $para){
                $id=(!is_null($ret['id'])) ? $ret['id'] : $ret['doc_id'];

                $paragraphs_chunk[]= [
                    'paragraph_num' => $para['paragraph_number'],
                    'doc_id' => $id,
                    'content' => $para['content'],
                    'reference' => $para['reference'] ?: 'Unknown',
                    'page' => $para['page'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            foreach(array_chunk($paragraphs_chunk,1000) as $chunk){
                Paragraphs::upsert($chunk, ['paragraph_num','doc_id'],['content','page','reference']);
            }
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = env('DOCUMENTS_DATA_LINK');
        $extractor = env('DOCUMENTS_EXTRACTOR') ?: 'adobe_api';
        $docs_data = json_decode(self::get($url), true);

        foreach($docs_data as $doc){
            self::addParagraphs($doc['download_url'], $extractor);
        }
    }
}
