<?php 
//is_dir  = verificar se é um diretório/ verificar se o diretório existe
//mkdir   = Cria um diretório 
//scandir = Lista o diretório
//rmdir   = Remove o diretório

    $diretorio = "Eduardo";
    if(!is_dir($diretorio)) {
        mkdir($diretorio);
    }

    $listaDiretorio = scandir($diretorio);

    $listas['imagens'] = array('.jpeg', '.jpg', '.png');
    $listas['musicas'] = array('.mp3','.WAV','.MP3');
    $listas['videos'] = array('.mp4','.mov','.MP4','.WMV','.wmv','.AVI','.avi','.MKV','.mkv');
    $listas['office'] = array('.docx','.xlsx','.pptx','.DOC','.doc');
    $listas['compactado'] = array('.zip','.rar');
    $listas['pdf'] = array('.pdf');
    $listas['texto'] = array('.txt');

    $listaIcones['imagens'] = "./Imagens/icones/imagem.png";
    $listaIcones['musicas'] = "./Imagens/icones/musica.png";
    $listaIcones['videos'] = "./Imagens/icones/video.png";
    $listaIcones['office'] = "./Imagens/icones/escritorio.png";
    $listaIcones['compactado'] = "./Imagens/icones/formato-de-arquivo-zip.png";
    $listaIcones['pdf'] = "./Imagens/icones/pasficheiro-pdfta.png";
    $listaIcones['texto'] = "./Imagens/icones/arquivo-de-texto.png";
    $listaIcones['pasta'] = "./Imagens/icones/pasta.png";
    $listaIcones['desconhecido'] = "./Imagens/icones/desconhecido.png";
    $listaIcones['mais'] = "./Imagens/icones/mais.png";
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stryle.css">

    <title>Cloud</title>
</head>
<body>
    <div class="area-itens">
        <form class="item" id="my_form" method="post" action="./funcoes_php/upload.php" enctype="multipart/form-data">
            <img class="imagem-arquivo" src="./Imagens/icones/mais.png">
            
            <div class="item-descricao">
                <label class="label-input-file-upload" for="arquivo">Selecionar arquivo</label>
                <input type="file" name="arquivo" id="arquivo">

                <a class="item-link" href="javascript:{}" onclick="document.getElementById('my_form').submit(); return false;">
                    <label class="label-input-submit-upload" for="arquivo">Enviar Arquivo</label>
                </a>
                    
            </div>
            

        </form>
    </div>
</body>
</html>