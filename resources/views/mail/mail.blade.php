<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bevestiging code</title>
    <style>
        body{
            font-family: "Nunito", sans-serif;
        }
        header{
            background-color:#4d3a18;
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
    </style>
</head>
<body>
        <header>
            <h1>Code om kaarsje op te steken.</h1>
        </header>
        <div class="text-center mail-content">
            <p>Hierbij ontvangt u de code om een kaarsje op te steken. Deze kan worden verzilverd op de website en is voor eenmalig gebruik.</p>
            <p>Code: {{  $orderNumber }}</p>
            <p>Met vriendelijke groet,</p>
            <p>Giftbox.</p>
    </div>
</body>
</html>