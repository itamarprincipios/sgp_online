<?php
// Script de diagnóstico e limpeza de cache

echo "<h2>🔍 Diagnóstico SGP</h2>";

// Limpar OPcache
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "✅ Cache OPcache limpo!<br>";
} else {
    echo "ℹ️ OPcache não está ativo<br>";
}

// Carregar configuração
echo "<h3>Configuração Carregada:</h3>";
$config = require 'config/config.php';

echo "Host: " . $config['db']['host'] . "<br>";
echo "Banco: " . $config['db']['dbname'] . "<br>";
echo "Usuário: " . $config['db']['username'] . "<br>";
echo "Senha: " . substr($config['db']['password'], 0, 5) . "..." . substr($config['db']['password'], -5) . "<br>";

// Verificar senha
if ($config['db']['password'] === 'lO5,pcgjc90Atp+GuS(4') {
    echo "<br>✅ Senha CORRETA no config!<br>";
} else {
    echo "<br>❌ Senha INCORRETA no config!<br>";
    echo "Esperado: lO5,pcgjc90Atp+GuS(4<br>";
    echo "Encontrado: " . $config['db']['password'] . "<br>";
}

// Testar conexão
echo "<h3>Teste de Conexão:</h3>";
try {
    $pdo = new PDO(
        "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}",
        $config['db']['username'],
        $config['db']['password']
    );
    echo "✅ <strong>CONEXÃO BEM-SUCEDIDA!</strong><br>";
    echo "Banco de dados conectado com sucesso!";
} catch(PDOException $e) {
    echo "❌ <strong>ERRO DE CONEXÃO:</strong><br>";
    echo $e->getMessage();
}

echo "<hr>";
echo "<p><strong>⚠️ DELETE este arquivo após o teste!</strong></p>";
?>
