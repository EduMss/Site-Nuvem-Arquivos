<?php 
    $itemBaixar = $_GET['arquivoBaixar'];
    $dir = $_GET['dir'];
    $user = $_GET['user'];

    if(!is_dir("../downloadZip/".$user)) {
        mkdir("../downloadZip/".$user);
    }

    $dirSalvar = $_SERVER['DOCUMENT_ROOT']. "/meuserver/cloud/downloadZip/".$user;
    $diretorio = $_SERVER['DOCUMENT_ROOT']. "/meuserver/cloud/". $dir . "/" . $itemBaixar;

    $arquivo = "../downloadZip/". $user ."/". $itemBaixar .".zip";
    if(isset($arquivo) && file_exists($arquivo)){
        unlink($arquivo);
    }

    $zip = new ZipArchive();

    function adicinarZip($zip,$diretorio,$pasta){
        $dir = opendir($diretorio);

        while($file = readdir($dir)) {
            if(is_file($diretorio.$file)) {
                $zip -> addFile($diretorio.$file, $pasta.$file);
            } else {
                if ($file != "." && $file != ".."){
                    $zip->addEmptyDir($pasta.$file);

                    $dirDosProximosAdd = $diretorio.$file."/";
                    $dirDoZip = $pasta.$file."/";

                    adicinarZip($zip, $dirDosProximosAdd , $dirDoZip);
                }
            }
        }
    }

    if($zip -> open($arquivo, ZipArchive::CREATE ) === TRUE) {
        $zip->addEmptyDir($itemBaixar);
        adicinarZip($zip, $diretorio."/", $itemBaixar."/");
        $zip ->close();
    }


    //donwload .zip

    if(isset($arquivo) && file_exists($arquivo)){
    // faz o teste se a variavel não esta vazia e se o arquivo realmente existe

    /*
          switch(strtolower(substr(strrchr(basename($arquivo),"."),1))){
            // verifica a extensão do arquivo para pegar o tipo
            case "pdf": $tipo="application/pdf"; break;
            case "exe": $tipo="application/octet-stream"; break;
            case "zip": $tipo="application/zip"; break;
            case "doc": $tipo="application/msword"; break;
            case "xls": $tipo="application/vnd.ms-excel"; break;
            case "ppt": $tipo="application/vnd.ms-powerpoint"; break;
            case "gif": $tipo="image/gif"; break;
            case "png": $tipo="image/png"; break;
            case "jpg": $tipo="image/jpg"; break;
            case "mp3": $tipo="audio/mpeg"; break;
            case "php": // deixar vazio por seurança
            case "htm": // deixar vazio por seurança
            case "html": // deixar vazio por seurança
        }
    */

    // verifica a extensão do arquivo para pegar o tipo
        $tipo="application/zip";
        // $tipo="image/png";

    header("Content-Type: ".$tipo);
    // informa o tipo do arquivo ao navegador
    header("Content-Length: ".filesize($arquivo));
    // informa o tamanho do arquivo ao navegador
    header("Content-Disposition: attachment; filename=".basename($arquivo));
    // informa ao navegador que é tipo anexo e faz abrir a janela de download,
    //tambem informa o nome do arquivo
    readfile($arquivo); // lê o arquivo

    // exit; // aborta pós-ações
    }

    if(isset($arquivo) && file_exists($arquivo)){
        unlink($arquivo);
        exit;
    } else {
        exit;
    }



?>