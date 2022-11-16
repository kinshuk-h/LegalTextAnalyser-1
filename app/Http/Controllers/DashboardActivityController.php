<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardActivityController extends Controller
{
    public function showActivity(){
        $id=auth()->user()->id;

        $counts_data=DB::table('classifications')
        ->selectRaw('status,count(*) as count')
        ->where('e_id','=', $id)->groupBy('status')->get()->toArray();

        $counts_data[] = (object) ['status' => 'total alloted','count' => array_sum(array_column($counts_data, 'count')) ];

        $times_data=DB::table('classifications')
        ->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(labeled_time,allocation_time)))) as \'Total Labelling Time\',
        SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(labeled_time,allocation_time)))) as \'Average Labelling Time\',
        SEC_TO_TIME(MIN(TIME_TO_SEC(TIMEDIFF(labeled_time,allocation_time)))) as \'Minimum Labelling Time\',
        SEC_TO_TIME(MAX(TIME_TO_SEC(TIMEDIFF(labeled_time,allocation_time)))) as \'Maximum Labelling Time\'')
        ->where('e_id','=', $id)->where('status','=', 'labeled')->get()->toArray();

        return view('dashboard.activity.index',[
            'counts_data'=>$counts_data,
            'times_data'=>(array)$times_data[0]
        ]);
    }
}
