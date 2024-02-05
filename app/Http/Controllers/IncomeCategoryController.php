<?php

namespace App\Http\Controllers;

use App\Models\IncomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use Session;

class IncomeCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $allData = IncomeCategory::where('incate_status',1)->orderby('incate_id', 'DESC')->get();
        return view('admin.income.category.all', compact('allData'));
    }
    public function add(){
        return view('admin.income.category.add');
    }
    public function edit($slug){
        $data = IncomeCategory::where('incate_status', 1)->where('incate_slug', $slug)->firstOrFail();
        return view('admin.income.category.edit', compact('data'));
    }
    public function view($slug){
        $data = IncomeCategory::where('incate_status', 1)->where('incate_slug', $slug)->firstOrFail();
        return view('admin.income.category.view', compact('data'));
    }
    public function insert(Request $request){

        $request->validate([
            'name' => 'required|max:50|unique:income_categories,incate_name',

        ], [
            'name.required' => 'Please enter income category name.',
        ]);

        $slug = Str::slug($request['name'], '-');
        $creator = Auth::user()->id;
        $insert = IncomeCategory::insert([
            'incate_name' => $request['name'],
            'incate_remarks' => $request['remarks'],
            'incate_creator' => $creator,
            'incate_slug' => $slug,
            'created_at' => Carbon::now()->todatetimestring(),
        ]);

        if ($insert) {
            Session::flash('success', 'Income Category Name & Remarks sucessfully done!.');
            return redirect('dashboard/income/category/add');
        } else {
            Session::flash('error', 'Opps! operation failed.');
            return redirect('dashboard/income/category/add');
        }
    }
    public function update(Request $request){
        $id = $request['id'];
        $request->validate([
            'name' => 'required | max:50 | unique:income_categories,incate_name,' . $id . ',incate_id',
        ], [
            'name.required' => 'Please enter income category name.',
        ]);

        $slug = Str::slug($request['name'], '-');
        $editor = Auth::user()->id;
        $update = IncomeCategory::where('incate_status',1)->where('incate_id', $id)->update([
            'incate_name' => $request['name'],
            'incate_remarks' => $request['remarks'],
            'incate_editor' => $editor,
            'incate_slug' => $slug,
            'updated_at' => Carbon::now()->todatetimestring(),
        ]);

        if ($update) {
            Session::flash('success', 'Update succesfully Done!!.');
            return redirect('dashboard/income/category/view/' . $slug);
        } else {
            Session::flash('error','Opps! operation failed.');
            return redirect('dashboard/income/category/edit');
        }
    }

    public function softdelete(){
        $id=$_POST['modal_id'];
        
        $soft=IncomeCategory::where('incate_status',1)->where('incate_id',$id)->update([
            'incate_status'=> '0',
            'updated_at'=> Carbon::now()->todatetimestring(),
        ]);
        if ($soft) {
            Session::flash('success', 'Delete succesfully Done!!.');
            return redirect('dashboard/income/category');
        } else {
            Session::flash('error','Operation failed.');
            return redirect('dashboard/income/category');
        }
    }
    public function restore(){
        $id=$_POST['modal_id'];
        
        $restore=IncomeCategory::where('incate_status',0)->where('incate_id',$id)->update([
            'incate_status'=> '1',
            'updated_at'=> Carbon::now()->todatetimestring(),
        ]);
        if ($restore) {
            Session::flash('success', 'Restore succesfully Done!!.');
            return redirect('dashboard/recycle/income/category');
        } else {
            Session::flash('error','Operation failed.');
            return redirect('dashboard/recycle/income/category');
        }
    }
    public function delete(){
        $id=$_POST['modal_id'];
        
        $delete=IncomeCategory::where('incate_status',0)->where('incate_id',$id)->delete([]);
        if ($delete) {
            Session::flash('success', 'Permanetly Delete succesfully Done!!.');
            return redirect('dashboard/recycle/income/category');
        } else {
            Session::flash('error','Operation failed.');
            return redirect('dashboard/recycle/income/category');
        }
    }
    
}
