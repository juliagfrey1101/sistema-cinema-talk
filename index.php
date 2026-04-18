<?php require_once('dadosSeries.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Talk</title>
    <link rel="stylesheet" href="css/estiloGeral.css">
    <link rel="stylesheet" href="css/mobile.css">
    
</head>

<body>

    <header>
        <div id="largura" class="ConteudoHeader"> 
            <img src="images/logoCinemaTalk.png">

            <div class="buscaHeader">
                <input type="text" name="txtPesquisar" id="txtPesquisar" placeholder="Procurar por série,episódio,personagem,etc.">
                <button class="btnBusca">Buscar</button>
            </div>
        </div>
    
    </header>



    <section class="SectionSeries">
        <div class="gradeSeries" id="largura">

        <?php

            for ($i=0; $i < count($series); $i++)
            {
                echo "<div class='box'>
                <a href='serie.php?serie={$series[$i]['cod']}'>
                <img src='images/{$series[$i]['cod']}.jpg'>
                <div class='caixaLegenda'>
                
                <p class='nomeSerie'>{$series[$i]['nomePortugues']}</p>
                <p> {$series[$i]['nomeOriginal']} - {$series[$i]['anoLancamento']} - {$series[$i]['genero']} </p>   
                </div>
                </a>
              </div>";

            }

        ?>

        </div>
    </section>
    
</body>
</html>