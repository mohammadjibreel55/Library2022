<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        $Admins=Admin::all();



        return view('backend.pages.admins.index',compact('Admins'));
    }
    public function create(Request $request){
        session()->flash('status', 'You are now registered !! Please confirm your email address !!');

        return  Admin::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'name' => $request['name'],
            'phone_no' => $request['phone_no'],
            'status' => 0,
            'password' => Hash::make($request['password']),
        ]);
    }
// 'password' => Hash::make($request['password']),



    public function store(Request $request)
    {
        Admin::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'name' => $request['name'],
            'phone_no' => $request['phone_no'],

            'password' => Hash::make($request['password']),
        ]);
        $request->validate([
            'username' => 'required|max:50',
            'name'=>'required|max:50',
            'email' => 'required',
            'password' => 'required',
            'phone_no' => 'required',

]);
        // $Admin = new Admin();
        // $Admin->name = $request->name;
        // $Admin->username=$request->username;
        // $Admin->email = $request->email;
        // $Admin->password = $request->password;
        // $Admin->phone_no= $request->phone_no;
        // $Admin->save();

        session()->flash('success', 'Admin has been created !!');
        return back();
    }



    public function destroy($id) {
        $Admin = Admin::find($id);
        $Admin->delete();

        session()->flash('success', 'Admin has been deleted !!');
        return back();

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'username'=>'required|max:50',
            'email' => 'required|nullable',
            'phone_no' => 'required|nullable',
        ]);

        $Admin = Admin::find($id);
        $Admin->name = $request->name;
        $Admin->username=$request->username;

        $Admin->email = $request->email;
        $Admin->phone_no= $request->phone_no;

        $Admin->save();

        session()->flash('success', 'Admin has been updated !!');
        return back();
    }


    public function updateStatus($Admin_id,$status_code) {
       try{
    $update_Admin= Admin::whereId($Admin_id)->update([
     'status'=>$status_code

     ]);
     if($update_Admin){
         return redirect()->route('admin.UserAdmin.index')->with('success','Admin status updated successfully');

     }
     return redirect()->route('admin.UserAdmin.index')->with('error','fail to upate Admin status');

       }
       catch(\Throwable $th){
          throw $th;
       }






    }
}
