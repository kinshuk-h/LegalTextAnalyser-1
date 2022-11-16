<?php

namespace App\Http\Controllers;

use App\Models\Labels;
use Illuminate\Http\Request;
use App\Models\Classifications;
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
                ->where('title', 'like' ,'%'.$formFields['searchBy'].'%')
                ->orWhere('case_number', 'like' ,'%'.$formFields['searchBy'].'%')
                ->orWhere('content', 'like' ,'%'.$formFields['searchBy'].'%')
                ->groupBy(['classifications.doc_id','classifications.paragraph_num'])
                ->having('status', '!=', 'alloted')
                ->paginate(2);

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
                    ->groupBy(['classifications.doc_id','classifications.paragraph_num'])
                    ->paginate(2);
    
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
                    ->groupBy(['classifications.doc_id','classifications.paragraph_num'])
                    ->having('label_num', 'like' ,'%'.$formFields['filterBy'].'%')
                    ->paginate(2);
    
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
                ->groupBy(['classifications.doc_id','classifications.paragraph_num'])
                ->paginate(2);

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
}
