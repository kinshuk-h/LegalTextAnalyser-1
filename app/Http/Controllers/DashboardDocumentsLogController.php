<?php

namespace App\Http\Controllers;

use App\Helper\Paginators;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardDocumentsLogController extends Controller
{
    public function show(Request $request){
        $docs_count_data=DB::select("select PNo.doc_id,title,PNo.count as PNo,LNo,BNo,TNo from
        (Select p.doc_id,title,count(paragraph_num) as count from paragraphs p join documents d 
        on p.doc_id=d.doc_id group by p.doc_id,title) as PNo 
        join 
        (Select D.doc_id,count(cnt) as LNo from
        documents as D left join (
        Select doc_id,paragraph_num,count(status) as cnt from classifications
        where status in ('labeled','modified')
        group by doc_id,paragraph_num) as C on C.doc_id=D.doc_id
        group by D.doc_id order by D.doc_id) as LNo on PNo.doc_id=LNo.doc_id
        join
        (Select D.doc_id,count(cnt) as BNo from
        documents as D left join (
        Select doc_id,paragraph_num,count(status) as cnt from classifications
        where status in ('bypass')
        group by doc_id,paragraph_num) as C on C.doc_id=D.doc_id
        group by D.doc_id order by D.doc_id) as BNo on BNo.doc_id=LNo.doc_id
        join
        (Select D.doc_id,count(cnt) as TNo from
        documents as D left join (
        Select doc_id,paragraph_num,count(status) as cnt from classifications
        where status in ('timesup')
        group by doc_id,paragraph_num) as C on C.doc_id=D.doc_id
        group by D.doc_id order by D.doc_id) as TNo on TNo.doc_id=LNo.doc_id;");

        $docs_count_data = Paginators::arrayPaginator($docs_count_data, $request);

        return view('dashboard.docs_log.index',[
            'docs_count_data'=>$docs_count_data
        ]);
    }
}
