<?php

namespace App\Http\Controllers;

use App\Models\Labels;
use Illuminate\Http\Request;
use App\Models\Classifications;
use App\Models\ClassifiedLabels;
use Illuminate\Support\Facades\DB;

class DashboardTasksManageController extends Controller
{
    public function showTasksBySearch(Request $request){
        $formFields=$request->validate([
            'searchBy' => 'required|min:1',
        ]);

        $id=auth()->user()->id;
        $labels= Labels::all()->toArray();
        $labels=array_column($labels,null,'label_num');

        try {
            //find the paragraphs which expert has labeled or bypassed or times_up or modified
            $result=Classifications::getClassifiedParagraphsFullDetails()
                ->where('classifications.e_id','=', $id)
                ->where(function($query) use ($formFields)
                {
                    $query->where('title', 'like' ,'%'.$formFields['searchBy'].'%')
                    ->orWhere('case_number', 'like' ,'%'.$formFields['searchBy'].'%')
                    ->orWhere('content', 'like' ,'%'.$formFields['searchBy'].'%');
                })
                ->groupBy(['classifications.doc_id','classifications.paragraph_num'
                ,'allocation_time','labeled_time','status','content','page','case_number',
                'title','date', 'document_link'])
                ->having('status', '!=', 'alloted')
                ->paginate(10)->appends(request()->query());
            
            if($result->isEmpty()){
                return back()->with('message','No data to display,here!!');
            }

            return view("dashboard.tasks.index",[
                'tasks'=> $result,
                'labels'=>$labels,
                'selected'=>''
            ]);
        } catch(\Exception $e)
        {
            return back()->with('message','Something bad happened ;)');
        }
    }

    public function showFilteredTasks(Request $request){
        $id=auth()->user()->id;
        $labels= Labels::all()->toArray();
        $label_nums=array_column($labels, 'label_num');
        $labels=array_column($labels,null,'label_num');

        $formFields=$request->validate([
            'filterBy' => 'required|in:all,labeled,modified,bypass,timesup,'.implode(',',$label_nums),
        ]);
        if(in_array($formFields['filterBy'],array('labeled','modified','bypass','timesup')) ){
            try {
                //find the paragraphs which expert has labeled or bypassed or times_up or modified
                $result=Classifications::getClassifiedParagraphsFullDetails()
                    ->where('classifications.e_id','=', $id)
                    ->where('classifications.status','=', $formFields['filterBy'])
                    ->groupBy(['classifications.doc_id','classifications.paragraph_num'
                    ,'allocation_time','labeled_time','status','content','page','case_number',
                    'title','date', 'document_link'])
                    ->paginate(10)->appends(request()->query());
                    
                if($result->isEmpty()){
                    return back()->with('message','No data to display,here!!');
                }
    
                return view("dashboard.tasks.index",[
                    'tasks'=> $result,
                    'labels'=>$labels,
                    'selected'=>$formFields['filterBy']
                ]);
            } catch(\Exception $e)
            {
                return back()->with('message','Something bad happened ;)');
            }
        }
        else if(in_array($formFields['filterBy'],$label_nums)){
            try {
                //find the paragraphs which expert has labeled as a label_num
                $result=Classifications::getClassifiedParagraphsFullDetails()
                    ->where('classifications.e_id','=', $id)
                    ->groupBy(['classifications.doc_id','classifications.paragraph_num'
                    ,'allocation_time','labeled_time','status','content','page','case_number',
                    'title','date', 'document_link'])
                    ->having('label_num', '=' , $formFields['filterBy'])
                    ->orHaving('label_num', 'like' , $formFields['filterBy'].',%')
                    ->orHaving('label_num', 'like' ,'%,'.$formFields['filterBy'].',%')
                    ->orHaving('label_num', 'like' ,'%,'.$formFields['filterBy'] )
                    ->paginate(10)->appends(request()->query());
                
                if($result->isEmpty()){
                    return back()->with('message','No data to display,here!!');
                }
                return view("dashboard.tasks.index",[
                    'tasks'=> $result,
                    'labels'=>$labels,
                    'selected'=>$formFields['filterBy']
                ]);
            } catch(\Exception $e)
            {
                return back()->with('message','Something bad happened ;)');
            }
        }
        else{
            return redirect('/dashboard/tasks');
        }
    }
    
    public function showAllTasks(){
        $id=auth()->user()->id;
        $labels= Labels::all()->toArray();
        $labels=array_column($labels,null,'label_num');

        try {
            //find the paragraphs which expert has labelled,bypassed,times_up,modified
            $result=Classifications::getClassifiedParagraphsFullDetails()
                ->where('classifications.e_id','=', $id)
                ->where('classifications.status','!=', 'alloted')
                ->groupBy(['classifications.doc_id','classifications.paragraph_num'
                ,'allocation_time','labeled_time','status','content','page','case_number',
                'title','date', 'document_link'])
                ->paginate(10);

            if($result->isEmpty()){
                return back()->with('message','No data to display,here!!');
            }

            return view("dashboard.tasks.index",[
                'tasks'=> $result,
                'labels'=>$labels,
                'selected'=>'all'
            ]);
        } catch(\Exception $e)
        {
            return back()->with('message','Something bad happened ;)');
        }
    }

    public function modifyLabels(Request $request){
        DB::select("CALL update_paragraph_labeling_status_procedure()");
        
        $id=auth()->user()->id;
        //validate input
        $inputs=$request->validate([
            'doc_id' => 'required',
            'paragraph_num' => 'required',
            'labels' => 'required|array'
        ]);

        $alloted=Classifications::where([ 
            'e_id'=> $id,
            'doc_id'=>$inputs['doc_id'],
            'paragraph_num'=>$inputs['paragraph_num']
            ])->whereIn('status' , ['labeled' ,'modified'])->first();

        //redirect to paragraph
        if($alloted==null){
            return back()->with('message','Wrong Inputs for modifying labels.');
        }
        
        DB::beginTransaction();

        try{
            //update status of paragraph
            Classifications::where([
                'e_id' => $alloted->e_id,
                'doc_id' => $alloted->doc_id,
                'paragraph_num' => $alloted->paragraph_num])->update([
                    'status' => 'modified']);
            
            //delete previous labels
            ClassifiedLabels::where([
                'e_id' => $alloted->e_id,
                'doc_id' => $alloted->doc_id,
                'paragraph_num' => $alloted->paragraph_num])->delete();

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
            return back()->with('message','Paragraph Labels are modified.');
        } catch(\Exception $e)
        {
            DB::rollback();
            return back()->with('message','Something bad happened ;)');
        }
    }
}
