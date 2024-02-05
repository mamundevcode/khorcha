<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchiveController extends Controller{

    public function __construct(){
        $this->middleware ('auth');
    }
    public function index(){
        return view('admin.archive.index');
    }
    public function month($month){
        return view('admin.archive.month',compact('month'));
    }
}
