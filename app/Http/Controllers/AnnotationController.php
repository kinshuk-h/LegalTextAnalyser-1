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

class AnnotationController extends Controller
{
    //paragraph allocation view
    public function annotationIndex(){
        return view("paragraph.index");
    }

    //allocate a paragraph
    public function allocateParagraph(){
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

        try {
            //find the non blocked paragraph that expert had not labelled earlier
            //assign that paragraph to expert
            DB::statement('
            Insert into classifications(e_id,doc_id,paragraph_num)
            Select ? as e_id,doc_id,paragraph_num
            From paragraphs as p
            Where ( Select count(e_id) from classifications as c where c.paragraph_num=p.paragraph_num and c.doc_id=p.doc_id and status not in (\'timesup\',\'bypass\') ) < 5 
            and (doc_id,paragraph_num) NOT IN( Select doc_id,paragraph_num From classifications Where e_id <=> ? ) limit 1;',[$id,$id]);

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
            //If $alloted is null
            throw new \Exception();
        } catch(\Exception $e)
        {
            return redirect("/paragraph")->with('message','Something bad happened ;)');
        }
    }

    //label a paragraph
    public function storeLabels(Request $request){
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
            //update status of paragraph
            Classifications::where([
                'e_id' => $alloted->e_id,
                'doc_id' => $alloted->doc_id,
                'paragraph_num' => $alloted->paragraph_num])->update([
                    'labeled_time' => now('Asia/Kolkata'),
                    'status' => 'labeled']);

            //store the labels
            $labels=$inputs['labels'];
            $entries=[];
            foreach($labels as $label)
                $entries[]=[
                    'e_id' => $alloted->e_id,
                    'doc_id' => $alloted->doc_id,
                    'paragraph_num' => $alloted->paragraph_num,
                    'label_num' => $label,
                ];
            
            ClassifiedLabels::insert($entries);


            DB::commit();
            return redirect("/paragraph")->with('message','Paragraph is Labeled.');
        } catch(\Exception $e)
        {
            DB::rollback();
            return redirect("/paragraph")->with('message','Something bad happened ;)');
        }
    }

    //bypass labeling
    public function bypassParagraph(Request $request){
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
            'bypass' => 'required'
        ]);

        try{
            //update status of paragraph
            Classifications::where([
                'e_id' => $alloted->e_id,
                'doc_id' => $alloted->doc_id,
                'paragraph_num' => $alloted->paragraph_num])->update(['status' => 'bypass']);

            return redirect("/paragraph")->with('message','Paragraph is By passed.');
        } catch(\Exception $e)
        {
            return redirect("/paragraph")->with('message','Something bad happened ;)');
        }
    }
}
