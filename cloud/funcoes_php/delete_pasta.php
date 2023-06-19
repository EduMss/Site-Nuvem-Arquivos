<?php 
//is_dir  = verificar se é um diretório/ verificar se o diretório existe
//mkdir   = Cria um diretório 
//scandir = Lista o diretório
//rmdir   = Remove o diretório


    $arquivo_delete = $_GET['arquivo_deletar'];
    $abrir_pasta = $_GET['abrir_pasta'];
    $user = $_GET['user'];

    if(isset($abrir_pasta)){
        $diretorio = "../". $user ."/" . $abrir_pasta . "/" . $arquivo_delete;
    } else {
        $diretorio = "../". $user ."/" . $arquivo_delete;
    }


    function delTree($dir) { 
        $files = array_diff(scandir($dir), array('.','..')); 
        foreach ($files as $file) { 
          (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
        } 
        return rmdir($dir); 
      }
  
    if(file_exists($diretorio)) {
        // echo "O Arquivo  existe";
        // unlink($diretorio);
        delTree($diretorio);
        if(isset($abrir_pasta)){
            header("location: /meuserver/cloud/?abrir_pasta=". $abrir_pasta);
        } else {
            header("location: /meuserver/cloud/");
        }
        
    } else {
        // echo "O Arquivo Não existe";
    }

    
?>