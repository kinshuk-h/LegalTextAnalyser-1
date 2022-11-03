<?php

namespace App\Http\Controllers;

use App\Models\Labels;
use App\Models\Experts;
use App\Models\Documents;
use App\Models\Paragraphs;
use Illuminate\Http\Request;
use App\Models\Classifications;
use App\Models\ClassifiedLabels;
use Illuminate\Support\Facades\DB;

class ParagraphController extends Controller
{
    //paragraph allocation view
    public function index(){
        return view("paragraph.index");
    }

    //allocate a paragraph
    public function create(){
        $id=auth()->user()->id;
        $labels= Labels::all();
        DB::select("CALL update_paragraph_labeling_status_procedure()");

        //check if already assigned any paragraph then assign that only else
        $alloted=Classifications::where([ 'e_id'=> $id, 'status'=> 'alloted' ])->first();
        if($alloted!=null){
            return view("paragraph.labelarea",[
                'message'=>
                [   "paragraph"=>Paragraphs::where([ 'doc_id'=> $alloted->doc_id , 'paragraph_num'=> $alloted->paragraph_num ])->first() ,
                    "document"=>Documents::where(['doc_id'=> $alloted->doc_id])->first(),
                    "allocation"=> $alloted
                 ],
                'labels'=> $labels
            ]);
        }

        DB::beginTransaction();

        try {
            //find the non blocked paragraph that expert had not labelled earlier
            $paragraph=Paragraphs::where(['is_blocked'=>0])->
            whereRaw("(doc_id,paragraph_num) NOT IN(Select doc_id,paragraph_num From classifications Where e_id <=> " . $id .")")->get()->first();

            //assign that paragraph to expert
            Classifications::create([
                'e_id' => $id,
                'doc_id' => $paragraph['doc_id'],
                'paragraph_num' => $paragraph['paragraph_num'],
            ]);

            DB::commit();
            return view("paragraph.labelarea",['message'=> 
                [   "paragraph"=> $paragraph ,
                    "document"=>Documents::where(['doc_id'=> $paragraph->doc_id])->first(),
                    "allocation"=> Classifications::where([ 'e_id' => $id,'doc_id' => $paragraph['doc_id'],'paragraph_num' => $paragraph['paragraph_num']])->first()
                ],
                'labels'=> $labels]);
        } catch(\Exception $e)
        {
            DB::rollback();
            return view("paragraph.labelarea",['message'=> 'Something bad happened ;)' , 'labels'=> $labels]);
        }
    }

    //label a paragraph
    public function store(Request $request){
        DB::select("CALL update_paragraph_labeling_status_procedure()");
        
        //check status if times_up then no label else
        $id=auth()->user()->id;
        $alloted=Classifications::where([ 'e_id'=> $id, 'status'=> 'alloted' ])->first();

        //redirect to paragraph
        if($alloted==null){
            return redirect("/paragraph")->with('message','Time Is Up For Labeling.');
        }
        
        //validate input
        $inputs=$request->validate([
            'labels' => 'required|array'
        ]);
        
        DB::beginTransaction();

        try{

            //store the labels
            $labels=$inputs['labels'];
            foreach($labels as $label)
                ClassifiedLabels::create([
                    'e_id' => $alloted->e_id,
                    'doc_id' => $alloted->doc_id,
                    'paragraph_num' => $alloted->paragraph_num,
                    'label_num' => $label,
                ]);

            //update status of paragraph
            Classifications::where([
                'e_id' => $alloted->e_id,
                'doc_id' => $alloted->doc_id,
                'paragraph_num' => $alloted->paragraph_num])->update([
                    'labeled_time' => now('Asia/Kolkata'),
                    'status' => 'labeled']);

            DB::commit();
            return redirect("/paragraph")->with('message','Paragraph is Labeled.');
        } catch(\Exception $e)
        {
            DB::rollback();
            return redirect("/paragraph")->with('message','Something bad happened ;)');
        }
    }
}
