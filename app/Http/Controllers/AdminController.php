<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;

class AdminController extends Controller
{
    /**
     * show the order table
     * @return view, the order view
     */
    public function orders(){
        $orders = Order::all();

        return view('admin.orders', ['orders' => $orders]);
    }
    /**
     * delete the order (soft delete)
     * @return redirect to view with success or erro
     */
    public function deleteOrder($id){
        $order = Order::find($id);
        $order->delete();

        return view('admin.orders', ['orders' => $orders]);
    }
    /**
     * show the code table
     * @return view, the code view
     */
    public function codes(){
        return view('admin.codes');
    }
}
