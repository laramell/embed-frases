<?php
include_once 'connection.php';

$quote = getRandomQuote();

if ($quote) {
    echo "Frase: " . htmlspecialchars($quote[0]['citacao_frase']) . "<br>";
    echo "Autor: " . htmlspecialchars($quote[0]['autor_frase']);
} else {
    echo "Nenhuma frase encontrada.";
}