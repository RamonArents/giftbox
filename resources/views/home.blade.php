@extends('layouts.app')
<!-- for safety reasons is the js included in the blade instead of an external js file-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawOrderChart);
    /**
     * Display statistics of the order table
     * @return void, show histogram with the order data
     */
    function drawOrderChart() {
        let orderCount = $('.orderCount').data('order-count');
        let ticketCount = $('.ticketCount').data('ticket-count');
        let usedTicketCount = $('.usedTicketCount').data('used-ticket-count');

        let orderJan = $('.orderJan').data('order-jan');
        let orderFeb = $('.orderFeb').data('order-feb');
        let orderMar = $('.orderMar').data('order-mar');
        let orderApr = $('.orderApr').data('order-apr');
        let orderMei = $('.orderMei').data('order-mei');
        let orderJun = $('.orderJun').data('order-jun');
        let orderJul = $('.orderJul').data('order-jul');
        let orderAug = $('.orderAug').data('order-aug');
        let orderSep = $('.orderSep').data('order-sep');
        let orderOkt = $('.orderOkt').data('order-okt');
        let orderNov = $('.orderNov').data('order-nov');
        let orderDec = $('.orderDec').data('order-dec');
        // Some raw data (not necessarily accurate)
        let data = google.visualization.arrayToDataTable([
            ['Maand', 'Orders', 'Codes', 'Gebruikte codes'],
            ['Jan',  orderJan,0,0,],
            ['Feb',  orderFeb, 0, 0, ],
            ['Mar',  orderMar, 0, 0, ],
            ['apr',  orderApr, 0, 0,  ],
            ['mei',  orderMei, 0, 0,  ],
            ['jun',  orderJun, 0, 0,  ],
            ['jul',  orderJul, 0, 0, ],
            ['aug',  orderAug, 0, 0,  ],
            ['sep',  orderSep, 0, 0,  ],
            ['okt',  orderOkt, 0, 0,  ],
            ['nov',  orderNov, 0, 0,  ],
            ['dec',  orderDec, 0, 0,  ]
        ]);

        let options = {
            title : 'Orders per maand',
            vAxis: {title: 'Orders'},
            hAxis: {title: 'Maand'},
            seriesType: 'bars',
            series: {5: {type: 'line'}}        };

        let chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    //     let data = google.visualization.arrayToDataTable([
    //         ['Label', 'Value'],
    //         ['Orders', 0],
    //         ['Codes', 0],
    //         ['Gebruikte codes', 0]
    //     ]);
    //     //changeable, green is from 50 to 100
    //     let options = {
    //         width: 400, height: 120,
    //         redFrom: 1, redTo: 25,
    //         yellowFrom: 25, yellowTo: 50,
    //         greenFrom:50, greenTo:100,
    //         minorTicks: 1
    //     };
    //
    //     let chart = new google.visualization.Gauge(document.getElementById('chart_div'));
    //
    //     chart.draw(data, options);
    //     //animate from 0 to the number of data
    //     setInterval(function() {
    //         data.setValue(0, 1, 0 + orderCount);
    //         chart.draw(data, options);
    //     }, 500);
    //     setInterval(function() {
    //         data.setValue(1, 1, 0 + ticketCount);
    //         chart.draw(data, options);
    //     }, 500);
    //     setInterval(function() {
    //         data.setValue(2, 1, 0 + usedTicketCount);
    //         chart.draw(data, options);
    //     }, 500);
   }
</script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="orderCount" data-order-count="{{ $orderCount }}"></div>
                        <div class="ticketCount" data-ticket-count="{{ $ticketCount }}"></div>
                        <div class="usedTicketCount" data-used-ticket-count="{{ $usedTicketCount }}"></div>
                        <div class="orderJan" data-order-jan="{{ $orderJan }}"></div>
                        <div class="orderFeb" data-order-feb="{{ $orderFeb }}"></div>
                        <div class="orderMar" data-order-mar="{{ $orderMar }}"></div>
                        <div class="orderApr" data-order-apr="{{ $orderApr }}"></div>
                        <div class="orderMei" data-order-mei="{{ $orderMei }}"></div>
                        <div class="orderJun" data-order-jun="{{ $orderJun }}"></div>
                        <div class="orderJul" data-order-jul="{{ $orderJul }}"></div>
                        <div class="orderAug" data-order-aug="{{ $orderAug }}"></div>
                        <div class="orderSep" data-order-sep="{{ $orderSep }}"></div>
                        <div class="orderOkt" data-order-okt="{{ $orderOkt }}"></div>
                        <div class="orderNov" data-order-nov="{{ $orderNov }}"></div>
                        <div class="orderDec" data-order-dec="{{ $orderDec }}"></div>
                        <div id="chart_div"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
