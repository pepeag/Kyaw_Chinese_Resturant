<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class UserController extends Controller
{
    //
    public function index(){
        $data=Menu::where('publish_status',1)->paginate(8);
        $status = count($data) == 0 ? 0 : 1;
        $category = Category::get();

        //   dd($pizza->toArray());
        return view('user.home')->with(['menu' => $data, 'category' => $category, 'status' => $status]);
    }
    public function menuDetails($id){
        $data=Menu::where('menu_id',$id)->first();
        Session::put('MENU_INFO',$data);
        return view('user.details')->with(['menu'=>$data]);
    }
    public function order(){
        $menuInfo=Session::get('MENU_INFO');
        $category=Category::get();
        // dd($data->toArray());
        return view('user.order')->with(['menu'=>$menuInfo,'category'=>$category]);
    }
    public function placeOrder(Request $request){
        $menuInfo=Session::get('MENU_INFO');
        $userId=auth()->user()->id;
        $count=$request->menuCount;
        $validator = Validator::make($request->all(), [
            'menuCount' => 'required',
            'paymentType'=>'required',
            'category'=>'required'


        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $orderData=$this->requestOrderData($request,$menuInfo,$userId);
        // dd($orderData);

        //loop for count & add data to order table
        for($i=0;$i<$count;$i++){
            Order::create($orderData);
        }

        $total=intdiv($count,3);
        if($count%3 !=0){
            $total+=1;
        }
        $waitingTime=$menuInfo['waiting_time']*$total; //time for count pizza


        $totalPrice=$menuInfo['price']*$count;

        return back()->with(['totalTime'=>$waitingTime,'totalPrice'=>$totalPrice]);



    }
    private function requestOrderData($request,$menuInfo,$userId){
        return[
            'customer_id'=>$userId,
            'menu_id'=>$menuInfo['menu_id'],//session
            'category_id'=>$request->category,
            'payment_status'=>$request->paymentType,
            'order_time'=>Carbon::now(),
        ];
    }
}
