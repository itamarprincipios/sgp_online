<?php
// Diagnóstico Completo de Conexão MySQL

echo "<h2>🔍 Diagnóstico Completo - SGP</h2>";

// Limpar cache
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "✅ Cache limpo<br><br>";
}

// Carregar config
$config = require 'config/config.php';

echo "<h3>📋 Configuração Atual:</h3>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Parâmetro</th><th>Valor</th></tr>";
echo "<tr><td>Host</td><td>{$config['db']['host']}</td></tr>";
echo "<tr><td>Banco</td><td>{$config['db']['dbname']}</td></tr>";
echo "<tr><td>Usuário</td><td>{$config['db']['username']}</td></tr>";
echo "<tr><td>Senha</td><td>" . str_repeat('*', strlen($config['db']['password'])) . " (" . strlen($config['db']['password']) . " caracteres)</td></tr>";
echo "<tr><td>Charset</td><td>{$config['db']['charset']}</td></tr>";
echo "</table><br>";

// Teste 1: Verificar extensão PDO
echo "<h3>🔌 Teste 1: Extensão PDO</h3>";
if (extension_loaded('pdo_mysql')) {
    echo "✅ PDO MySQL está instalado<br><br>";
} else {
    echo "❌ PDO MySQL NÃO está instalado!<br><br>";
}

// Teste 2: Tentar conexão
echo "<h3>🔗 Teste 2: Conexão com Banco</h3>";
try {
    $dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']};charset={$config['db']['charset']}";
    echo "DSN: $dsn<br>";
    
    $pdo = new PDO(
        $dsn,
        $config['db']['username'],
        $config['db']['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    echo "<br><strong style='color: green;'>✅ CONEXÃO BEM-SUCEDIDA!</strong><br>";
    
    // Teste 3: Verificar tabelas
    echo "<h3>📊 Teste 3: Tabelas no Banco</h3>";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (count($tables) > 0) {
        echo "✅ Encontradas " . count($tables) . " tabelas:<br>";
        echo "<ul>";
        foreach ($tables as $table) {
            echo "<li>$table</li>";
        }
        echo "</ul>";
    } else {
        echo "⚠️ Nenhuma tabela encontrada! Você precisa importar o database.sql<br>";
    }
    
    // Teste 4: Verificar usuários
    echo "<h3>👥 Teste 4: Verificar Usuário no Banco</h3>";
    $stmt = $pdo->query("SELECT USER()");
    $currentUser = $stmt->fetchColumn();
    echo "Usuário conectado: <strong>$currentUser</strong><br>";
    
} catch(PDOException $e) {
    echo "<strong style='color: red;'>❌ ERRO DE CONEXÃO:</strong><br>";
    echo "Código: " . $e->getCode() . "<br>";
    echo "Mensagem: " . $e->getMessage() . "<br><br>";
    
    echo "<h3>🔍 Possíveis Causas:</h3>";
    echo "<ol>";
    echo "<li><strong>Usuário não existe:</strong> Verifique se 'u19967126l_dbsgpuser' foi criado no hPanel</li>";
    echo "<li><strong>Senha incorreta:</strong> Verifique se a senha no config.php está correta</li>";
    echo "<li><strong>Sem privilégios:</strong> Usuário não foi associado ao banco 'u19967126l_dbsgp'</li>";
    echo "<li><strong>Banco não existe:</strong> Verifique se o banco 'u19967126l_dbsgp' existe</li>";
    echo "</ol>";
    
    echo "<h3>✅ Solução:</h3>";
    echo "<p>No hPanel → MySQL Databases:</p>";
    echo "<ol>";
    echo "<li>Verifique se o usuário <strong>u19967126l_dbsgpuser</strong> existe</li>";
    echo "<li>Verifique se o banco <strong>u19967126l_dbsgp</strong> existe</li>";
    echo "<li>Em 'Add User To Database', associe o usuário ao banco com ALL PRIVILEGES</li>";
    echo "</ol>";
}

echo "<hr>";
echo "<p><strong>⚠️ DELETE este arquivo após o diagnóstico!</strong></p>";
?>
