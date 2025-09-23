# Turnstile Captcha Plugin for e107

#### (Choose your language below / Escolha o seu idioma abaixo / Elija su idioma abajo)

[![Language-English](https://img.shields.io/badge/Language-English-blue)](README.md) 
[![Language-Português](https://img.shields.io/badge/Language-Português-green)](README.pt-PT.md) 
[![Language-Español](https://img.shields.io/badge/Language-Español-red)](README.es-ES.md) 

---

Un plugin de reemplazo para el sistema de captcha de e107, utilizando Cloudflare Turnstile para hacer tu sitio más amigable y seguro.

## Descripción

Este plugin proporciona una alternativa moderna y fácil de usar al sistema de captcha tradicional de e107. Utiliza Cloudflare Turnstile, que ofrece una experiencia de usuario mejorada mientras mantiene la seguridad contra bots y spam.

## Características

- ✅ Reemplazo directo del sistema de captcha de e107
- ✅ Interfaz de usuario más amigable
- ✅ Integración con Cloudflare Turnstile
- ✅ Configuración sencilla desde el panel de administración
- ✅ Compatible con e107 v2.3+

## Instalación

1. Descarga el plugin desde este repositorio
2. Extrae los archivos de la carpeta `turnstile/` en tu directorio `e107_plugins/turnstile/`
3. Ve al panel de administración de e107
4. Navega a **Plugins** y activa el plugin "Turnstile Captcha"
5. Configura las claves de API en la sección de configuración

## Configuración

### Obtener las claves de Cloudflare Turnstile

1. Ve a [Cloudflare Dashboard](https://dash.cloudflare.com/)
2. Selecciona tu sitio web
3. Ve a **Security** > **Turnstile**
4. Crea un nuevo sitio y obtén:
   - **Site Key** (Clave del sitio)
   - **Secret Key** (Clave secreta)

### Configurar el plugin

1. En el panel de administración de e107, ve a **Plugins** > **Turnstile Captcha**
2. Haz clic en **Configurar**
3. Introduce las claves obtenidas de Cloudflare:
   - **Site Key**: Tu clave pública del sitio
   - **Secret Key**: Tu clave secreta
4. Guarda la configuración

## Estructura de archivos

```
turnstile/
├── admin_config.php          # Panel de configuración del administrador
├── e_cloudflare_zone.php     # Funciones de zona de Cloudflare
├── e_domain_check.php        # Verificación de dominio
├── e_header.php              # Scripts de cabecera
├── e_module.php              # Módulo principal del plugin
├── images/                   # Iconos del plugin
│   ├── _icon_16.png
│   ├── _icon_32.png
│   ├── _icon_64.png
│   └── _icon_128.png
├── plugin.xml               # Configuración del plugin
├── .gitignore               # Archivos ignorados por Git
└── README.md                # Este archivo
```

## Requisitos

- e107 CMS v2.3 o superior
- PHP 7.0 o superior
- Cuenta de Cloudflare (gratuita disponible)

## Autor

**Jimako**  
Website: [https://www.e107sk.com/](https://www.e107sk.com/)

## Licencia

Este plugin está licenciado bajo los términos de la GNU General Public License.

## Soporte

Para reportar problemas o solicitar características, por favor visita el repositorio del proyecto en GitHub.

## Changelog

### v1.0.1 (2025-09-25)
- Versión inicial del plugin
- Integración básica con Cloudflare Turnstile
- Panel de configuración del administrador
- Compatibilidad con e107 v2.3+