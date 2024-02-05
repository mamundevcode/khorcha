<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;
use App\Models\ContactInformation;
use App\Models\SocialMedia;
use App\Models\Basic;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;
use Auth;

class ManageController extends Controller{
    public function __construct(){
        $this-> middleware('auth');
    }
    public function index(){
            return redirect('dashboard');
    }
    public function basic(){
        $data=Basic::where('basic_status',1)->where('basic_id',1)->firstOrFail();
        return view('admin.manage.basic',compact('data'));
    }

    public function basic_update(Request $request){
        $this->validate($request,[
         'company'=>'required|max:100',       
        ],[
         'company.required'=>'Please Enter Your Company Name.',       
            
        ]);
        
        $editor = Auth::user()->id;
        $update = Basic::where('basic_id',1)->update([
            'basic_company' => $request['company'],                
            'basic_title' => $request['title'],                
            'basic_editor' => $editor,
            'updated_at' => Carbon::now()->todatetimestring(),
        ]);

        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $logoName = 'logo_'.time().'.'.$logo->getClientOriginalExtension(); 
            $manager = new ImageManager(new Driver());
            $logo = $manager->read($logo);
            $logo = $logo->resize(300,300);
            $logo->save('uploads/basic/'.$logoName);

            Basic::where('basic_id',1)->update([
                'basic_logo' => $logoName,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
            
        }

        if($request->hasFile('favicon')){
            $favicon = $request->file('favicon');
            $faviconName = 'favicon_'.time().'.'.$favicon->getClientOriginalExtension(); 
            $manager = new ImageManager(new Driver());
            $favicon = $manager->read($favicon);
            $favicon = $favicon->resize(300,300);
            $favicon->save('uploads/basic/'.$faviconName);

            Basic::where('basic_id',1)->update([
                'basic_favicon' => $faviconName,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }

        if($request->hasFile('flogo')){
            $flogo = $request->file('flogo');
            $flogoName = 'flogo_'.time().'.'.$flogo->getClientOriginalExtension(); 
            $manager = new ImageManager(new Driver());
            $flogo = $manager->read($flogo);
            $flogo = $flogo->resize(300,300);
            $flogo->save('uploads/basic/'.$flogoName);

            Basic::where('basic_id',1)->update([
                'basic_flogo' => $flogoName,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }

        if ($update) {
            Session::flash('success','Update Basic Information.');
            return redirect('dashboard/manage/basic');
        } else {
            Session::flash('error', 'Opps! operation failed.');
            return redirect('dashboard/manage/basic');
        }

    }

    public function social(){
        $data=SocialMedia::where('sm_status',1)->where('sm_id',1)->firstOrFail();
        return view('admin.manage.social',compact('data'));
    }

    public function social_update(Request $request){
        $this->validate($request,[

        ],[
                
        ]);
     
        $editor = Auth::user()->id;

        $update = SocialMedia::where('sm_id',1)->update([
            'sm_facebook' => $request['facebook'],           
            'sm_twitter' => $request['twitter'],           
            'sm_instagram' => $request['instagram'],           
            'sm_whatsapp' => $request['whatsapp'],           
            'sm_reddit' => $request['reddit'],           
            'sm_github' => $request['github'],           
            'sm_weixin' => $request['weixin'],           
            'sm_linkedin' => $request['linkedin'],           
            'sm_pinterest' => $request['pinterest'],           
            'sm_youtube' => $request['youtube'],           
            'sm_editor' => $editor,
            'updated_at' => Carbon::now()->todatetimestring(),
        ]);

        if ($update) {
            Session::flash('success','Update Social Media Information.');
            return redirect('dashboard/manage/social');
        } else {
            Session::flash('error', 'Opps! operation failed.');
            return redirect('dashboard/manage/social');
        }
    }

    public function contact(){
         $data=ContactInformation::where('ci_status',1)->where('ci_id',1)->firstOrFail();
        return view('admin.manage.contact',compact('data'));
    }

    public function contact_update(Request $request){
        $this->validate($request,[

        ],[

        ]);
             
        $editor = Auth::user()->id;

        $update = ContactInformation::where('ci_id',1)->update([
            'ci_phone1' => $request['phone1'],                   
            'ci_phone2' => $request['phone2'],                   
            'ci_phone3' => $request['phone3'],                   
            'ci_phone4' => $request['phone4'],                                      
            'ci_email1' => $request['email1'],                                      
            'ci_email2' => $request['email2'],                                      
            'ci_email3' => $request['email3'],                                      
            'ci_email4' => $request['email4'],                                      
            'ci_address1' => $request['address1'],                                      
            'ci_address2' => $request['address2'],                                      
            'ci_address3' => $request['address3'],                                      
            'ci_address4' => $request['address4'],                                      
            'ci_editor' => $editor,
            'updated_at' => Carbon::now()->todatetimestring(),
        ]);

        if ($update) {
            Session::flash('success','Update Contact Information.');
            return redirect('dashboard/manage/contact');
        } else {
            Session::flash('error', 'Opps! operation failed.');
            return redirect('dashboard/manage/contact');
        }
    }
}
