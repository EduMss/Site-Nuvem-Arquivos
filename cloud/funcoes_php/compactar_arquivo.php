<?php 
$nomePasta = "pasta_teste";
$dirSalvar = "../Eduardo/";
$diretorio = getcwd()."/$nomePasta/";

// Instancia a Classe Zip;
$zip = new ZipArchive();
// Cria o Arquivo Zip, caso não consiga exibe mensagem de erro e finaliza script

function adicinarZip($zip,$diretorio,$pasta){
    $dir = opendir($diretorio);
    while($file = readdir($dir)) {
        if(is_file($diretorio.$file)) {
            $zip -> addFile($diretorio.$file, $pasta.$file);
        } else {
            if ($file != "." && $file != ".."){
                $zip->addEmptyDir($pasta.$file);
                adicinarZip($zip, $diretorio.$file."/", $pasta.$file."/");
            }
        }
    }
}

if($zip -> open("$dirSalvar$nomePasta.zip", ZipArchive::CREATE ) === TRUE) {
       
    adicinarZip($zip,$diretorio,"");
    

    $zip ->close();
}
?>