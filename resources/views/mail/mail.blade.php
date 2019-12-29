<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bevestiging code</title>
    <style>
        body{
            font-family: "Nunito", sans-serif;
            background:#333;
        }
        header{
            background-color:saddlebrown;
            color:white;
            height: 125px;
            min-width: 100%;
            text-align: center;
            font-size:1.5em;
            padding-top:5px;
        }
        p{
            font-size:1em;
        }
        footer{
            background-color:saddlebrown;
            color:white;
            height: 80px;
            min-width: 100%;
            text-align: center;
            font-size:1.5em;
            padding-top:5px;
        }
        .mail-content{
            background-color:#f1f1f1;
            color:#2c3e50;
            padding: 10px;
            text-align: center;
            height: 100%;
            width:98.1%;
        }

    </style>
</head>
<body>
<header>
    <h1>Code om kaarsje op te steken.</h1>
</header>
<div class="mail-content">
    <p>Hierbij ontvangt u de code(s) om een kaarsje op te steken. De code(s) kunnen worden verzilverd op de website en zijn voor eenmalig gebruik.</p>
    @php $count = 0; @endphp
    <p>
    @foreach($ticketNumber as $ticket)
       Code {{ $count+=1 }}: {{  $ticket->ticketNumber }}<br />
    @endforeach
    </p>
    <p>Het is niet mogelijk om op deze email te reageren. Bij problemen kunt u contact opnemen met (plaats contactgegevens hier).</p>
    <p>Met vriendelijke groet,</p>
    <p>Giftbox.</p>
</div>
<footer>
    <p>Copyright Giftbox <script>let date = new Date(); document.write(date.getFullYear());</script></p>
</footer>
</body>
</html>