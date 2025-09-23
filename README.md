# e107 Plugins Collection

A collection of plugins for the e107 Content Management System.

## Available Plugins

### ��� Turnstile Captcha Plugin
**Location:** `turnstile/`

A modern replacement for the e107 captcha system using Cloudflare Turnstile technology.

**Features:**
- ✅ Direct replacement for e107 captcha system
- ✅ More user-friendly interface than traditional captcha
- ✅ Cloudflare Turnstile integration
- ✅ Simple configuration from admin panel
- ✅ Compatible with e107 v2.3+
- ✅ Includes diagnostic tool for troubleshooting

**Documentation:**
- [English](turnstile/README.md)
- [Português](turnstile/README.pt-PT.md)
- [Español](turnstile/README.es-ES.md)

---

## Installation

Each plugin has its own installation instructions. Please refer to the individual plugin documentation for specific installation steps.

## Requirements

- e107 CMS v2.3 or higher
- PHP 7.0 or higher
- Web server (Apache/Nginx)

## Contributing

If you'd like to contribute to any of these plugins:

1. Fork this repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## Support

For support with any plugin, please:

1. Check the plugin's individual documentation
2. Use the diagnostic tools (if available)
3. Create an issue in this repository

## License

Each plugin may have its own license. Please check the individual plugin directories for license information.

---

**Repository Structure:**
```
e107_plugins/
├── README.md                 # This file
├── turnstile/               # Turnstile Captcha Plugin
│   ├── README.md           # English documentation
│   ├── README.pt-PT.md     # Portuguese documentation
│   ├── README.es-ES.md     # Spanish documentation
│   ├── plugin.xml          # Plugin configuration
│   ├── admin_config.php    # Admin configuration
│   ├── e107_add/          # Additional files
│   │   └── diagnose_turnstile.php
│   └── ...                # Other plugin files
└── [future_plugins]/       # Additional plugins will be added here
```

## Future Plugins

This repository will be expanded with additional e107 plugins. Each plugin will maintain its own directory structure and documentation.
