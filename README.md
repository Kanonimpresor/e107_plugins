# e107 Plugins Collection

#### (Choose your language below / Escolha o seu idioma abaixo / Elija su idioma abajo)

[![Language-English](https://img.shields.io/badge/Language-English-blue)](README.md) 
[![Language-Português](https://img.shields.io/badge/Language-Português-green)](README.pt-PT.md) 
[![Language-Español](https://img.shields.io/badge/Language-Español-red)](README.es-ES.md) 

---

## Welcome to e107 Plugins Repository

This repository contains a curated collection of plugins specifically designed for **e107 Bootstrap CMS v2.3.x**. Each plugin is developed following e107 standards and best practices to ensure compatibility and optimal performance.

## � Available Plugins

### � Turnstile Captcha Plugin
A modern, privacy-focused CAPTCHA solution using Cloudflare Turnstile technology for e107 CMS.

**Key Features:**
- ✅ Cloudflare Turnstile integration
- � Multi-language support (English, Spanish, Portuguese)
- ⚙️ Advanced configuration options
- � Domain validation and security checks
- �️ Built-in diagnostic tools
- � Mobile-friendly and accessible

**Plugin Documentation:**
- [� English Documentation](turnstile/README.md)
- [� Documentación en Español](turnstile/README.es-ES.md)
- [� Documentação em Português](turnstile/README.pt-PT.md)

## � System Requirements

- **e107 CMS:** v2.3.x (Bootstrap version)
- **PHP:** 7.4 or higher
- **MySQL:** 5.7 or higher / MariaDB 10.2+
- **Web Server:** Apache 2.4+ or Nginx 1.18+
- **Internet Connection:** Required for Cloudflare services

## �� Installation Guide

1. **Download Plugin:** Choose your desired plugin from its respective folder
2. **Upload Files:** Extract and upload to your e107 `e107_plugins/` directory
3. **Install Plugin:** Navigate to e107 Admin Panel → Plugin Manager
4. **Activate:** Click "Install" on your chosen plugin
5. **Configure:** Access plugin settings through Admin Panel

## �️ Repository Structure

```
e107_plugins/
├── README.md                    # Main documentation (English)
├── README.pt-PT.md             # Portuguese documentation
├── README.es-ES.md             # Spanish documentation
├── .gitignore                  # Git ignore rules
├── turnstile/                  # Turnstile Captcha Plugin
│   ├── README.md              # Plugin documentation
│   ├── plugin.xml             # Plugin configuration
│   ├── admin_config.php       # Admin interface
│   ├── e107_add/             # Additional tools
│   └── [plugin files...]     # Core plugin files
└── [future plugins]/          # Space for additional plugins
```

## � Contributing

We welcome contributions from the e107 community! Here's how you can help:

1. **Fork** this repository
2. **Create** a feature branch (`git checkout -b feature/amazing-plugin`)
3. **Commit** your changes (`git commit -m 'Add amazing plugin'`)
4. **Push** to the branch (`git push origin feature/amazing-plugin`)
5. **Open** a Pull Request

### Plugin Development Guidelines
- Follow e107 coding standards
- Include comprehensive documentation
- Provide multi-language support when possible
- Test with e107 Bootstrap CMS v2.3.x
- Include proper error handling

## � Support & Community

- **Plugin Issues:** Check individual plugin documentation
- **General Support:** [e107 Community Forums](https://e107.org/forum)
- **Bug Reports:** Use GitHub Issues for this repository
- **Feature Requests:** Submit via GitHub Issues

## � License

Each plugin may have its own license terms. Please check individual plugin directories for specific license information. Most plugins in this repository are released under GPL-compatible licenses.

## � Roadmap

- � Additional CAPTCHA solutions
- �️ Enhanced security plugins
- � Analytics and reporting tools
- � Theme enhancement plugins
- � Advanced communication plugins

---

**Note:** This is a community-driven repository focused on high-quality plugins for e107 Bootstrap CMS v2.3.x. Each plugin is thoroughly tested and documented to ensure the best experience for e107 users.
