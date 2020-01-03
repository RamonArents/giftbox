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
        //all records
        $orders = Order::all();
        $countOrder = count($orders);

        $tickets = Ticket::all();
        $countTicket = count($tickets);

        $usedTickets = Ticket::where('used', true)->get();
        $countUsedTickets =  count($usedTickets);

        //orders by month
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


        //tickets by month
        $ticketJan = Ticket::whereMonth('created_at', '01')->get();
        $countTicketJan = count($ticketJan);

        $ticketFeb = Ticket::whereMonth('created_at', '02')->get();
        $countTicketFeb= count($ticketFeb);

        $ticketMar = Ticket::whereMonth('created_at', '03')->get();
        $countTicketMar = count($ticketMar);

        $ticketApr = Ticket::whereMonth('created_at', '04')->get();
        $countTicketApr = count($ticketApr);

        $ticketMei = Ticket::whereMonth('created_at', '05')->get();
        $countTicketMei = count($ticketMei);

        $ticketJun = Ticket::whereMonth('created_at', '06')->get();
        $countTicketJun = count($ticketJun);

        $ticketJul = Ticket::whereMonth('created_at', '07')->get();
        $countTicketJul = count($ticketJul);

        $ticketAug = Ticket::whereMonth('created_at', '08')->get();
        $countTicketAug = count($ticketAug);

        $ticketSep = Ticket::whereMonth('created_at', '09')->get();
        $countTicketSep = count($ticketSep);

        $ticketOkt = Ticket::whereMonth('created_at', '10')->get();
        $countTicketOkt = count($ticketOkt);

        $ticketNov = Ticket::whereMonth('created_at', '11')->get();
        $countTicketNov = count($ticketNov);

        $ticketDec = Ticket::whereMonth('created_at', '12')->get();
        $countTicketDec = count($ticketDec);

        return view('admin.home',[   'orderCount' => $countOrder,
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
                                    'orderDec' => $countOrderDec,
                                    'ticketJan' => $countTicketJan,
                                    'ticketFeb' => $countTicketFeb,
                                    'ticketMar' => $countTicketMar,
                                    'ticketApr' => $countTicketApr,
                                    'ticketMei' => $countTicketMei,
                                    'ticketJun' => $countTicketJun,
                                    'ticketJul' => $countTicketJul,
                                    'ticketAug' => $countTicketAug,
                                    'ticketSep' => $countTicketSep,
                                    'ticketOkt' => $countTicketOkt,
                                    'ticketNov' => $countTicketNov,
                                    'ticketDec' => $countTicketDec]);
    }
}
