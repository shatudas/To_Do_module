<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;


class UserController extends Controller
{
	
  public function view(){
   $data['alldata'] = User::all();
   return view('backend.user.view_user',$data);
  }

  public function add(){
  	return view('backend.user.add_user');
  }

  public function store(Request $request){

  	$this->validate($request,[
	  'name'       =>'required',
	  'email'      =>'required|unique:users,email',
	  'password'   =>'required'
	  ]);

  	$data = new User();
	  $data->name      =$request->name;
	  $data->email     =$request->email;
	  $data->password  =bcrypt($request->password);

	  if($request->file('image'))
	   {
			  $file=$request->file('image');
			  $filename = 'IMG_'.date('YmdHis').'.'.$file->getClientOriginalExtension();
			  $file->move(public_path('upload/user_image'),$filename);
			  $data['image']=$filename;
			 }
    $data->save();
    return redirect()->route('user.view')->with('success','Data Insert Successfully');

 }


  //-----delete------//
		public function delete($id)
			{
			  $user = User::find($id);
			  if(file_exists('upload/user_image/' .$user->image) AND !empty($user->image))
			   {
			    @unlink('upload/user_image/' .$user->image);
			   }
			  $user->delete();
			  return redirect()->route('user.view')->with('success','Data Deleted Successfully');
			}


			//------edit-----//
		 public function edit($id)
		 {
		  $data['editData']=User::find($id);
		  return view('backend.user.edit_user',$data);
		 }


		 //-----update------//
   public function update(Request $request,$id)
   {
  
    $this->validate($request,[
		  'name'       =>'required',
		  'email'      =>'required'
	  ]);

    $data = user::find($id);
    $data->name      =$request->name;
		  $data->email     =$request->email;
		  $data->password  =bcrypt($request->password);
	
    if($request->file('image')){
     $file = $request->file('image');
     @unlink(public_path('upload/user_image/'.$data->image));
     $filename = 'IMG_'.date('YmdHis').'.'.$file->getClientOriginalExtension();
     $file->move(public_path('upload/user_image/'),$filename);
     $data['image'] = $filename;
    }

    $data->save();
    return redirect()->route('user.view')->with('success','data Update Successfully');
   }


    public function passwordview()
	    {
		    return view('backend.user.edit_password');
		   }


	   public function passwordupdate(Request $request)
		   {
	     if(Auth::attempt(['id'=>Auth::user()->id,'password'=>$request->current_password]))
		     {
		      $user=User::find(Auth::User()->id);
		      $user->password=bcrypt($request->new_password);
		      $user->save();
		      return redirect()->route('user.view')->with('success','password changed Successfully');
		     }
		     else
		     {
		      return redirect()->back()->with('error','Sorry! your current password dost not match');
		     }
		   }


}
