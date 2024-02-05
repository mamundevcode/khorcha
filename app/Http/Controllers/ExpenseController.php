<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Expense;
use Carbon\Carbon;
use Auth;
use Session;

class ExpenseController extends Controller{

    public function __construct (){
        $this->middleware('auth');
    }

    public function index(){
        $all = Expense::where('expense_status',1)->orderby('expense_id', 'DESC')->paginate(4);
        return view('admin.expense.main.all', compact('all'));
    }

    public function add(){
        return view('admin.expense.main.add');
    }
    public function edit($slug){
        $data = Expense::where('expense_status', 1)->where('expense_slug', $slug)->firstOrFail();
        return view('admin.expense.main.edit', compact('data'));
    }

    public function view($slug){
        $data=Expense::where('expense_status', 1)->where('expense_slug', $slug)->firstOrFail();
        return view('admin.expense.main.view', compact('data'));
    }
    public function insert(Request $request) {

        $request->validate([
            'title'=>'required|max:100',
            'category'=>'required',
            'date'=>'required',
            'amount'=>'required',
            

        ], [
            'title.required' => 'Please enter expense title.',
            'category.required' => 'Please select expense category.',
            'date.required' => 'Please select expense date.',
            'amount.required' => 'Please enter expense amount.',
        ]);

        $slug = 'E'.uniqid(20);
        $creator = Auth::user()->id;
        $insert = Expense::insert([
            'expense_title'=>$request['title'],
            'expcate_id'=>$request['category'],
            'expense_date'=>$request['date'],          
            'expense_amount'=>$request['amount'],          
            'expense_creator'=>$creator,
            'expense_slug'=>$slug,
            'created_at'=>Carbon::now()->todatetimestring(),
        ]);

        if ($insert) {
            Session::flash('success', 'Expense  Name & Remarks sucessfully done!.');
            return redirect('dashboard/expense/add');
        } else {
            Session::flash('error', 'Opps! operation failed.');
            return redirect('dashboard/expense/add');
        }
    }
    
    public function update(Request $request){
        $request->validate([
            'title'=>'required|max:100',
            'category'=>'required',
            'date'=>'required',
            'amount'=>'required',
            

        ], [
            'title.required' => 'Please enter expense title.',
            'category.required' => 'Please select expense category.',
            'date.required' => 'Please select expense date.',
            'amount.required' => 'Please enter expense amount.',
        ]);

        $id =$request['id'];
        $slug =$request['slug'];
        $editor = Auth::user()->id;
        $update = Expense::where ('expense_status',1)->where('expense_id',$id)->update([
            'expense_title' => $request['title'],
            'expcate_id' => $request['category'],
            'expense_date' => $request['date'],          
            'expense_amount' => $request['amount'],          
            'expense_editor' => $editor,           
            'updated_at' => Carbon::now()->todatetimestring(),
        ]);

        if ($update) {
            Session::flash('success', 'Sucessfully update Expense Information done!.');
            return redirect('dashboard/expense/view/'.$slug);
        } else {
            Session::flash('error', 'Opps! Expense Information operation failed.');
            return redirect('dashboard/expense/edit/'.$slug);
        }
    }

    public function softdelete(){
        $id= $_POST['modal_id'];
        
        $soft=Expense::where('expense_status',1)->where('expense_id',$id)->update([
            'expense_status'=> '0',
            'updated_at'=> Carbon::now()->todatetimestring(),
        ]);
        if ($soft) {
            Session::flash('success', 'succesfully Delete Expense Information!!.');
            return redirect('dashboard/expense');
        } else {
            Session::flash('error','Operation Expense Information failed.');
            return redirect('dashboard/expense');
        }
    }
    public function restore(){
        $id=$_POST['modal_id'];
        
        $restore=Expense::where('expense_status',0)->where('expense_id',$id)->update([
            'expense_status'=> '1',
            'updated_at'=> Carbon::now()->todatetimestring(),
        ]);
        if ($restore) {
            Session::flash('success', ' succesfully Restore Expense Information!!.');
            return redirect('dashboard/recycle/expense');
        } else {
            Session::flash('error','Operation failed.');
            return redirect('dashboard/recycle/expense');
        }
    }
    public function delete(){
        $id=$_POST['modal_id'];
        
        $delete=Expense::where('expense_status',0)->where('expense_id',$id)->delete([]);
        if ($delete) {
            Session::flash('success', ' succesfully permanently Delete Expense Information!!.');
            return redirect('dashboard/recycle/expense');
        } else {
            Session::flash('error','Operation failed Expense Information.');
            return redirect('dashboard/recycle/expense');
        }
    }
}
