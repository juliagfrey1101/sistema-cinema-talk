<!-- FAZER VERIFICAÇOES -->
<?php 
    require_once('dadosSeries.php');
    require_once('dadosEpisodios.php');
    
	if (!isset($_GET['serie']) || $_GET['serie'] == '') 
    {
		header('location:index.php');
		return;
	}

	$codSerie = $_GET['serie'];
	$nomeSerie = '';
	$nomeOriginal= '';
	$anoLancamento = 0;
	$categorias='';
	$sinopse = '';
    $numeroTemporadas = []; // mudar nome
    // qntd temporadas = count array q eu fiz em cima 
    $qntdEpisodios = 0;
   




	for ($i=0; $i < count($series) ; $i++) { 
		if ($series[$i]['cod'] == $codSerie)
		{
			$nome = $series[$i]['nomePortugues'];
			$nomeOriginal = $series[$i]['nomeOriginal'];
			$anoLancamento = $series[$i]['anoLancamento'];
			$genero = $series[$i]['genero'];
			$sinopse = $series[$i]['sinopse'];
			break;
		}
	}

    for ($t = 0; $t < count($Episodios); $t++) 
    {
        if ($Episodios[$t]['codSerie'] == $codSerie) 
        {
            $qntdEpisodios += 1; // soma a qunatidade de episódios
            $jaTem = false;
            
            for ($e=0; $e < count($numeroTemporadas); $e++) // passa por elementos do array que ja estao armazenados (sem repeticao)
            { 
                if ($numeroTemporadas[$e] == $Episodios[$t]['codTemporada'] )
                {
                    $jaTem = true;
                    break;
                }
            }

            if ($jaTem == false) 
            {
                array_push($numeroTemporadas , $Episodios[$t]['codTemporada'] );
            }
            
            //temporada que esta no indice 0 vai ser comparada com todas que estao no array $numeroTemporadas, para saber se ja tem ou nao
            //se condicao do if for verdadeira, temporada ja esta no array e nada acontece
            //se condiçao do if for falsa, temporada ira para a ultima posiçao do array
            //posteriormente, temporada do indice 1 vai ser comparada com as temporadas do array $numeroTemporadas e assim por diante
        }
   }

?>



<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Cinema Talk</title>
    <link rel='stylesheet' href='css/estiloGeral.css'>
    <link rel='stylesheet' href='css/mobile.css'>
</head>

<body>
    <header>
        <div id='largura' class='ConteudoHeader'> 
            <img src='images/logoCinemaTalk.png'>

            <div class='buscaHeader'>
                <input type='text' name='txtPesquisar' id='txtPesquisar' placeholder='Procurar por série,episódio,personagem,etc.'>
                <button class='btnBusca'>Buscar</button>
            </div>
        </div>

    </header>

    <section class='conteudoSerie' id='largura'>
        
    <div class='blocoSerie'>
            <div class='linha'>
            <img src='images/<?=$codSerie?>.jpg';>
                <div class='informacaoSerie'>
                    <h1><?=$nome?></h1>
                    <p>Título original: <?=$nomeOriginal?></p>
                    <p>Ano de estreia: <?=$anoLancamento?></p>
                    <p>Categorias: <?=$genero?> </p>
                    <p>Temporadas: <?= end($numeroTemporadas)?> | Episódios: <?=$qntdEpisodios?></p>
                </div>
            </div>
            <div class='NavegarSerie'>
                <a href='#'>
                    <p>Sinopse</p>
                </a>

                <a href='#'>
                    <p>Temporada e Episódios</p>
                </a>
            </div>
        </div>

        <div>
            <h1>Sinopse</h1>
            <p id='cor'><?=$sinopse?></p>    
        </div>

        <section>
            <h1>Temporadas e episódios</h1>
            <label for='slcTemporadas'>Selecione:</label>
            <select name='slcTemporadas' id='slcTemporadas'>
            <?php 
                for ($i=1; $i <= end($numeroTemporadas); $i++) 
                { 
                    echo "<option value='$i'>$i Temporada</option>";
                }

            ?>
            </select>



            <h2>1 temporada</h2>

            <div class='areaTemporada'>
                
                <?php
                    for ($i=0; $i <count($Episodios) ; $i++) 
                    { 
                        if ($Episodios[$i]['codSerie'] == $codSerie && $Episodios[$i]['codTemporada'] == '01')
                        {
                            echo "<div class='blocoEpisodio' id='borda'>

                                <h3>S{$Episodios[$i]['codTemporada']}E{$Episodios[$i]['codEpisodio']} - {$Episodios[$i]['nomeOriginal']}</h3>
                                <p class='infoEpisodio'>{$Episodios[$i]['nomePortugues']} - Exibição em {$Episodios[$i]['dataExibicao']} - {$Episodios[$i]['duracao']}</p>

                                <p>{$Episodios[$i]['resumo']}</p>
                                
                                <p class='observacaoEstilo'>Observação:</p>
                
                                <p>{$Episodios[$i]['observacao']}</p>
                              

                            </div>";
                        }
                    
                    }

                ?>

            </div>
        </section>
        
    
    </section>


</body>
</html>