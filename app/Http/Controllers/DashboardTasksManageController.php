<?php

namespace App\Http\Controllers;

use App\Models\Labels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardTasksManageController extends Controller
{
    public function showTasks(){
        $id=auth()->user()->id;
        $labels= Labels::all()->toArray();
        $labels=array_column($labels,null,'label_num');

        try {
            //find the paragraphs which expert has labelled,bypassed,times_up,modified
            $result=DB::table('classifications')->selectRaw('ANY_VALUE(classifications.doc_id) as doc_id, 
                ANY_VALUE(classifications.paragraph_num) as paragraph_num,
                GROUP_CONCAT(label_num) as label_num,
                ANY_VALUE(allocation_time) as allocation_time,
                ANY_VALUE(labeled_time) as labeled_time,
                ANY_VALUE(status) as status,
                ANY_VALUE(content) as content,
                ANY_VALUE(page) as page,
                ANY_VALUE(case_number) as case_number,
                ANY_VALUE(title) as title,
                ANY_VALUE(date) as date,
                ANY_VALUE(document_link) as document_link')
                ->join('paragraphs', function($join){
                    $join->on('classifications.doc_id', '=', 'paragraphs.doc_id')
                    ->on('classifications.paragraph_num','=', 'paragraphs.paragraph_num');
                })
                ->join('documents', 'paragraphs.doc_id', '=', 'documents.doc_id')
                ->leftJoin('classified_labels', function($join){
                    $join->on('classified_labels.doc_id', '=', 'paragraphs.doc_id')
                    ->on('classified_labels.paragraph_num','=', 'paragraphs.paragraph_num')
                    ->on('classified_labels.e_id','=', 'classifications.e_id');
                })
                ->where('classifications.e_id','=', $id)
                ->where('classifications.status','!=', 'alloted')
                ->groupBy(['classifications.doc_id','classifications.paragraph_num'])
                ->paginate(2);
            
                // dd($result);

            return view("dashboard.tasks.index",[
                'tasks'=> $result,
                'labels'=>$labels
            ]);
        } catch(\Exception $e)
        {
            return back()->with('message','Something bad happened ;)');
        }
    }
}
