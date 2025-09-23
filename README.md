# e107 Plugins Collection

This repository contains a collection of plugins for the e107 Content Management System.

## Available Plugins

### ��� Turnstile Captcha Plugin
A modern CAPTCHA solution using Cloudflare Turnstile technology for e107 CMS.

**Features:**
- Cloudflare Turnstile integration
- Multi-language support (English, Spanish, Portuguese)
- Advanced configuration options
- Domain validation
- Diagnostic tools included

**Documentation:**
- [English Documentation](turnstile/README.md)
- [Documentación en Español](turnstile/README.es-ES.md)
- [Documentação em Português](turnstile/README.pt-PT.md)

## Installation

1. Download the desired plugin from its respective folder
2. Upload to your e107 `e107_plugins/` directory
3. Install through e107 Admin Panel → Plugin Manager

## Requirements

- e107 CMS v2.x or higher
- PHP 7.4 or higher
- Active internet connection (for Cloudflare services)

## Contributing

Contributions are welcome! Please:
1. Fork this repository
2. Create a feature branch
3. Submit a pull request

## Support

For plugin-specific support, please refer to the individual plugin documentation.

## License

Each plugin may have its own license. Please check individual plugin directories for license information.

## Repository Structure

```
e107_plugins/
├── README.md                    # This file
├── turnstile/                   # Turnstile Captcha Plugin
│   ├── README.md               # Plugin documentation
│   ├── plugin.xml              # Plugin configuration
│   └── [plugin files]
└── [future plugins]/           # Additional plugins will be added here
```

---

**Note:** This is a multi-plugin repository. Each plugin is contained in its own directory with complete documentation and installation instructions.
