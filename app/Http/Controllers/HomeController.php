<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Code;

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

        $codes = Code::all();
        $countCode = count($codes);

        //usedCodes by month
        $usedCodesJan = Code::where('used', true)->whereMonth('created_at', '01')->get();
        $countUsedCodesJan =  count($usedCodesJan);

        $usedCodesFeb = Code::where('used', true)->whereMonth('created_at', '02')->get();
        $countUsedCodesFeb =  count($usedCodesFeb);

        $usedCodesMar = Code::where('used', true)->whereMonth('created_at', '03')->get();
        $countUsedCodesMar =  count($usedCodesMar);

        $usedCodesApr = Code::where('used', true)->whereMonth('created_at', '04')->get();
        $countUsedCodesApr =  count($usedCodesApr);

        $usedCodesMei = Code::where('used', true)->whereMonth('created_at', '05')->get();
        $countUsedCodesMei =  count($usedCodesMei);

        $usedCodesJun = Code::where('used', true)->whereMonth('created_at', '06')->get();
        $countUsedCodesJun =  count($usedCodesJun);

        $usedCodesJul = Code::where('used', true)->whereMonth('created_at', '07')->get();
        $countUsedCodesJul =  count($usedCodesJul);

        $usedCodesAug = Code::where('used', true)->whereMonth('created_at', '08')->get();
        $countUsedCodesAug =  count($usedCodesAug);

        $usedCodesSep = Code::where('used', true)->whereMonth('created_at', '09')->get();
        $countUsedCodesSep =  count($usedCodesSep);

        $usedCodesOkt = Code::where('used', true)->whereMonth('created_at', '10')->get();
        $countUsedCodesOkt =  count($usedCodesOkt);

        $usedCodesNov = Code::where('used', true)->whereMonth('created_at', '11')->get();
        $countUsedCodesNov =  count($usedCodesNov);

        $usedCodesDec = Code::where('used', true)->whereMonth('created_at', '12')->get();
        $countUsedCodesDec =  count($usedCodesDec);

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


        //codes by month
        $codeJan = Code::whereMonth('created_at', '01')->get();
        $countCodeJan = count($codeJan);

        $codeFeb = Code::whereMonth('created_at', '02')->get();
        $countCodeFeb= count($codeFeb);

        $codeMar = Code::whereMonth('created_at', '03')->get();
        $countCodeMar = count($codeMar);

        $codeApr = Code::whereMonth('created_at', '04')->get();
        $countCodeApr = count($codeApr);

        $codeMei = Code::whereMonth('created_at', '05')->get();
        $countCodeMei = count($codeMei);

        $codeJun = Code::whereMonth('created_at', '06')->get();
        $countCodeJun = count($codeJun);

        $codeJul = Code::whereMonth('created_at', '07')->get();
        $countCodeJul = count($codeJul);

        $codeAug = Code::whereMonth('created_at', '08')->get();
        $countCodeAug = count($codeAug);

        $codeSep = Code::whereMonth('created_at', '09')->get();
        $countCodeSep = count($codeSep);

        $codeOkt = Code::whereMonth('created_at', '10')->get();
        $countCodeOkt = count($codeOkt);

        $codeNov = Code::whereMonth('created_at', '11')->get();
        $countCodeNov = count($codeNov);

        $codeDec = Code::whereMonth('created_at', '12')->get();
        $countCodeDec = count($codeDec);

        return view('admin.home',[   'orderCount' => $countOrder,
                                    'codeCount' => $countCode,
                                    'usedCodesJan' => $countUsedCodesJan,
                                    'usedCodesFeb' => $countUsedCodesFeb,
                                    'usedCodesMar' => $countUsedCodesMar,
                                    'usedCodesApr' => $countUsedCodesApr,
                                    'usedCodesMei' => $countUsedCodesMei,
                                    'usedCodesJun' => $countUsedCodesJun,
                                    'usedCodesJul' => $countUsedCodesJul,
                                    'usedCodesAug' => $countUsedCodesAug,
                                    'usedCodesSep' => $countUsedCodesSep,
                                    'usedCodesOkt' => $countUsedCodesOkt,
                                    'usedCodesNov' => $countUsedCodesNov,
                                    'usedCodesDec' => $countUsedCodesDec,
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
                                    'codeJan' => $countCodeJan,
                                    'codeFeb' => $countCodeFeb,
                                    'codeMar' => $countCodeMar,
                                    'codeApr' => $countCodeApr,
                                    'codeMei' => $countCodeMei,
                                    'codeJun' => $countCodeJun,
                                    'codeJul' => $countCodeJul,
                                    'codeAug' => $countCodeAug,
                                    'codeSep' => $countCodeSep,
                                    'codeOkt' => $countCodeOkt,
                                    'codeNov' => $countCodeNov,
                                    'codeDec' => $countCodeDec]);
    }
}
