<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Auth;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('superadmin');

    }
    public function index()
    {
        $all=User::where('status',1)->orderBy('id','DESC')->paginate(6);
        return view('admin.user.all',compact('all'));
    }
    public function add()
    {
        return view('admin.user.add');
    }
    
    public function edit($id){
        $data=User::where('status',1)->where('id',$id)->firstOrFail();
        return view('admin.user.edit',compact('data'));
    }
    public function view($slug){
        $data=User::where('status',1)->where('slug',$slug)->firstOrFail();
        
        return view('admin.user.view',compact('data'));
    }
    public function insert(Request $request)
    {
        $request->validate([
            'name'=>'required|max:50',
            'phone'=>'required|max:20',
            'email'=>'required|email|max:50|unique:users',
            'password'=>'required|min:8',
            'confirm_password'=>'required_with:password|same:password|min:8',
            'username'=>'required',
            'role'=>'required',
        ], [ 
            'name.required' => 'Please enter your name.',
            'phone.required' => 'Please enter your phone.',
            'email.required' => 'Please enter your email address.',
            'password.required' => 'Please enter your password.',
            'confirm_password.required' => 'Please enter your confirm password.',
            'username.required' => 'Please enter your username.',
            'role.required' => 'Please enter your role name.',
        ]);
        
        $slug='U'.uniqid(20);

        $insert=User::insertGetId([

            'name'=>$request['name'],
            'phone'=>$request['phone'],
            'email'=>$request['email'],
            'username'=>$request['username'],
            'password'=>Hash::make($request['password']),
            'role'=>$request['role'],
            'slug'=>$slug,
            'created_at'=>Carbon::now()->todatetimestring(),
        ]);

        if($request->hasFile('pic')){
            $image=$request->file('pic');
            $manager = new ImageManager(new Driver());
            $imageName='user_'.$insert.'_'.time().'.'.$image->getClientOriginalExtension();
            $image = $manager->read($image);
            $image = $image->resize(350,350);
            $image->toJpeg(80)->save('uploads/users/'.$imageName);
            
            User::where('id',$insert)->update([
                'photo'=>$imageName,
                'updated_at'=> Carbon::now()->todatetimestring(),
            ]);
        }
        
        
        if ($insert) {
            Session::flash('success', 'Sucessfully Complete User Registation.');
            return redirect('dashboard/user/add');
        } else {
            Session::flash('error', 'Opps! operation failed.');
            return redirect('dashboard/user/add');
        }

    }


    public function update(Request $request){
        $id=$request['id'];
        $request->validate([
            'name'=>'required|max:50',
            'email'=>'required|email|max:50|unique:users,email,'.$id.',id',
            'role'=>'required',
        ], [ 
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'role.required' => 'Please enter your role name.',
        ]);
        
        $slug=$request['slug'];

        $update=User::where('status',1)->where('id',$id)->update([

            'name'=>$request['name'],
            'phone'=>$request['phone'],
            'email'=>$request['email'],
            'role'=>$request['role'],
            'updated_at'=>Carbon::now()->todatetimestring(),
        ]);

        if($request->hasFile('pic')){
            $image=$request->file('pic');
            $manager = new ImageManager(new Driver());
            $imageName='user_'.$id.'_'.time().'.'.$image->getClientOriginalExtension();
            $image = $manager->read($image);
            $image = $image->resize(350,350);
            $image->toJpeg(80)->save('uploads/users/'.$imageName);
            
            User::where('id',$id)->update([
                'photo'=>$imageName,
                'updated_at'=> Carbon::now()->todatetimestring(),
            ]);
        }
        
        
        if ($update) {
            Session::flash('success', 'Sucessfully Update User Information.');
            return redirect('dashboard/user/view/'.$slug);
        } else {
            Session::flash('error', 'Opps! operation failed.');
            return redirect('dashboard/user/edit/'.$slug);
        }
    }

    public function softdelete()
    {
        $id=$_POST['modal_id'];
        
        $soft=User::where('status',1)->where('id',$id)->update([
            'status'=> '0',
            'updated_at'=> Carbon::now()->todatetimestring(),
        ]);
        if ($soft) {
            Session::flash('success', ' succesfully Delete User Information!!.');
            return redirect('dashboard/user');
        } else {
            Session::flash('error','Operation failed.');
            return redirect('dashboard/user');
        }
    }
    public function restore()
    {
        $id=$_POST['modal_id'];
        
        $restore=User::where('status',0)->where('id',$id)->update([
            'status'=> '1',
            'updated_at'=> Carbon::now()->todatetimestring(),
        ]);
        if ($restore) {
            Session::flash('success', ' succesfully Restore User Information!!.');
            return redirect('dashboard/recycle/user');
        } else {
            Session::flash('error','Operation failed.');
            return redirect('dashboard/recycle/user');
        }
    }
    public function delete()
    {
        $id=$_POST['modal_id'];
        
        $delete=User::where('status',0)->where('id',$id)->delete([]);
        if ($delete) {
            Session::flash('success', ' succesfully permanently Delete User Information!!.');
            return redirect('dashboard/recycle/user');
        } else {
            Session::flash('error','Operation failed.');
            return redirect('dashboard/recycle/user');
        }
    }
}
