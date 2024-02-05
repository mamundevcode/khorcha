<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminController extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $chart_options = [
            'chart_title' => 'User by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Income',
            'conditions'=>[
                ['income_title' =>'book buy', 'condition'=>'incate_id=5','color'=>'pink','fill'=>true],
                ['income_title' =>'Shopping', 'condition'=>'incate_id=7','color'=>'blue','fill'=>true],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'pie',
        ];
        $chart1 = new LaravelChart($chart_options);
        return view('admin/dashboard/home',compact('chart1'));
    }
}
