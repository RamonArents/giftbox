@extends('layouts.app')
<!-- for safety reasons is the js included in the blade instead of an external js file-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load("current", {packages:["gauge"]});
    google.charts.setOnLoadCallback(drawOrderChart);
    /**
     * Display statistics of the order table
     * @return void, show histogram with the order data
     */
    function drawOrderChart() {
        let orderCount = $('.orderCount').data('order-count');
        let ticketCount = $('.ticketCount').data('ticket-count');
        let usedTicketCount = $('.usedTicketCount').data('used-ticket-count');
        console.log(usedTicketCount);
        let data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Orders', 0],
            ['Codes', 0],
            ['Gebruikte codes', 0]
        ]);
        //changeable, green is from 50 to 100
        let options = {
            width: 400, height: 120,
            redFrom: 1, redTo: 25,
            yellowFrom: 25, yellowTo: 50,
            greenFrom:50, greenTo:100,
            minorTicks: 1
        };

        let chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);
        //animate from 0 to the number of data
        setInterval(function() {
            data.setValue(0, 1, 0 + orderCount);
            chart.draw(data, options);
        }, 500);
        setInterval(function() {
            data.setValue(1, 1, 0 + ticketCount);
            chart.draw(data, options);
        }, 500);
        setInterval(function() {
            data.setValue(2, 1, 0 + usedTicketCount);
            chart.draw(data, options);
        }, 500);
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
                        <div id="chart_div"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
