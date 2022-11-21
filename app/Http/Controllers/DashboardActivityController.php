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

        $chart_1=DB::table('classifications')
        ->selectRaw('date(labeled_time) as date,count(*) as count')
        ->whereIn('status',['labeled','modified'])->where('e_id','=',$id)
        ->groupBy('date')->orderBy('date','DESC')->take(7)->get()->toArray();

        $chart_2=DB::table('classifications')
        ->selectRaw('date(labeled_time) as date, SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(labeled_time,allocation_time)))) as average')
        ->whereIn('status',['labeled','modified'])->where('e_id','=',$id)
        ->groupBy('date')->orderBy('date','DESC')->take(7)->get()->toArray();

        return view('dashboard.activity.index',[
            'counts_data'=>$counts_data,
            'times_data'=>(array)$times_data[0],
            'chart_1'=> ['labels' => array_reverse(array_column($chart_1,'date')) ,'data' =>array_reverse(array_column($chart_1,'count')) ],
            'chart_2'=> ['labels' => array_reverse(array_column($chart_2,'date')) ,'data' =>array_reverse(array_column($chart_2,'average')) ]
        ]);
    }
}
