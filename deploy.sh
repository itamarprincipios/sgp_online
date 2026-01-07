#!/bin/bash

# Script de Deploy para Hostinger
# Este script copia o .env.production para .env no servidor

echo "🚀 Iniciando deploy..."

# Copiar .env.production para .env
if [ -f .env.production ]; then
    cp .env.production .env
    echo "✅ Arquivo .env criado com sucesso!"
else
    echo "❌ Erro: .env.production não encontrado!"
    exit 1
fi

# Ajustar permissões
chmod 644 .env
echo "✅ Permissões ajustadas!"

# Verificar se a pasta uploads existe
if [ ! -d "public/uploads" ]; then
    mkdir -p public/uploads
    chmod 755 public/uploads
    echo "✅ Pasta uploads criada!"
fi

echo "🎉 Deploy concluído com sucesso!"
echo ""
echo "📋 Próximos passos:"
echo "1. Acesse https://sgprorainopolis.com"
echo "2. Faça login com: semed@sgp.com / password"
echo "3. Altere a senha padrão!"
