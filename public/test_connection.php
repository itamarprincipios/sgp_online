<?php
// Teste de conexão MySQL simples

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>🔍 Teste de Conexão MySQL</h2>";

$host = 'localhost';
$dbname = 'u19967126l_dbsgp';
$username = 'u19967126l_dbsgpuser';
$password = 'Sgp2025Admin';

echo "<h3>Credenciais:</h3>";
echo "Host: $host<br>";
echo "Banco: $dbname<br>";
echo "Usuário: $username<br>";
echo "Senha: " . str_repeat('*', strlen($password)) . "<br><br>";

// Teste 1: mysqli
echo "<h3>Teste 1: MySQLi</h3>";
$mysqli = @new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
    echo "❌ Erro MySQLi: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "<br><br>";
} else {
    echo "✅ MySQLi conectou com sucesso!<br>";
    echo "Versão MySQL: " . $mysqli->server_info . "<br>";
    $mysqli->close();
    echo "<br>";
}

// Teste 2: PDO
echo "<h3>Teste 2: PDO</h3>";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "✅ PDO conectou com sucesso!<br>";
    echo "Versão: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "<br>";
} catch (PDOException $e) {
    echo "❌ Erro PDO: " . $e->getMessage() . "<br>";
    echo "Código: " . $e->getCode() . "<br>";
}

echo "<hr>";
echo "<p><strong>⚠️ DELETE este arquivo após o teste!</strong></p>";
?>
