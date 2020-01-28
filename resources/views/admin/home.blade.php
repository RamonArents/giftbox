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
        //codes by month
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
        //used codes by month
        let usedCodeJan = $('.usedCodeJan').data('used-code-jan');
        let usedCodeFeb = $('.usedCodeFeb').data('used-code-feb');
        let usedCodeMar = $('.usedCodeMar').data('used-code-mar');
        let usedCodeApr = $('.usedCodeApr').data('used-code-apr');
        let usedCodeMei = $('.usedCodeMei').data('used-code-mei');
        let usedCodeJun = $('.usedCodeJun').data('used-code-jun');
        let usedCodeJul = $('.usedCodeJul').data('used-code-jul');
        let usedCodeAug = $('.usedCodeAug').data('used-code-aug');
        let usedCodeSep = $('.usedCodeSep').data('used-code-sep');
        let usedCodeOkt = $('.usedCodeOkt').data('used-code-okt');
        let usedCodeNov = $('.usedCodeNov').data('used-code-nov');
        let usedCodeDec = $('.usedCodeDec').data('used-code-dec');
        // Some raw data (not necessarily accurate)
        let data = google.visualization.arrayToDataTable([
            ['Maand', 'Orders', 'Codes', 'Gebruikte codes'],
            ['Jan',  orderJan, codeJan, usedCodeJan,],
            ['Feb',  orderFeb, codeFeb, usedCodeFeb, ],
            ['Mar',  orderMar, codeMar, usedCodeMar, ],
            ['apr',  orderApr, codeApr, usedCodeApr,  ],
            ['mei',  orderMei, codeMei, usedCodeMei,  ],
            ['jun',  orderJun, codeJun, usedCodeJun,  ],
            ['jul',  orderJul, codeJul, usedCodeJul, ],
            ['aug',  orderAug, codeAug, usedCodeAug,  ],
            ['sep',  orderSep, codeSep, usedCodeSep,  ],
            ['okt',  orderOkt, codeOkt, usedCodeOkt,  ],
            ['nov',  orderNov, codeNov, usedCodeNov,  ],
            ['dec',  orderDec, codeDec, usedCodeDec,  ]
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
                        {{--<div class="orderCount" data-order-count="{{ $orderCount }}"></div>--}}
                        {{--<div class="codeCount" data-code-count="{{ $codeCount }}"></div>--}}
                        {{--<div class="usedCodeCount" data-used-code-count="{{ $usedCodeCount }}"></div>--}}
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
                        <!-- codes by month-->
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
                        <!--used codes by month-->
                        <div class="usedCodeJan" data-used-code-jan="{{ $usedCodesJan }}"></div>
                        <div class="usedCodeFeb" data-used-code-feb="{{ $usedCodesFeb }}"></div>
                        <div class="usedCodeMar" data-used-code-mar="{{ $usedCodesMar }}"></div>
                        <div class="usedCodeApr" data-used-code-apr="{{ $usedCodesApr }}"></div>
                        <div class="usedCodeMei" data-used-code-mei="{{ $usedCodesMei }}"></div>
                        <div class="usedCodeJun" data-used-code-jun="{{ $usedCodesJun }}"></div>
                        <div class="usedCodeJul" data-used-code-jul="{{ $usedCodesJul }}"></div>
                        <div class="usedCodeAug" data-used-code-aug="{{ $usedCodesAug }}"></div>
                        <div class="usedCodeSep" data-used-code-sep="{{ $usedCodesSep }}"></div>
                        <div class="usedCodeOkt" data-used-code-okt="{{ $usedCodesOkt }}"></div>
                        <div class="usedCodeNov" data-used-code-nov="{{ $usedCodesNov }}"></div>
                        <div class="usedCodeDec" data-used-code-dec="{{ $usedCodesDec }}"></div>
                        <div class="col-md-12">
                            <div id="chart_div"></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
