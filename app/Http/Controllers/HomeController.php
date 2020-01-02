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

        return view('home', ['orderCount' => $countOrder, 'ticketCount' => $countTicket, 'usedTicketCount' => $countUsedTickets]);
    }
}
