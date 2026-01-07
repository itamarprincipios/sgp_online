<?php

function url($path = '') {
    // Detectar o diretório base automaticamente
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $baseDir = str_replace('\\', '/', dirname($scriptName));
    
    // Se estiver na pasta public, remover /public do base
    if (basename($baseDir) === 'public') {
        $baseDir = dirname($baseDir);
    }
    
    // Garantir que baseDir termine sem barra
    $baseDir = rtrim($baseDir, '/');
    
    // Se o path for vazio, retornar apenas o baseDir
    if (empty($path)) {
        return $baseDir ?: '/';
    }
    
    // Para assets (css, js, img), adicionar /public/
    if (preg_match('/\.(css|js|png|jpg|jpeg|gif|svg|ico|woff|woff2|ttf)$/i', $path)) {
        return $baseDir . '/public/' . ltrim($path, '/');
    }
    
    // Para rotas normais
    return $baseDir . '/' . ltrim($path, '/');
}


function redirect($path) {
    header("Location: " . url($path));
    exit;
}

function view($viewName, $data = []) {
    extract($data);
    $viewPath = __DIR__ . '/../Views/' . $viewName . '.php';
    
    if (file_exists($viewPath)) {
        require_once $viewPath;
    } else {
        die("View not found: $viewName");
    }
}

function dd($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die;
}

function session($key, $default = null) {
    return $_SESSION[$key] ?? $default;
}

function auth() {
    return $_SESSION['user'] ?? null;
}

function log_debug($msg) {
    file_put_contents(__DIR__ . '/../../debug_auth.log', date('Y-m-d H:i:s') . " - " . $msg . "\n", FILE_APPEND);
}

function checkAuth($role = null) {
    if (!auth()) {
        log_debug("checkAuth: No auth, redirecting login");
        redirect('login');
    }

    $userRole = auth()['role'];
    log_debug("checkAuth: Requested '$role', User has '$userRole'");

    if ($role && $userRole !== $role) {
        log_debug("checkAuth: Role mismatch. Redirecting based on user role '$userRole'.");
        if($userRole == 'semed') redirect('semed/dashboard');
        if($userRole == 'coordinator') redirect('school/dashboard'); 
        if($userRole == 'professor') redirect('professor/dashboard');
        if($userRole == 'admin') redirect('admin/dashboard');
    }
}
