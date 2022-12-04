<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Experts;
use App\Helper\Paginators;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardUsersLogController extends Controller
{
    public function show(Request $request){
        
        $counts_data=DB::select('Select id,is_dormant,name,status,count,Total_Labelling_Time,Average_Labelling_Time,Minimum_Labelling_Time,Maximum_Labelling_Time
        from (
            select e_id,GROUP_CONCAT(status) as status,GROUP_CONCAT(count) as count
            from (SELECT e_id,status,count(*) as count 
            FROM classifications group by e_id,status) as D
            group by e_id ) as CD join (
                SELECT e_id,SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(labeled_time,allocation_time)))) as \'Total_Labelling_Time\',
                SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(labeled_time,allocation_time)))) as \'Average_Labelling_Time\',
                SEC_TO_TIME(MIN(TIME_TO_SEC(TIMEDIFF(labeled_time,allocation_time)))) as \'Minimum_Labelling_Time\',
                SEC_TO_TIME(MAX(TIME_TO_SEC(TIMEDIFF(labeled_time,allocation_time)))) as \'Maximum_Labelling_Time\'
                FROM classifications where status in (\'labeled\',\'modified\') group by e_id
            ) as TD on CD.e_id=TD.e_id right join experts on CD.e_id=id;');

        $counts_data = Paginators::arrayPaginator($counts_data, $request);

        foreach($counts_data as $data){
            
            foreach($data as $key => $value){
                if(is_null($value)) $data->$key=0;
            }

            $obj= [
                'id' => $data->id,'alloted' => 0,'labeled' => 0,
                'timesup' => 0,'bypass' => 0,'modified' => 0,'total alloted' => 0
            ];
            $tot=0;
            $statuses=explode(",",$data->status);
            $counts=explode(",",$data->count);
            
            for ($i = 0; $i < count($statuses); $i++) {
                $tot+= $obj[$statuses[$i]]=$counts[$i];
            }
            $obj['total alloted']=$tot;
            $data->counts =$obj;

            $data->role=Experts::where(['id' => $data->id])->first()->getRoleNames()->toArray();
        }
        // dd($counts_data);

        return view('dashboard.users_log.index',[
            'counts_data'=>$counts_data
        ]);
    }

    public function toggleExpertDormant(Request $request){
        $formFields=$request->validate([
            'id' => 'required|integer',
        ]);

        $expert=Experts::where(['id' => $formFields['id']])->first();
        if($expert == null){
            return back()->with('message','Wrong expert ID!');
        }

        if($expert->hasRole(Roles::SUPER_ADMIN)){
            return back()->with('message','Invalid Operation!');
        }

        Experts::where(['id' => $formFields['id']])->update([
            'is_dormant' => !$expert['is_dormant']
        ]);

        return back()->with('message','Operation Successful !');
    }

    public function toggleExpertRole(Request $request){
        $formFields=$request->validate([
            'id' => 'required|integer',
        ]);

        $expert=Experts::where(['id' => $formFields['id']])->first();
        if($expert == null){
            return back()->with('message','Wrong expert ID!');
        }

        if($expert->hasRole(Roles::SUPER_ADMIN)){
            return back()->with('message','Invalid Operation!');
        }

        if($expert->hasRole(Roles::ADMIN)){
            $expert->removeRole(Roles::ADMIN);
            $expert->assignRole(Roles::ANNOTATOR);
        }
        else if($expert->hasRole(Roles::ANNOTATOR)){
            $expert->removeRole(Roles::ANNOTATOR);
            $expert->assignRole(Roles::ADMIN);
        }

        return back()->with('message','Operation Successful !');
    }
}
