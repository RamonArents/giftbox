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
     * show the order table
     * @return view, the order view
     */
    public function editOrderView($id){
        $order = Order::find($id);

        return view('admin.edit-order', ['order' => $order]);
    }
    /**
    /**
     * edit the order
     * @param $id, the id of the order to edit
     * @param $request, the request to save the edited values
     * @return redirect to view with success
     */
    public function editOrder(Request $request, $id){
        $order = Order::find($id);
        $order->email = $request->input('email');
        $order->orderNumber = $request->input('orderNumber');
        $order->paymentStatus = $request->input('paymentStatus');
        $order->save();

        return redirect('/orders')->with('success', 'Order successfully edited.');
    }
    /**
     * delete the order (soft delete)
     * @param $id, the id of the order to delete
     * @return redirect to view with success
     */
    public function deleteOrder($id){
        $order = Order::find($id);
        $order->delete();

        return redirect('/orders')->with('success', 'Order successfully deleted.');
    }
    /**
     * show the code table
     * @return view, the code view
     */
    public function codes(){
        return view('admin.codes');
    }
}
