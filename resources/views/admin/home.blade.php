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
        // all data
        let orderCount = $('.orderCount').data('order-count');
        let codeCount = $('.codeCount').data('code-count');
        let usedCodeCount = $('.usedCodeCount').data('used-code-count');
        // orders by month
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
        //tickets by month
        let codeJan = $('.codeJan').data('code-jan');
        let codeFeb = $('.codeFeb').data('code-feb');
        let codeMar = $('.codeMar').data('code-mar');
        let codeApr = $('.codeApr').data('code-apr');
        let codeMei = $('.codeMei').data('code-mei');
        let codeJun = $('.codeJun').data('code-jun');
        let codeJul = $('.codeJul').data('code-jul');
        let codeAug = $('.codeAug').data('code-aug');
        let codeSep = $('.codeSep').data('code-sep');
        let codeOkt = $('.codeOkt').data('code-okt');
        let codeNov = $('.codeNov').data('code-nov');
        let codeDec = $('.codeDec').data('code-dec');
        // Some raw data (not necessarily accurate)
        let data = google.visualization.arrayToDataTable([
            ['Maand', 'Orders', 'Codes', 'Gebruikte codes'],
            ['Jan',  orderJan, codeJan,0,],
            ['Feb',  orderFeb, codeFeb, 0, ],
            ['Mar',  orderMar, codeMar, 0, ],
            ['apr',  orderApr, codeApr, 0,  ],
            ['mei',  orderMei, codeMei, 0,  ],
            ['jun',  orderJun, codeJun, 0,  ],
            ['jul',  orderJul, codeJul, 0, ],
            ['aug',  orderAug, codeAug, 0,  ],
            ['sep',  orderSep, codeSep, 0,  ],
            ['okt',  orderOkt, codeOkt, 0,  ],
            ['nov',  orderNov, codeNov, 0,  ],
            ['dec',  orderDec, codeDec, 0,  ]
        ]);

        let options = {
            title : 'Orders per maand',
            vAxis: {title: 'Orders'},
            hAxis: {title: 'Maand'},
            legend: {position: 'top', textStyle: {fontSize: 10}},
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
    $(document).ready(function () {
        $(window).resize(function(){
            drawOrderChart();
        });
    });

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
                        <!-- all data-->
                        <div class="orderCount" data-order-count="{{ $orderCount }}"></div>
                        <div class="codeCount" data-code-count="{{ $codeCount }}"></div>
                        <div class="usedCodeCount" data-used-code-count="{{ $usedCodeCount }}"></div>
                        <!-- orders by month-->
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
                        <!-- tickets by month-->
                        <div class="codeJan" data-code-jan="{{ $codeJan }}"></div>
                        <div class="codeFeb" data-code-feb="{{ $codeFeb }}"></div>
                        <div class="codeMar" data-code-mar="{{ $codeMar }}"></div>
                        <div class="codeApr" data-code-apr="{{ $codeApr }}"></div>
                        <div class="codeMei" data-code-mei="{{ $codeMei }}"></div>
                        <div class="codeJun" data-code-jun="{{ $codeJun }}"></div>
                        <div class="codeJul" data-code-jul="{{ $codeJul }}"></div>
                        <div class="codeAug" data-code-aug="{{ $codeAug }}"></div>
                        <div class="codeSep" data-code-sep="{{ $codeSep }}"></div>
                        <div class="codeOkt" data-code-okt="{{ $codeOkt }}"></div>
                        <div class="codeNov" data-code-nov="{{ $codeNov }}"></div>
                        <div class="codeDec" data-code-dec="{{ $codeDec }}"></div>
                        <div class="col-md-12">
                            <div id="chart_div"></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
