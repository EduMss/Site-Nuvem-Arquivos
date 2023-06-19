<?php 

    $user = "../Eduardo/";

    if (isset($_POST['abrir_pasta'])){
        $diretorio = $user . $_POST['abrir_pasta'] . "/";
    } else {
        $diretorio = $user;
        echo $_POST['abrir_pasta'];
    }

    $uploadfile = $diretorio . basename($_FILES['arquivo']['name']);
    
    echo '<pre>';
    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)) {
        echo "Arquivo válido e enviado com sucesso.\n";
        echo $diretorio;
        echo $uploadfile;
        if (isset($_POST['abrir_pasta'])){
                header("location: /meuserver/cloud/?abrir_pasta=". $_POST['abrir_pasta']);
            } else {
                header("location: /meuserver/cloud/");
            }
        
    } else {
        echo "Possível ataque de upload de arquivo!\n";
    }
    
    echo 'Aqui está mais informações de debug:';
    print_r($_FILES);
    
    print "</pre>";

?>