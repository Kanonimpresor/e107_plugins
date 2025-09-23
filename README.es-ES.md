# Colección de Plugins e107

#### (Choose your language below / Escolha o seu idioma abaixo / Elija su idioma abajo)

[![Language-English](https://img.shields.io/badge/Language-English-blue)](README.md) 
[![Language-Português](https://img.shields.io/badge/Language-Português-green)](README.pt-PT.md) 
[![Language-Español](https://img.shields.io/badge/Language-Español-red)](README.es-ES.md) 

---

## Bienvenido al Repositorio de Plugins e107

Este repositorio contiene una colección curada de plugins específicamente diseñados para **e107 Bootstrap CMS v2.3.x**. Cada plugin está desarrollado siguiendo los estándares y mejores prácticas de e107 para garantizar compatibilidad y rendimiento óptimo.

## � Plugins Disponibles

### � Plugin Turnstile Captcha
Una solución CAPTCHA moderna y enfocada en la privacidad usando la tecnología Cloudflare Turnstile para e107 CMS.

**Características Principales:**
- ✅ Integración con Cloudflare Turnstile
- � Soporte multi-idioma (Inglés, Español, Portugués)
- ⚙️ Opciones de configuración avanzadas
- � Validación de dominio y verificaciones de seguridad
- �️ Herramientas de diagnóstico integradas
- � Amigable para dispositivos móviles y accesible

**Documentación del Plugin:**
- [� Documentación en Inglés](turnstile/README.md)
- [� Documentación en Español](turnstile/README.es-ES.md)
- [� Documentação em Português](turnstile/README.pt-PT.md)

## � Requisitos del Sistema

- **e107 CMS:** v2.3.x (versión Bootstrap)
- **PHP:** 7.4 o superior
- **MySQL:** 5.7 o superior / MariaDB 10.2+
- **Servidor Web:** Apache 2.4+ o Nginx 1.18+
- **Conexión a Internet:** Requerida para servicios de Cloudflare

## � Guía de Instalación

1. **Descargar Plugin:** Elija el plugin deseado de su respectiva carpeta
2. **Subir Archivos:** Extraiga y suba al directorio `e107_plugins/` de su e107
3. **Instalar Plugin:** Navegue al Panel de Administración e107 → Administrador de Plugins
4. **Activar:** Haga clic en "Instalar" en el plugin elegido
5. **Configurar:** Acceda a la configuración del plugin a través del Panel de Administración

## �️ Estructura del Repositorio

```
e107_plugins/
├── README.md                    # Documentación principal (Inglés)
├── README.pt-PT.md             # Documentación en Portugués
├── README.es-ES.md             # Documentación en Español
├── .gitignore                  # Reglas de Git ignore
├── turnstile/                  # Plugin Turnstile Captcha
│   ├── README.md              # Documentación del plugin
│   ├── plugin.xml             # Configuración del plugin
│   ├── admin_config.php       # Interfaz administrativa
│   ├── e107_add/             # Herramientas adicionales
│   └── [archivos del plugin...] # Archivos principales del plugin
└── [plugins futuros]/          # Espacio para plugins adicionales
```

## � Contribuyendo

¡Damos la bienvenida a las contribuciones de la comunidad e107! Así es como puedes ayudar:

1. **Fork** este repositorio
2. **Crear** una rama de funcionalidad (`git checkout -b feature/plugin-increible`)
3. **Commit** tus cambios (`git commit -m 'Agregar plugin increíble'`)
4. **Push** a la rama (`git push origin feature/plugin-increible`)
5. **Abrir** un Pull Request

### Directrices de Desarrollo de Plugins
- Sigue los estándares de codificación de e107
- Incluye documentación completa
- Proporciona soporte multi-idioma cuando sea posible
- Prueba con e107 Bootstrap CMS v2.3.x
- Incluye manejo adecuado de errores

## � Soporte y Comunidad

- **Problemas de Plugin:** Consulta la documentación individual del plugin
- **Soporte General:** [Foros de la Comunidad e107](https://e107.org/forum)
- **Reportes de Errores:** Usa GitHub Issues para este repositorio
- **Solicitudes de Funcionalidades:** Envía a través de GitHub Issues

## � Licencia

Cada plugin puede tener sus propios términos de licencia. Por favor, consulta los directorios individuales de los plugins para información específica de licencia. La mayoría de los plugins en este repositorio se publican bajo licencias compatibles con GPL.

## � Hoja de Ruta

- � Soluciones CAPTCHA adicionales
- �️ Plugins de seguridad mejorados
- � Herramientas de análisis y reportes
- � Plugins de mejora de temas
- � Plugins de comunicación avanzados

---

**Nota:** Este es un repositorio impulsado por la comunidad enfocado en plugins de alta calidad para e107 Bootstrap CMS v2.3.x. Cada plugin está minuciosamente probado y documentado para garantizar la mejor experiencia para los usuarios de e107.
