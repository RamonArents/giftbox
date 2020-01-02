<?php
//tickets by month
$orderJan = ticket::whereMonth('created_at', '01')->get();
$countOrderJan = count($orderJan);

$orderFeb = ticket::whereMonth('created_at', '02')->get();
$countOrderFeb= count($orderFeb);

$orderMar = Order::whereMonth('created_at', '03')->get();
$countOrderMar = count($orderMar);

$orderApr = Order::whereMonth('created_at', '04')->get();
$countOrderApr = count($orderApr);

$orderMei = Order::whereMonth('created_at', '05')->get();
$countOrderMei = count($orderMei);

$orderJun = Ticket::whereMonth('created_at', '06')->get();
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