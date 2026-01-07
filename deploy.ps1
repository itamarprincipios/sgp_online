# Script de Deploy para Windows/PowerShell
# Este script copia o .env.production para .env

Write-Host "🚀 Iniciando deploy..." -ForegroundColor Green

# Copiar .env.production para .env
if (Test-Path .env.production) {
    Copy-Item .env.production .env -Force
    Write-Host "✅ Arquivo .env criado com sucesso!" -ForegroundColor Green
} else {
    Write-Host "❌ Erro: .env.production não encontrado!" -ForegroundColor Red
    exit 1
}

# Verificar se a pasta uploads existe
if (-not (Test-Path "public/uploads")) {
    New-Item -ItemType Directory -Path "public/uploads" -Force
    Write-Host "✅ Pasta uploads criada!" -ForegroundColor Green
}

Write-Host "🎉 Deploy concluído com sucesso!" -ForegroundColor Green
Write-Host ""
Write-Host "📋 Próximos passos:" -ForegroundColor Yellow
Write-Host "1. Acesse https://sgprorainopolis.com"
Write-Host "2. Faça login com: semed@sgp.com / password"
Write-Host "3. Altere a senha padrão!"
