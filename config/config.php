<?php

// Carregar variáveis de ambiente do arquivo .env (se existir)
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignorar comentários
        if (strpos(trim($line), '#') === 0) continue;
        
        // Separar chave e valor
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value, '"\'');
        }
    }
}

return [
    'app' => [
        'name' => $_ENV['APP_NAME'] ?? 'SGP - Sistema de Gestão Pedagógica',
        'url' => $_ENV['APP_URL'] ?? 'https://sgprorainopolis.com',
        'timezone' => $_ENV['APP_TIMEZONE'] ?? 'America/Sao_Paulo',
        'env' => $_ENV['APP_ENV'] ?? 'production',
        'debug' => filter_var($_ENV['APP_DEBUG'] ?? 'false', FILTER_VALIDATE_BOOLEAN),
    ],
    'db' => [
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'dbname' => $_ENV['DB_NAME'] ?? 'u19967126l_sgpBD',
        'username' => $_ENV['DB_USER'] ?? 'u19967126l_SGPBDADMIN',
        'password' => $_ENV['DB_PASS'] ?? 'I@nna2111',
        'charset' => $_ENV['DB_CHARSET'] ?? 'utf8mb4'
    ]
];
