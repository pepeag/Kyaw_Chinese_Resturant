<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userList(){
        $data=User::where('role','user')->paginate(5);
        if(count($data)==0){
            $emptyStatus=0;
        }
        else{
            $emptyStatus=1;
        }
        return view('admin.user.userList')->with(['user'=>$data,'status'=>$emptyStatus]);
    }
    public function adminList(){
        //get data from user table with role=user
        $userData=User::where('role','admin')->paginate(4);

        return view('admin.user.adminList')->with(['admin'=>$userData]);
    }
    //USER SEARCH
    public function userSearch(Request $request){

        // $key=$request->searchData;

        // $searchData=User::where('role','user')

        //             ->where(function($query) use($key){
        //                 $query->orWhere('email','like','%'.$key.'%')
        //                 ->orWhere('phone','like','%'.$key.'%')
        //                 ->orWhere('address','like','%'.$key.'%')
        //                 -> orWhere('name','like','%'.$key.'%');
        //             })

        //             ->paginate(4);

        // $searchData->appends($request->all());
        // return view('admin.user.userList')->with(['user'=>$searchData]);

        $response=$this->search('user',$request);
        return view('admin.user.userList')->with(['user'=>$response]);
    }

    //USER DELETE
    public function userDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User Delete Successfully']);
    }

    //ADMIN SEARCH
    public function adminSearch(Request $request){

       $response=$this->search('admin',$request);
        return view('admin.user.adminList')->with(['admin'=>$response]);
    }


    private function search($role,$request){
        $searchData=User::where('role',$role)
//use $request as a key
        ->where(function($query) use($request){
            $query->orWhere('email','like','%'.$request->searchData.'%')
            ->orWhere('phone','like','%'.$request->searchData.'%')
            ->orWhere('address','like','%'.$request->searchData.'%')
            -> orWhere('name','like','%'.$request->searchData.'%');
        })
        ->paginate(4);
        $searchData->appends($request->all());

    }
    public function adminDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User Delete Successfully']);
    }

}
