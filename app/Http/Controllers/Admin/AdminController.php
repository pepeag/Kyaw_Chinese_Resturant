<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function index(){
        $id = auth()->user()->id;
        $userData = User::where('id', $id)->first();
        return view('admin.profile.index')->with(['user' => $userData]);
    }
    public function updateProfile($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',

        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $updateData = $this->requestUserData($request);
        User::where('id', $id)->update($updateData);
        return back()->with(['updateSuccess' => 'User update successfully']);
    }


    //change password
    public function changePassword($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        //get data from database
        $data = User::where('id', $id)->first();
        //get request from change password form
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $confirmPassword = $request->confirmPassword;
        $hashedValue=$data['password'];
        // dd($hashedValue);

        if(Hash::check($oldPassword, $hashedValue)){ //same oldPassword and db password
            if($newPassword != $confirmPassword){
                return back()->with(['notSameError'=>'New Password and Confirm Password are not same...']);
            }else{
                if(strlen($newPassword)<=6 || $confirmPassword <=6){
                    return back()->with(['lessThanSix'=>'Password must be greater than 6']);
                }else{
                    //hashing password
                    $hash=Hash::make($newPassword);
                    //update password to database
                    User::where('id',$id)->update([
                        'password'=>$hash
                    ]);

                    return back()->with(['successPassword'=>'Password change...']);
                }
            }

        }else{
            return back()->with(['notMatchError'=>'Password do not match!Try again!...']);
        }



    }
    //direct change password page
    public  function changePasswordPage()
    {
        return view('admin.profile.changePassword');
    }
    private function requestUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }
}
