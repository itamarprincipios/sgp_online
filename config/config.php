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
        'url' => $_ENV['APP_URL'] ?? 'http://localhost:8000',
        'timezone' => $_ENV['APP_TIMEZONE'] ?? 'America/Sao_Paulo',
        'env' => $_ENV['APP_ENV'] ?? 'development',
        'debug' => filter_var($_ENV['APP_DEBUG'] ?? 'true', FILTER_VALIDATE_BOOLEAN),
    ],
    'db' => [
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'dbname' => $_ENV['DB_NAME'] ?? 'sgp_system',
        'username' => $_ENV['DB_USER'] ?? 'root',
        'password' => $_ENV['DB_PASS'] ?? '',
        'charset' => $_ENV['DB_CHARSET'] ?? 'utf8mb4'
    ]
];
