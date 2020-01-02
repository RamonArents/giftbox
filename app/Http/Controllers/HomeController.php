<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Ticket;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::all();
        $countOrder = count($orders);

        $tickets = Ticket::all();
        $countTicket = count($tickets);

        $usedTickets = Ticket::where('used', true)->get();
        $countUsedTickets =  count($usedTickets);

        $orderJan = Order::whereMonth('created_at', '01')->get();
        $countOrderJan = count($orderJan);

        $orderFeb = Order::whereMonth('created_at', '02')->get();
        $countOrderFeb= count($orderFeb);

        $orderMar = Order::whereMonth('created_at', '03')->get();
        $countOrderMar = count($orderMar);

        $orderApr = Order::whereMonth('created_at', '04')->get();
        $countOrderApr = count($orderApr);

        $orderMei = Order::whereMonth('created_at', '05')->get();
        $countOrderMei = count($orderMei);

        $orderJun = Order::whereMonth('created_at', '06')->get();
        $countOrderJun = count($orderJun);

        $orderJul = Order::whereMonth('created_at', '07')->get();
        $countOrderJul = count($orderJul);

        $orderAug = Order::whereMonth('created_at', '08')->get();
        $countOrderAug = count($orderAug);

        $orderSep = Order::whereMonth('created_at', '09')->get();
        $countOrderSep = count($orderSep);

        $orderOkt = Order::whereMonth('created_at', '10')->get();
        $countOrderOkt = count($orderOkt);

        $orderNov = Order::whereMonth('created_at', '11')->get();
        $countOrderNov = count($orderNov);

        $orderDec = Order::whereMonth('created_at', '12')->get();
        $countOrderDec = count($orderDec);

        return view('home',[   'orderCount' => $countOrder,
                                    'ticketCount' => $countTicket,
                                    'usedTicketCount' => $countUsedTickets,
                                    'orderJan' => $countOrderJan,
                                    'orderFeb' => $countOrderFeb,
                                    'orderMar' => $countOrderMar,
                                    'orderApr' => $countOrderApr,
                                    'orderMei' => $countOrderMei,
                                    'orderJun' => $countOrderJun,
                                    'orderJul' => $countOrderJul,
                                    'orderAug' => $countOrderAug,
                                    'orderSep' => $countOrderSep,
                                    'orderOkt' => $countOrderOkt,
                                    'orderNov' => $countOrderNov,
                                    'orderDec' => $countOrderDec]);
    }
}
