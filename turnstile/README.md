# Turnstile Captcha Plugin for e107

#### (Choose your language below / Escolha o seu idioma abaixo / Elija su idioma abajo)

[![Language-English](https://img.shields.io/badge/Language-English-blue)](README.md) 
[![Language-Português](https://img.shields.io/badge/Language-Português-green)](README.pt-PT.md) 
[![Language-Español](https://img.shields.io/badge/Language-Español-red)](README.es-ES.md) 

---

A replacement plugin for the e107 captcha system, using Cloudflare Turnstile to make your site more user-friendly and secure.

## Description

This plugin provides a modern and easy-to-use alternative to the traditional e107 captcha system. It uses Cloudflare Turnstile, which offers an improved user experience while maintaining security against bots and spam.

## Features

- ✅ Direct replacement for e107 captcha system
- ✅ More user-friendly interface
- ✅ Cloudflare Turnstile integration
- ✅ Simple configuration from admin panel
- ✅ Compatible with e107 v2.3+

## Installation

1. Download the plugin from this repository
2. Extract the files from the `turnstile/` folder to your `e107_plugins/turnstile/` directory
3. Go to the e107 administration panel
4. Navigate to **Plugins** and activate the "Turnstile Captcha" plugin
5. Configure the API keys in the configuration section

## Configuration

### Getting Cloudflare Turnstile Keys

1. Go to [Cloudflare Dashboard](https://dash.cloudflare.com/)
2. Select your website
3. Go to **Security** > **Turnstile**
4. Create a new site and obtain:
   - **Site Key** (Public site key)
   - **Secret Key** (Private secret key)

### Configure the Plugin

1. In the e107 admin panel, go to **Plugins** > **Turnstile Captcha**
2. Click **Configure**
3. Enter the keys obtained from Cloudflare:
   - **Site Key**: Your public site key
   - **Secret Key**: Your private secret key
4. Save the configuration

## Diagnostic Tool

This plugin includes a diagnostic tool to help identify configuration issues and verify proper Cloudflare integration.

### Using the Diagnostic Tool

1. Copy the file `e107_add/diagnose_turnstile.php` to your e107 root directory
2. Access the diagnostic tool via your browser: `https://your-domain.com/diagnose_turnstile.php`
3. The tool will perform the following checks:
   - **Cloudflare Zone Detection**: Verifies if your domain is properly configured in Cloudflare
   - **Plugin Configuration**: Checks if Turnstile keys are properly configured in e107
   - **API Connectivity**: Tests connection to Cloudflare Turnstile API
   - **Server Information**: Displays relevant server and domain information

### Diagnostic Features

- ✅ **Cloudflare Zone Detection**: Automatically detects if your domain is behind Cloudflare
- ✅ **Configuration Validation**: Verifies Site Key and Secret Key format and presence
- ✅ **API Connectivity Test**: Tests connection to Cloudflare Turnstile services
- ✅ **Detailed Recommendations**: Provides specific solutions for detected issues
- ✅ **Real-time Analysis**: Updates information on each page refresh

### Common Issues and Solutions

**Error: "Cannot determine Turnstile's embedded location"**
- **Cause**: Domain is not configured in Cloudflare
- **Solution**: Add your domain to Cloudflare and update nameservers

**Turnstile not displaying**
- **Cause**: Incorrect Site Key or domain not in allowed list
- **Solution**: Verify Site Key and add domain to Turnstile configuration in Cloudflare Dashboard

### Security Note

⚠️ **Important**: Remove the diagnostic file from your production server after troubleshooting to maintain security.

## File Structure

```
turnstile/
├── admin_config.php          # Administrator configuration panel
├── e_cloudflare_zone.php     # Cloudflare zone functions
├── e_domain_check.php        # Domain verification
├── e_header.php              # Header scripts
├── e_module.php              # Main plugin module
├── images/                   # Plugin icons
│   ├── _icon_16.png
│   ├── _icon_32.png
│   ├── _icon_64.png
│   └── _icon_128.png
├── plugin.xml               # Plugin configuration
├── .gitignore               # Git ignored files
└── README.md                # This file
```

## Requirements

- e107 CMS v2.3 or higher
- PHP 7.0 or higher
- Cloudflare account (free available)

## Author

**Jimako**  
Website: [https://www.e107sk.com/](https://www.e107sk.com/)

## License

This plugin is licensed under the terms of the GNU General Public License.

## Support

To report issues or request features, please visit the project repository on GitHub.

## Changelog

### v1.0.1 (2025-09-25)
- Initial plugin version
- Basic Cloudflare Turnstile integration
- Administrator configuration panel
- Compatibility with e107 v2.3+