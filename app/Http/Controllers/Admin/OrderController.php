<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function order()
    {
        $data = Order::select('orders.*', 'users.name as customer_name', 'menus.menu_name as menu_name', DB::raw('COUNT(orders.menu_id) as count'),'categories.category_name as category_name')
            ->join('users', 'users.id', 'orders.customer_id')
            ->join('menus', 'menus.menu_id', 'orders.menu_id')
            ->join('categories','categories.category_id','orders.category_id')
            ->groupBy('orders.customer_id', 'orders.menu_id','orders.category_id')
            ->paginate(9);


        if (count($data) == 0) {
            $emptyStatus = 0;
        } else {
            $emptyStatus = 1;
        }
        return view('admin.order.orderList')->with(['order' => $data, 'status' => $emptyStatus]);
    }
    public function orderSearch(Request $request)
    {
        $data = Order::select('orders.*', 'users.name as customer_name', 'menus.menu_name as menu_name', DB::raw('COUNT(orders.menu_id) as count'),'categories.category_name as category_name')
            ->join('users', 'users.id', 'orders.customer_id')
            ->join('menus', 'menus.menu_id', 'orders.menu_id')
            ->join('categories','categories.category_id','orders.category_id')
            ->groupBy('orders.customer_id', 'orders.menu_id','orders.category_id')
            ->orWhere('users.name', 'like', '%' . $request->searchData . '%')
            ->orWhere('menus.menu_name', 'like', '%' . $request->searchData . '%')
            ->orWhere('orders.order_time', 'like', '%' . $request->searchData . '%')
            ->orWhere('categories.category_name', 'like', '%' . $request->searchData . '%')
            ->paginate(9);
        $data->appends($request->all());

        if (count($data) == 0) {
            $emptyStatus = 0;
        } else {
            $emptyStatus = 1;
        }
        return view('admin.order.orderList')->with(['status' => $emptyStatus, 'order' => $data,]);
    }
    public function total()
    {
        $data = Order::select('orders.*', 'users.name as customer_name', 'menus.menu_name as menu_name', 'menus.price as price', DB::raw('COUNT(orders.menu_id) as count'),'categories.category_name as category_name',DB::raw('sum(menus.price) as  total'))
            ->join('users', 'users.id', 'orders.customer_id')
            ->join('menus', 'menus.menu_id', 'orders.menu_id')
            ->join('categories','categories.category_id','orders.category_id')
            ->groupBy('orders.customer_id', 'orders.menu_id','orders.category_id')
            ->paginate(9);
            if (count($data) == 0) {
                $emptyStatus = 0;
            } else {
                $emptyStatus = 1;
            }

        return view('admin.order.total')->with(['total' => $data,'status' => $emptyStatus]);
    }
    public function totalSearch(Request $request){
        $data = Order::select('orders.*', 'users.name as customer_name',
        'menus.menu_name as menu_name','menus.price as price',
        DB::raw('COUNT(orders.menu_id) as count'),'categories.category_name as category_name',DB::raw('sum(menus.price) as  total'))
            ->join('users', 'users.id', 'orders.customer_id')
            ->join('menus', 'menus.menu_id', 'orders.menu_id')
            ->join('categories','categories.category_id','orders.category_id')
            ->groupBy('orders.customer_id', 'orders.menu_id','orders.category_id')
            ->orWhere('orders.order_time','like', '%' . $request->searchDate . '%')
            ->paginate(9);

            // $dailyTotal=Order::select('orders.*', 'users.name as customer_name', 'menus.menu_name as menu_name', 'menus.price as price',
            // DB::raw('COUNT(orders.menu_id) as count'),'categories.category_name as category_name')
            //     ->join('users', 'users.id', 'orders.customer_id')
            //     ->join('menus', 'menus.menu_id', 'orders.menu_id')
            //     ->join('categories','categories.category_id','orders.category_id')
            //     ->groupBy(DB::raw('orders.order_time, sum(menus.price) as dailyPrice'))
            //     ->orWhere('orders.order_time','like', '%' . $request->searchDate . '%')

            //     ->paginate(9);

            if (count($data) == 0) {
                $emptyStatus = 0;
            } else {
                $emptyStatus = 1;
            }

        return view('admin.order.total')->with(['total' => $data,'status' => $emptyStatus,]);


    }

}
