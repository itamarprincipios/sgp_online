<?php
$dsn = 'mysql:host=localhost;dbname=u199671261_dbsgp;charset=utf8mb4';
$user = 'u199671261_dbsgpuser';
$pass = 'Sgp2025App';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo 'Conectou com sucesso';
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>
