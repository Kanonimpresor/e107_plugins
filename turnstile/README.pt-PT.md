# Plugin Turnstile Captcha para e107

#### (Escolha o seu idioma abaixo / Choose your language below / Elija su idioma abajo)

[![Language-English](https://img.shields.io/badge/Language-English-blue)](README.md) 
[![Language-Português](https://img.shields.io/badge/Language-Português-green)](README.pt-PT.md) 
[![Language-Español](https://img.shields.io/badge/Language-Español-red)](README.es-ES.md) 

---

Um plugin de substituição para o sistema de captcha do e107, utilizando o Cloudflare Turnstile para tornar o seu site mais amigável e seguro.

## Descrição

Este plugin fornece uma alternativa moderna e fácil de usar ao sistema de captcha tradicional do e107. Utiliza o Cloudflare Turnstile, que oferece uma experiência de utilizador melhorada mantendo a segurança contra bots e spam.

## Características

- ✅ Substituição direta do sistema de captcha do e107
- ✅ Interface de utilizador mais amigável
- ✅ Integração com Cloudflare Turnstile
- ✅ Configuração simples através do painel de administração
- ✅ Compatível com e107 v2.3+

## Instalação

1. Descarregue o plugin deste repositório
2. Extraia os ficheiros da pasta `turnstile/` para o seu diretório `e107_plugins/turnstile/`
3. Vá ao painel de administração do e107
4. Navegue para **Plugins** e ative o plugin "Turnstile Captcha"
5. Configure as chaves da API na secção de configuração

## Configuração

### Obter as chaves do Cloudflare Turnstile

1. Vá ao [Painel do Cloudflare](https://dash.cloudflare.com/)
2. Selecione o seu website
3. Vá para **Security** > **Turnstile**
4. Crie um novo site e obtenha:
   - **Site Key** (Chave do site)
   - **Secret Key** (Chave secreta)

### Configurar o plugin

1. No painel de administração do e107, vá para **Plugins** > **Turnstile Captcha**
2. Clique em **Configurar**
3. Introduza as chaves obtidas do Cloudflare:
   - **Site Key**: A sua chave pública do site
   - **Secret Key**: A sua chave secreta
4. Guarde a configuração

## Ferramenta de Diagnóstico

Este plugin inclui uma ferramenta de diagnóstico para ajudar a identificar problemas de configuração e verificar a integração adequada com o Cloudflare.

### Usar a Ferramenta de Diagnóstico

1. Copie o ficheiro `e107_add/diagnose_turnstile.php` para o diretório raiz do e107
2. Aceda à ferramenta de diagnóstico através do seu navegador: `https://seu-dominio.com/diagnose_turnstile.php`
3. A ferramenta realizará as seguintes verificações:
   - **Deteção de Zona Cloudflare**: Verifica se o seu domínio está configurado corretamente no Cloudflare
   - **Configuração do Plugin**: Verifica se as chaves Turnstile estão configuradas corretamente no e107
   - **Conectividade da API**: Testa a ligação à API Turnstile do Cloudflare
   - **Informações do Servidor**: Exibe informações relevantes do servidor e domínio

### Funcionalidades do Diagnóstico

- ✅ **Deteção de Zona Cloudflare**: Deteta automaticamente se o seu domínio está por trás do Cloudflare
- ✅ **Validação de Configuração**: Verifica o formato e presença da Site Key e Secret Key
- ✅ **Teste de Conectividade da API**: Testa a ligação aos serviços Turnstile do Cloudflare
- ✅ **Recomendações Detalhadas**: Fornece soluções específicas para problemas detetados
- ✅ **Análise em Tempo Real**: Atualiza informações a cada atualização da página

### Problemas Comuns e Soluções

**Erro: "Cannot determine Turnstile's embedded location"**
- **Causa**: O domínio não está configurado no Cloudflare
- **Solução**: Adicione o seu domínio ao Cloudflare e atualize os nameservers

**Turnstile não aparece**
- **Causa**: Site Key incorreta ou domínio não está na lista permitida
- **Solução**: Verifique a Site Key e adicione o domínio à configuração Turnstile no Painel Cloudflare

### Nota de Segurança

⚠️ **Importante**: Remova o ficheiro de diagnóstico do seu servidor de produção após a resolução de problemas para manter a segurança.

## Estrutura de ficheiros

```
turnstile/
├── admin_config.php          # Painel de configuração do administrador
├── e_cloudflare_zone.php     # Funções da zona Cloudflare
├── e_domain_check.php        # Verificação de domínio
├── e_header.php              # Cabeçalhos e scripts
├── e_module.php              # Módulo principal
├── plugin.xml               # Configuração do plugin
└── images/                  # Ícones do plugin
    ├── _icon_16.png
    ├── _icon_32.png
    ├── _icon_64.png
    └── _icon_128.png
```

## Requisitos

- e107 CMS v2.3 ou superior
- PHP 7.4 ou superior
- Conta Cloudflare (gratuita disponível)
- Acesso ao painel de administração do e107

## Funcionalidades

- **Captcha Invisível**: O Turnstile funciona em segundo plano sem interromper a experiência do utilizador
- **Proteção Avançada**: Utiliza algoritmos de machine learning para detetar bots
- **Configuração Flexível**: Múltiplas opções de configuração disponíveis
- **Compatibilidade**: Funciona com todos os formulários padrão do e107

## Suporte

Para suporte técnico ou questões sobre o plugin:

- **Repositório**: [GitHub](https://github.com/Kanonimpresor/e107_plugins)
- **Documentação**: Consulte este README
- **Comunidade e107**: [Fóruns oficiais do e107](https://e107.org)

## Licença

Este plugin é distribuído sob a licença GPL v3. Consulte o ficheiro LICENSE para mais detalhes.

## Autor

Desenvolvido por **Kanonimpresor**  
GitHub: [@Kanonimpresor](https://github.com/Kanonimpresor)

---

*Este plugin não é oficialmente afiliado ao Cloudflare ou ao e107 CMS.*