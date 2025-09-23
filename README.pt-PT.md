# Coleção de Plugins e107

#### (Choose your language below / Escolha o seu idioma abaixo / Elija su idioma abajo)

[![Language-English](https://img.shields.io/badge/Language-English-blue)](README.md) 
[![Language-Português](https://img.shields.io/badge/Language-Português-green)](README.pt-PT.md) 
[![Language-Español](https://img.shields.io/badge/Language-Español-red)](README.es-ES.md) 

---

## Bem-vindo ao Repositório de Plugins e107

Este repositório contém uma coleção curada de plugins especificamente desenvolvidos para **e107 Bootstrap CMS v2.3.x**. Cada plugin é desenvolvido seguindo os padrões e melhores práticas do e107 para garantir compatibilidade e desempenho otimizado.

## ��� Plugins Disponíveis

### ��� Plugin Turnstile Captcha
Uma solução CAPTCHA moderna e focada na privacidade usando a tecnologia Cloudflare Turnstile para e107 CMS.

**Características Principais:**
- ✅ Integração com Cloudflare Turnstile
- ��� Suporte multi-idioma (Inglês, Espanhol, Português)
- ⚙️ Opções de configuração avançadas
- ��� Validação de domínio e verificações de segurança
- ���️ Ferramentas de diagnóstico integradas
- ��� Amigável para dispositivos móveis e acessível

**Documentação do Plugin:**
- [��� Documentação em Inglês](turnstile/README.md)
- [��� Documentación en Español](turnstile/README.es-ES.md)
- [��� Documentação em Português](turnstile/README.pt-PT.md)

## ��� Requisitos do Sistema

- **e107 CMS:** v2.3.x (versão Bootstrap)
- **PHP:** 7.4 ou superior
- **MySQL:** 5.7 ou superior / MariaDB 10.2+
- **Servidor Web:** Apache 2.4+ ou Nginx 1.18+
- **Conexão à Internet:** Necessária para serviços Cloudflare

## ��� Guia de Instalação

1. **Baixar Plugin:** Escolha o plugin desejado da respectiva pasta
2. **Enviar Arquivos:** Extraia e envie para o diretório `e107_plugins/` do seu e107
3. **Instalar Plugin:** Navegue até Painel Admin e107 → Gerenciador de Plugins
4. **Ativar:** Clique em "Instalar" no plugin escolhido
5. **Configurar:** Acesse as configurações do plugin através do Painel Admin

## ���️ Estrutura do Repositório

```
e107_plugins/
├── README.md                    # Documentação principal (Inglês)
├── README.pt-PT.md             # Documentação em Português
├── README.es-ES.md             # Documentação em Espanhol
├── .gitignore                  # Regras do Git ignore
├── turnstile/                  # Plugin Turnstile Captcha
│   ├── README.md              # Documentação do plugin
│   ├── plugin.xml             # Configuração do plugin
│   ├── admin_config.php       # Interface administrativa
│   ├── e107_add/             # Ferramentas adicionais
│   └── [arquivos do plugin...] # Arquivos principais do plugin
└── [plugins futuros]/          # Espaço para plugins adicionais
```

## ��� Contribuindo

Damos as boas-vindas às contribuições da comunidade e107! Veja como você pode ajudar:

1. **Fork** este repositório
2. **Criar** uma branch de funcionalidade (`git checkout -b feature/plugin-incrivel`)
3. **Commit** suas alterações (`git commit -m 'Adicionar plugin incrível'`)
4. **Push** para a branch (`git push origin feature/plugin-incrivel`)
5. **Abrir** um Pull Request

### Diretrizes de Desenvolvimento de Plugins
- Siga os padrões de codificação do e107
- Inclua documentação abrangente
- Forneça suporte multi-idioma quando possível
- Teste com e107 Bootstrap CMS v2.3.x
- Inclua tratamento adequado de erros

## ��� Suporte e Comunidade

- **Problemas de Plugin:** Verifique a documentação individual do plugin
- **Suporte Geral:** [Fóruns da Comunidade e107](https://e107.org/forum)
- **Relatórios de Bug:** Use GitHub Issues para este repositório
- **Solicitações de Funcionalidades:** Envie via GitHub Issues

## ��� Licença

Cada plugin pode ter seus próprios termos de licença. Por favor, verifique os diretórios individuais dos plugins para informações específicas de licença. A maioria dos plugins neste repositório são lançados sob licenças compatíveis com GPL.

## ��� Roteiro

- ��� Soluções CAPTCHA adicionais
- ���️ Plugins de segurança aprimorados
- ��� Ferramentas de análise e relatórios
- ��� Plugins de aprimoramento de temas
- ��� Plugins de comunicação avançados

---

**Nota:** Este é um repositório orientado pela comunidade focado em plugins de alta qualidade para e107 Bootstrap CMS v2.3.x. Cada plugin é minuciosamente testado e documentado para garantir a melhor experiência para usuários e107.
