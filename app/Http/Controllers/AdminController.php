<?php

namespace App\Http\Controllers;

use App\Code;
use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\Card;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //only admin users are allowed to see this page
        $this->middleware('auth');
    }
    /**
     * show the order table
     * @return view, the order view
     */
    public function orders()
    {
        $orders = Order::all();

        return view('admin.orders', ['orders' => $orders]);
    }

    /**
     * edit the order with the selected id
     * @param $id , the id of the order to edit
     * @return view, the edit-order view
     */
    public function editOrderView($id)
    {
        $order = Order::find($id);

        return view('admin.edit-order', ['order' => $order]);
    }

    /**
     * edit the order
     * @param $id , the id of the order to edit
     * @param $request , the request to save the edited values
     * @return redirect to order view with success
     */
    public function editOrder(Request $request, $id)
    {
        $order = Order::find($id);
        $order->email = $request->input('email');
        $order->orderNumber = $request->input('orderNumber');
        $order->paymentStatus = $request->input('paymentStatus');
        $order->save();

        return redirect('/orders')->with('success', 'Order successfully edited.');
    }

    /**
     * delete the order (soft delete)
     * @param $id , the id of the order to delete
     * @return redirect to order view with success
     */
    public function deleteOrder($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect('/orders')->with('success', 'Order successfully deleted.');
    }

    /**
     * show the code table
     * @return view, the code view
     */
    public function codes()
    {
        $codes = Code::all();

        return view('admin.codes', ['codes' => $codes]);
    }

    /**
     * edit the code view
     * @param $id , the id of the selected code to edit
     * @return view, the edit-code view
     */
    public function editCodeView($id)
    {
        $code = Code::find($id);

        return view('admin.edit-code', ['code' => $code]);
    }

    /**
     * edit the code
     * @param $id , the id of the code to edit
     * @param $request , the request to save the edited values
     * @return redirect to code view with success
     */
    public function editCode(Request $request, $id)
    {
        $code = Code::find($id);
        $code->codeNumber = $request->input('code');
        $code->used = $request->input('used');
        $code->save();

        return redirect('/codes')->with('success', 'Code successfully edited.');
    }

    /**
     * delete the code(soft delete)
     * @param $id , the id of the code to delete
     * @return redirect to code view with success
     */
    public function deleteCode($id)
    {
        $code = Code::find($id);
        $code->delete();

        return redirect('/codes')->with('success', 'Code successfully deleted.');
    }

    /**
     * show the cards table
     * @return view, the cards view
     */
    public function cards()
    {
        $cards = Card::all();

        return view('admin.cards', ['cards' => $cards]);
    }

    /**
     * edit the card view
     * @param $id , the id of the selected card to edit
     * @return view, the edit-card view
     */
    public function editCardView($id)
    {
        $card = Card::find($id);

        return view('admin.edit-card', ['card' => $card]);
    }

    /**
     * edit the card
     * @param $id , the id of the card to edit
     * @param $request , the request to save the edited values
     * @return redirect to card view with success
     */
    public function editCard(Request $request, $id)
    {
        $code = Card::find($id);
        $code->cardNumber = $request->input('card');
        $code->balance = $request->input('balance');
        $code->save();

        return redirect('/cards')->with('success', 'Card successfully edited.');
    }

    /**
     * delete the card(soft delete)
     * @param $id , the id of the card to delete
     * @return redirect to card view with success
     */
    public function deleteCard($id)
    {
        $card = Card::find($id);
        $card->delete();

        return redirect('/cards')->with('success', 'Card successfully deleted.');
    }

}
