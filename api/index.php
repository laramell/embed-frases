<?php
include_once 'connection.php';

$quote = getRandomQuote();


?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>LM - Frases</title>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap');
            * {
                overflow: hidden;
            }
            body{
                background: transparent;
            }
            #content {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                padding: 0 5px;
                box-sizing: border-box;
            }
            h4,h5 {
                font-family: 'Space Mono';
                font-weight: 500;
                font-size: 16px;
                margin: 0;
                width: 100%;
                <?php if ($_GET['black']){
                    echo 'color: #FFF;';
                }?>
            }
            h5 {
                font-weight: 700;
                font-size: 13px;
                text-align: left;
                margin-top: 8px;
            }
        </style>
    </head>
    <body>
        <div id="content">
            <h4>"<?= $quote[0]['citacao_frase'] ?>"</h4>
            <h5>— <?= $quote[0]['autor_frase'] ?></h5>
        </div>

        <script>
            function isDarkTheme() {
                return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            }

            if (isDarkTheme()) {
                // Aplicar estilo para tema escuro
                document.getElementsByTagName('h4')[0].style.color = '#FFF';
                document.getElementsByTagName('h5')[0].style.color = '#FFF';
            } else {
                // Aplicar estilo para tema claro
                document.getElementsByTagName('h4')[0].style.color = '#191919';
                document.getElementsByTagName('h5')[0].style.color = '#191919';
            }

        </script>
    </body>
</html>
