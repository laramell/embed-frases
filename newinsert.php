<?php
include_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $citacao_frase = $_POST['frase'];
    $autor_frase = $_POST['autor'];

    if(insertQuote($citacao_frase, $autor_frase) === false){
        echo "Erro ao cadastrar. Possivelmente, essa frase já está cadastrada";
    }else {
        header('Location: newfrase.html');
    }
}