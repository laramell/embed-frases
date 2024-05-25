<?php
// Definindo constantes para a URL do Supabase e a API Key
define('SUPABASE_URL', $_ENV['SUPABASE_URL']);
define('SUPABASE_API_KEY', $_ENV['SUPABASE_API_KEY']);

// Função para realizar requisições cURL
function executeCurl($url, $method = 'GET', $data = null) {
    $headers = [
        "apikey: " . SUPABASE_API_KEY,
        "Authorization: Bearer " . SUPABASE_API_KEY,
        "Content-Type: application/json"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if ($method == 'POST' && $data) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    } elseif ($method == 'GET') {
        curl_setopt($ch, CURLOPT_HTTPGET, true);
    }

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);

    curl_close($ch);

    if ($httpcode >= 400) {
        echo "Erro na requisição: $httpcode<br>";
        echo "Resposta: $response<br>";
        return false;
    } elseif ($error) {
        echo "Erro cURL: $error<br>";
        return false;
    }

    return json_decode($response, true);
}

// Função para obter o número total de frases
function getTotalQuotes() {
    $url = SUPABASE_URL . "/rest/v1/frases?select=count";
    return executeCurl($url);
}

// Função para obter uma frase aleatória
function getRandomQuote() {
    $totalQuotes = getTotalQuotes();
    if ($totalQuotes && isset($totalQuotes[0]['count'])) {
        $randomOffset = rand(0, $totalQuotes[0]['count'] - 1);
        $url = SUPABASE_URL . "/rest/v1/frases?select=*&limit=1&offset=$randomOffset";
        return executeCurl($url);
    }
    return false;
}

// Função para inserir uma nova frase
function insertQuote($citacao_frase, $autor_frase) {
    $url = SUPABASE_URL . "/rest/v1/frases";
    $data = [
        'citacao_frase' => $citacao_frase,
        'autor_frase' => $autor_frase
    ];
    return executeCurl($url, 'POST', $data);
}
