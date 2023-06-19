<?php 
//is_dir  = verificar se é um diretório/ verificar se o diretório existe
//mkdir   = Cria um diretório 
//scandir = Lista o diretório
//rmdir   = Remove o diretório

    function delete_aquivo(){
        echo "fui executado";
    }
    if (isset($_GET['delete_arquivo'])){
        delete_aquivo();
    }


    $user = "Eduardo";

    if (isset($_GET['abrir_pasta'])){
        $DentroPasta = true;
        $diretorio = $user .  "/" . $_GET['abrir_pasta'];
        $pasta_aberta = $_GET['abrir_pasta'];
    } else {
        $DentroPasta = false;
        $diretorio = $user;
    }

    
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
    $listaIcones['lixeira'] = "./Imagens/icones/lixeira.png";
    $listaIcones['voltar'] = "./Imagens/icones/voltar.png";
    
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
        <!-- UPLOAD -->
        <form class="item" id="my_form" method="POST" action="./funcoes_php/upload.php" enctype="multipart/form-data">
                <img class="imagem-arquivo" src="./Imagens/icones/mais.png">
                
                <div class="item-descricao">
                    <?php 
                        if($DentroPasta == true){
                            echo "<input type=\"hidden\" name=\"abrir_pasta\" id=\"abrir_pasta\" value=\"" .$_GET['abrir_pasta']. "\">";
                        }
                    ?>
                    
                    <label class="label-input-file-upload" for="arquivo">Selecionar arquivo</label>
                    <input type="file" name="arquivo" id="arquivo">

                    <a class="item-link" href="javascript:{}" onclick="document.getElementById('my_form').submit(); return false;">
                        <label class="label-input-submit-upload" for="arquivo">Enviar Arquivo</label>
                    </a>
                        
                </div>
                

            </form>

            <?php 
            
            if (isset($_GET['abrir_pasta'])){

                $iconeArquivo = $listaIcones['voltar'];

                if($DentroPasta == true & str_contains($pasta_aberta, "/") == true) {
                        $pasta_anterior = explode("/",$pasta_aberta);
                        echo "<a href=\" /meuserver/cloud/?abrir_pasta=$pasta_anterior[0]\" >
                            <div class=\"item\">
                                <img class=\"imagem-arquivo\" src=\"$iconeArquivo\">
                                <div class=\"item-descricao\">
                                    <p>Voltar</p>
                                </div>
                            </div></a>";
                } else {
                    echo "<a href=\" /meuserver/cloud/\" >
                        <div class=\"item\">
                            <img class=\"imagem-arquivo\" src=\"$iconeArquivo\">
                            <div class=\"item-descricao\">
                                <p>Voltar</p>
                            </div>
                        </div></a>";
                }
            }

            ?>

        <?php 

        
            foreach($listaDiretorio as $itemDiretorio){

                // Se o diretorio for . ou .., n mostrar para o usuario
                if ($itemDiretorio == "." || $itemDiretorio == "..") {

                // mostrar as pastas 
                } elseif (is_dir("../cloud/" . $diretorio . "/" . $itemDiretorio)) {
                    
                    
                    $iconeArquivo = $listaIcones['pasta'];

                    if($DentroPasta == True) {

                        echo "<a href=\"?abrir_pasta=$pasta_aberta/$itemDiretorio\" >
                        <div class=\"item\">
                            <img class=\"imagem-arquivo\" src=\"$iconeArquivo\">
                            <div class=\"item-descricao\">
                                <p>$itemDiretorio</p>
                                <div class=\"item-descricao-botoes\">
                                    <a href=\"./funcoes_php/baixar_pasta.php?arquivoBaixar=$itemDiretorio&user=$user&dir=$diretorio\" ><img class=\"imagem-download\" src=\"./Imagens/icones/icon-download.png\"></a>
                                    <a href=\"./funcoes_php/delete_pasta.php?arquivo_deletar=$itemDiretorio&user=$user\" ><img class=\"imagem-download\" src=\"./Imagens/icones/lixeira.png\"></a>
                                </div>
                            </div>
                        </div></a>";
                    } else {


                    echo "<a href=\"?abrir_pasta=$itemDiretorio\" >
                        <div class=\"item\">
                            <img class=\"imagem-arquivo\" src=\"$iconeArquivo\">
                            <div class=\"item-descricao\">
                                <p>$itemDiretorio</p>
                                <div class=\"item-descricao-botoes\">
                                    <a href=\"./funcoes_php/baixar_pasta.php?arquivoBaixar=$itemDiretorio&user=$user&dir=$diretorio\" ><img class=\"imagem-download\" src=\"./Imagens/icones/icon-download.png\"></a>
                                    <a href=\"./funcoes_php/delete_pasta.php?arquivo_deletar=$itemDiretorio&user=$user\" ><img class=\"imagem-download\" src=\"./Imagens/icones/lixeira.png\"></a>
                                </div>
                            </div>
                        </div></a>";
                    
                    }
 
                // mostrar os arquivos
                } else {
                    $tipo = strrchr($itemDiretorio,".");

                    if(in_array($tipo, $listas['imagens']) === true){
                        $iconeArquivo = $listaIcones['imagens'];

                    } else if (in_array($tipo, $listas['musicas']) === true) {
                        $iconeArquivo = $listaIcones['musicas'];

                    } else if (in_array($tipo, $listas['videos']) === true) {
                        $iconeArquivo = $listaIcones['videos'];

                    } else if (in_array($tipo, $listas['office']) === true) {
                        $iconeArquivo = $listaIcones['office'];

                    } else if (in_array($tipo, $listas['compactado']) === true) {
                        $iconeArquivo = $listaIcones['compactado'];

                    } else if (in_array($tipo, $listas['pdf']) === true) {
                        $iconeArquivo = $listaIcones['pdf'];

                    } else if (in_array($tipo, $listas['texto']) === true) {
                        $iconeArquivo = $listaIcones['texto'];

                    } else {
                        $iconeArquivo = $listaIcones['desconhecido'];
                    }

                    if (isset($_GET['abrir_pasta'])){
                        $abrir_pasta = "&abrir_pasta=" . $_GET['abrir_pasta'];
                    } else {
                        $abrir_pasta = "";
                    }

                    echo "<div class=\"item\">
                            <img class=\"imagem-arquivo\" src=\"$iconeArquivo\">
                            <div class=\"item-descricao\">
                                <p>$itemDiretorio</p>
                                <div class=\"item-descricao-botoes\">
                                    <a href=\"../cloud/$diretorio/$itemDiretorio\" download=\"$itemDiretorio\"><img class=\"imagem-download\" src=\"./Imagens/icones/icon-download.png\"></a>
                                    <a href=\"./funcoes_php/delete_arquivo.php?arquivo_deletar=$itemDiretorio&user=$user\" ><img class=\"imagem-download\" src=\"./Imagens/icones/lixeira.png\"></a>
                                </div>
                            </div>
                        </div>";
                }
            }
            
        ?>
    </div>

</body>

<!-- <script src="./script.js"></script> -->
</html>