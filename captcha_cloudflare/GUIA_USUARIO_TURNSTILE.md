# 🛡️ Guía Completa del Plugin Turnstile CAPTCHA para e107

## 📋 Índice

1. [Introducción](#introducción)
2. [Características](#características)
3. [Requisitos del Sistema](#requisitos-del-sistema)
4. [Instalación](#instalación)
5. [Configuración Inicial](#configuración-inicial)
6. [Panel de Administración](#panel-de-administración)
7. [Configuración Avanzada](#configuración-avanzada)
8. [Uso en Frontend](#uso-en-frontend)
9. [Estadísticas y Monitoreo](#estadísticas-y-monitoreo)
10. [Logs de Seguridad](#logs-de-seguridad)
11. [Solución de Problemas](#solución-de-problemas)
12. [API y Desarrollo](#api-y-desarrollo)
13. [Preguntas Frecuentes](#preguntas-frecuentes)

---

## 🔰 Introducción

El **Plugin Turnstile CAPTCHA** es una solución de seguridad avanzada para e107 que reemplaza el sistema CAPTCHA tradicional con la tecnología moderna de **Cloudflare Turnstile**. Este plugin ofrece una experiencia más amigable para el usuario mientras mantiene altos niveles de seguridad contra bots y ataques automatizados.

### ¿Qué es Cloudflare Turnstile?

Cloudflare Turnstile es una alternativa moderna a reCAPTCHA que:
- **No requiere interacción del usuario** en la mayoría de casos
- **Respeta la privacidad** del usuario
- **Es más rápido** y eficiente
- **Funciona sin cookies** de terceros
- **Es gratuito** para uso básico

---

## ✨ Características

### 🔐 Seguridad Avanzada
- ✅ Protección contra bots y ataques automatizados
- ✅ Rate limiting inteligente con bloqueo automático de IPs
- ✅ Monitoreo en tiempo real de intentos de verificación
- ✅ Logs detallados de seguridad
- ✅ Integración completa con el sistema de logs de e107

### 🎨 Personalización
- ✅ Temas: Claro, Oscuro, Automático
- ✅ Tamaños: Normal, Compacto
- ✅ Ocultación automática para miembros registrados
- ✅ Configuración flexible por formulario

### 📊 Monitoreo y Estadísticas
- ✅ Dashboard con estadísticas en tiempo real
- ✅ Gráficos de intentos exitosos vs fallidos
- ✅ Lista de IPs bloqueadas
- ✅ Historial de actividad detallado

### 🔧 Administración
- ✅ Panel de administración intuitivo
- ✅ Configuración de prueba integrada
- ✅ Gestión de bloqueos de IP
- ✅ Exportación de logs y estadísticas

---

## 🖥️ Requisitos del Sistema

### Requisitos Mínimos
- **e107 CMS**: Versión 2.3.0 o superior
- **PHP**: Versión 7.4 o superior
- **MySQL**: Versión 5.7 o superior
- **Extensiones PHP**: cURL, JSON, OpenSSL
- **Permisos**: Administrador de plugins (P)

### Requisitos Recomendados
- **PHP**: Versión 8.0 o superior
- **MySQL**: Versión 8.0 o superior
- **Memoria PHP**: 128MB o más
- **Conexión HTTPS**: Recomendada para máxima seguridad

### Cuenta de Cloudflare
- Cuenta gratuita en [Cloudflare](https://www.cloudflare.com/)
- Sitio web registrado en Cloudflare Turnstile
- Site Key y Secret Key generadas

---

## 📦 Instalación

### Paso 1: Obtener las Claves de Turnstile

1. **Crear cuenta en Cloudflare** (si no tienes una):
   - Visita [https://www.cloudflare.com/](https://www.cloudflare.com/)
   - Regístrate con tu email

2. **Acceder a Turnstile**:
   - Inicia sesión en tu dashboard de Cloudflare
   - Ve a la sección **"Turnstile"**
   - Haz clic en **"Add Site"**

3. **Configurar tu sitio**:
   - **Site Name**: Nombre descriptivo (ej: "Mi Sitio e107")
   - **Domain**: Tu dominio (ej: `midominio.com`)
   - **Widget Mode**: Selecciona "Managed" (recomendado)

4. **Obtener las claves**:
   - **Site Key**: Clave pública (comienza con `0x4AAA...`)
   - **Secret Key**: Clave privada (comienza con `0x4AAA...`)
   - ⚠️ **Importante**: Guarda estas claves de forma segura

### Paso 2: Instalar el Plugin

1. **Descargar el plugin**:
   - Descarga el archivo `turnstile.zip`
   - Extrae el contenido

2. **Subir archivos**:
   ```
   /e107_plugins/turnstile/
   ├── admin_config.php
   ├── e_header.php
   ├── e_module.php
   ├── plugin.xml
   ├── turnstile_setup.php
   ├── turnstile_sql.php
   ├── images/
   └── languages/
   ```

3. **Instalar desde el panel de administración**:
   - Ve a **Admin → Plugins → Plugin Manager**
   - Busca "Turnstile Captcha"
   - Haz clic en **"Install"**
   - Confirma la instalación

### Paso 3: Verificar la Instalación

El plugin creará automáticamente **3 tablas** en la base de datos:

1. **`e107_turnstile_attempts`**: Registra intentos de verificación
2. **`e107_turnstile_config`**: Almacena configuración del plugin
3. **`e107_turnstile_blocks`**: Gestiona bloqueos de IP

---

## ⚙️ Configuración Inicial

### Acceder al Panel de Configuración

1. Ve a **Admin → Plugins → Turnstile Captcha**
2. Haz clic en **"Configure"**

### Configuración Básica

#### 🔑 Claves de API
- **Site Key**: Pega tu clave pública de Cloudflare
- **Secret Key**: Pega tu clave privada de Cloudflare
- ⚠️ **Importante**: Verifica que las claves sean correctas

#### 🎨 Apariencia
- **Theme**: 
  - `Light`: Tema claro (recomendado para sitios claros)
  - `Dark`: Tema oscuro (recomendado para sitios oscuros)
  - `Auto`: Se adapta automáticamente al tema del navegador

- **Size**:
  - `Normal`: Tamaño estándar (recomendado)
  - `Compact`: Tamaño reducido (para espacios limitados)

#### 👥 Comportamiento
- **Enable Turnstile**: Activa/desactiva el plugin
- **Hide for Members**: Oculta CAPTCHA para usuarios registrados

### Configuración de Prueba

1. Haz clic en **"Test Configuration"**
2. Verifica que aparezca: ✅ **"Configuration is valid and working properly"**
3. Si hay errores, revisa las claves y la conectividad

---

## 🎛️ Panel de Administración

### Menú Principal

El panel de administración incluye 4 secciones principales:

#### 1. 📋 **Configuration** (Configuración)
- Configuración general del plugin
- Claves de API
- Opciones de apariencia
- Configuración de seguridad

#### 2. 📊 **Statistics** (Estadísticas)
- Total de intentos de verificación
- Intentos exitosos vs fallidos
- IPs bloqueadas actualmente
- Gráficos de actividad

#### 3. 🔒 **Security Logs** (Logs de Seguridad)
- Historial detallado de eventos
- Intentos de verificación
- Bloqueos de IP
- Errores del sistema

#### 4. 🧪 **Test Configuration** (Prueba de Configuración)
- Verificación de conectividad
- Validación de claves
- Prueba de funcionalidad

### Dashboard de Estadísticas

El dashboard muestra métricas en tiempo real:

```
┌─────────────────┬─────────────────┬─────────────────┬─────────────────┐
│  Total Attempts │   Successful    │     Failed      │   Blocked IPs   │
│      1,234      │      1,180      │       54        │        3        │
└─────────────────┴─────────────────┴─────────────────┴─────────────────┘
```

#### Métricas Disponibles:
- **Total Attempts**: Número total de verificaciones
- **Successful**: Verificaciones exitosas
- **Failed**: Verificaciones fallidas
- **Blocked IPs**: IPs actualmente bloqueadas
- **Success Rate**: Porcentaje de éxito
- **Activity Timeline**: Actividad por horas/días

---

## 🔧 Configuración Avanzada

### Pestaña "Security" (Seguridad)

#### Rate Limiting (Limitación de Velocidad)

- **Enable Rate Limiting**: Activa el sistema de bloqueo automático
- **Max Attempts**: Máximo de intentos fallidos antes del bloqueo (predeterminado: 5)
- **Time Window**: Ventana de tiempo para contar intentos (predeterminado: 300 segundos)
- **Block Duration**: Duración del bloqueo (predeterminado: 3600 segundos)

#### Ejemplo de Configuración Estricta:
```
Max Attempts: 3
Time Window: 180 segundos (3 minutos)
Block Duration: 7200 segundos (2 horas)
```

#### Ejemplo de Configuración Permisiva:
```
Max Attempts: 10
Time Window: 600 segundos (10 minutos)
Block Duration: 1800 segundos (30 minutos)
```

### Configuración de Base de Datos

El plugin utiliza 3 tablas principales:

#### `turnstile_attempts`
```sql
- attempt_id: ID único del intento
- attempt_ip: Dirección IP del usuario
- attempt_time: Timestamp del intento
- attempt_success: Éxito (1) o fallo (0)
- attempt_user_agent: User Agent del navegador
- attempt_user_id: ID del usuario (si está logueado)
```

#### `turnstile_config`
```sql
- config_name: Nombre de la configuración
- config_value: Valor de la configuración
- config_updated: Timestamp de actualización
```

#### `turnstile_blocks`
```sql
- block_id: ID único del bloqueo
- block_ip: IP bloqueada
- block_start: Inicio del bloqueo
- block_end: Fin del bloqueo
- block_reason: Razón del bloqueo
- block_attempts: Número de intentos que causaron el bloqueo
- block_active: Estado del bloqueo (activo/inactivo)
```

---

## 🌐 Uso en Frontend

### Integración Automática

El plugin se integra automáticamente con:

#### Formularios de e107:
- ✅ **Registro de usuarios**
- ✅ **Inicio de sesión**
- ✅ **Contacto**
- ✅ **Comentarios**
- ✅ **Envío de noticias**
- ✅ **Formularios personalizados**

### Implementación Manual

Para integrar Turnstile en formularios personalizados:

#### PHP:
```php
// Mostrar el widget
$turnstile = e107::getObject('e107turnstile');
echo $turnstile->input();

// Verificar la respuesta
if ($_POST['cf-turnstile-response']) {
    if ($turnstile->verify()) {
        // Verificación exitosa
        echo "¡CAPTCHA verificado correctamente!";
    } else {
        // Verificación fallida
        echo $turnstile->invalid();
    }
}
```

#### HTML/Template:
```html
<!-- Widget de Turnstile -->
<div class="turnstile-widget">
    {TURNSTILE_INPUT}
</div>

<!-- Mensaje de error (si es necesario) -->
<div class="turnstile-error">
    {TURNSTILE_ERROR}
</div>
```

### Shortcodes Disponibles

#### `{TURNSTILE}`
Muestra el widget de Turnstile básico:
```
{TURNSTILE}
```

#### `{TURNSTILE=theme,size}`
Widget con opciones personalizadas:
```
{TURNSTILE=dark,compact}
{TURNSTILE=light,normal}
{TURNSTILE=auto,compact}
```

### CSS Personalizado

Para personalizar la apariencia:

```css
/* Contenedor del widget */
.cf-turnstile {
    margin: 10px 0;
    text-align: center;
}

/* Mensaje de error */
.turnstile-error {
    color: #d32f2f;
    background: #ffebee;
    padding: 10px;
    border-radius: 4px;
    margin: 10px 0;
}

/* Mensaje de éxito */
.turnstile-success {
    color: #388e3c;
    background: #e8f5e8;
    padding: 10px;
    border-radius: 4px;
    margin: 10px 0;
}
```

---

## 📊 Estadísticas y Monitoreo

### Dashboard Principal

El dashboard proporciona una vista general de la actividad:

#### Métricas Clave:
1. **Intentos Totales**: Suma de todas las verificaciones
2. **Tasa de Éxito**: Porcentaje de verificaciones exitosas
3. **IPs Bloqueadas**: Número de direcciones IP actualmente bloqueadas
4. **Actividad Reciente**: Eventos de las últimas 24 horas

#### Gráficos Disponibles:
- **Timeline de Actividad**: Muestra la actividad por horas
- **Distribución de Éxito/Fallo**: Gráfico circular
- **Top IPs**: Direcciones IP más activas
- **Tendencias Semanales**: Comparación semanal

### Exportación de Datos

#### Exportar Estadísticas:
1. Ve a **Statistics**
2. Haz clic en **"Export Data"**
3. Selecciona el formato: CSV, JSON, XML
4. Elige el rango de fechas
5. Descarga el archivo

#### Formato CSV:
```csv
Date,Total_Attempts,Successful,Failed,Blocked_IPs
2024-01-01,150,145,5,1
2024-01-02,200,190,10,2
```

#### Formato JSON:
```json
{
  "period": "2024-01-01 to 2024-01-31",
  "summary": {
    "total_attempts": 4500,
    "successful": 4200,
    "failed": 300,
    "blocked_ips": 15
  },
  "daily_stats": [...]
}
```

---

## 🔍 Logs de Seguridad

### Tipos de Eventos Registrados

#### 1. **Verificaciones Exitosas**
```
[2024-01-15 10:30:45] [INFO] TURNSTILE_SUCCESS
IP: 192.168.1.100 | User: john_doe | Token verified successfully
```

#### 2. **Verificaciones Fallidas**
```
[2024-01-15 10:31:20] [WARNING] TURNSTILE_FAILED
IP: 192.168.1.200 | Reason: Invalid token format
```

#### 3. **Bloqueos de IP**
```
[2024-01-15 10:32:00] [ERROR] TURNSTILE_BLOCKED
IP: 192.168.1.200 | Reason: Rate limit exceeded (5 attempts in 300s)
```

#### 4. **Errores del Sistema**
```
[2024-01-15 10:33:15] [ERROR] TURNSTILE_ERROR
Error: Failed to connect to Cloudflare API | Code: CURL_ERROR_28
```

### Filtros de Logs

#### Por Tipo de Evento:
- ✅ Verificaciones exitosas
- ⚠️ Verificaciones fallidas
- 🚫 Bloqueos de IP
- ❌ Errores del sistema

#### Por Rango de Fechas:
- Última hora
- Últimas 24 horas
- Última semana
- Último mes
- Rango personalizado

#### Por Dirección IP:
- IP específica
- Rango de IPs
- IPs bloqueadas
- IPs más activas

### Alertas Automáticas

#### Configurar Alertas por Email:
1. Ve a **Security Logs**
2. Haz clic en **"Alert Settings"**
3. Configura los criterios:
   - Número de fallos por IP
   - Tiempo de respuesta de API
   - Errores críticos
4. Añade direcciones de email
5. Guarda la configuración

#### Tipos de Alertas:
- **Rate Limit Exceeded**: Cuando una IP supera el límite
- **API Error**: Problemas de conectividad con Cloudflare
- **High Failure Rate**: Tasa de fallos superior al 10%
- **Suspicious Activity**: Patrones de comportamiento anómalos

---

## 🔧 Solución de Problemas

### Problemas Comunes

#### 1. **"Invalid Site Key" o "Invalid Secret Key"**

**Síntomas:**
- El widget no se muestra
- Error en la consola del navegador
- Mensaje de configuración inválida

**Soluciones:**
1. Verifica que las claves sean correctas
2. Asegúrate de que el dominio esté registrado en Cloudflare
3. Comprueba que las claves correspondan al dominio correcto
4. Regenera las claves si es necesario

#### 2. **"You did not pass robot test"**

**Síntomas:**
- El mensaje aparece incluso con verificación correcta
- Formularios no se envían

**Soluciones:**
1. Verifica la conectividad con la API de Cloudflare
2. Comprueba los logs de seguridad
3. Revisa la configuración de rate limiting
4. Asegúrate de que el servidor tenga acceso a internet

#### 3. **Widget no se muestra**

**Síntomas:**
- Espacio en blanco donde debería estar el CAPTCHA
- Error de JavaScript en la consola

**Soluciones:**
1. Verifica que JavaScript esté habilitado
2. Comprueba que no haya bloqueadores de anuncios
3. Asegúrate de que el script de Cloudflare se cargue
4. Revisa la configuración de CSP (Content Security Policy)

#### 4. **Bloqueos Excesivos de IP**

**Síntomas:**
- Usuarios legítimos son bloqueados
- Muchas quejas de acceso denegado

**Soluciones:**
1. Ajusta la configuración de rate limiting
2. Aumenta el número máximo de intentos
3. Reduce la duración del bloqueo
4. Revisa la lista de IPs bloqueadas

### Diagnóstico Avanzado

#### Verificar Conectividad:
```bash
# Probar conectividad con Cloudflare
curl -I https://challenges.cloudflare.com/turnstile/v0/api/js/turnstile.js

# Verificar resolución DNS
nslookup challenges.cloudflare.com
```

#### Logs de PHP:
```php
// Habilitar logging detallado
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/turnstile_debug.log');

// En e107_config.php
const e_DEBUG = true;
```

#### Verificar Base de Datos:
```sql
-- Verificar tablas del plugin
SHOW TABLES LIKE '%turnstile%';

-- Verificar intentos recientes
SELECT * FROM e107_turnstile_attempts 
ORDER BY attempt_time DESC LIMIT 10;

-- Verificar bloqueos activos
SELECT * FROM e107_turnstile_blocks 
WHERE block_active = 1 AND block_end > UNIX_TIMESTAMP();
```

### Herramientas de Debug

#### 1. **Test de Configuración Integrado**
- Ve a **Admin → Turnstile → Test Configuration**
- Ejecuta todas las pruebas
- Revisa los resultados detallados

#### 2. **Monitor de Red**
- Abre las herramientas de desarrollador del navegador
- Ve a la pestaña "Network"
- Busca llamadas a `challenges.cloudflare.com`
- Verifica códigos de respuesta HTTP

#### 3. **Logs del Servidor Web**
```bash
# Apache
tail -f /var/log/apache2/error.log | grep turnstile

# Nginx
tail -f /var/log/nginx/error.log | grep turnstile
```

---

## 🔌 API y Desarrollo

### Clase Principal: `e107turnstile`

#### Métodos Públicos:

##### `input($theme = null, $size = null)`
Genera el HTML del widget de Turnstile:
```php
$turnstile = e107::getObject('e107turnstile');
echo $turnstile->input('dark', 'compact');
```

##### `verify($token = null)`
Verifica un token de Turnstile:
```php
$token = $_POST['cf-turnstile-response'];
if ($turnstile->verify($token)) {
    // Verificación exitosa
} else {
    // Verificación fallida
}
```

##### `invalid()`
Retorna el mensaje de error:
```php
if (!$turnstile->verify()) {
    echo $turnstile->invalid();
}
```

### Hooks y Eventos

#### Hook: `turnstile_before_verify`
Se ejecuta antes de la verificación:
```php
function mi_plugin_before_verify($data) {
    // $data contiene: ip, token, user_id
    // Retornar false cancela la verificación
    return true;
}
e107::getEvent()->register('turnstile_before_verify', 'mi_plugin_before_verify');
```

#### Hook: `turnstile_after_verify`
Se ejecuta después de la verificación:
```php
function mi_plugin_after_verify($data) {
    // $data contiene: ip, token, user_id, success
    if ($data['success']) {
        // Verificación exitosa
    }
}
e107::getEvent()->register('turnstile_after_verify', 'mi_plugin_after_verify');
```

#### Hook: `turnstile_ip_blocked`
Se ejecuta cuando una IP es bloqueada:
```php
function mi_plugin_ip_blocked($data) {
    // $data contiene: ip, attempts, duration
    // Enviar notificación, log personalizado, etc.
}
e107::getEvent()->register('turnstile_ip_blocked', 'mi_plugin_ip_blocked');
```

### Integración con Otros Plugins

#### Ejemplo: Plugin de Contacto
```php
// En tu plugin de contacto
class ContactForm {
    public function showForm() {
        $turnstile = e107::getObject('e107turnstile');
        
        $form = "
        <form method='post'>
            <input type='text' name='name' placeholder='Nombre' required>
            <textarea name='message' placeholder='Mensaje' required></textarea>
            " . $turnstile->input() . "
            <button type='submit'>Enviar</button>
        </form>";
        
        return $form;
    }
    
    public function processForm() {
        $turnstile = e107::getObject('e107turnstile');
        
        if (!$turnstile->verify()) {
            return $turnstile->invalid();
        }
        
        // Procesar formulario...
        return "Mensaje enviado correctamente";
    }
}
```

### Configuración Programática

#### Cambiar configuración desde código:
```php
// Obtener configuración actual
$config = e107::getPluginConfig('turnstile');

// Modificar configuración
$config->set('theme', 'dark');
$config->set('size', 'compact');
$config->set('rate_limit_attempts', 3);

// Guardar cambios
$config->save();
```

#### Gestionar bloqueos de IP:
```php
$db = e107::getDb();

// Bloquear IP manualmente
$data = array(
    'block_ip' => '192.168.1.100',
    'block_start' => time(),
    'block_end' => time() + 3600, // 1 hora
    'block_reason' => 'Bloqueo manual',
    'block_active' => 1
);
$db->insert('turnstile_blocks', $data);

// Desbloquear IP
$db->update('turnstile_blocks', 
    array('block_active' => 0), 
    "block_ip = '192.168.1.100'"
);
```

---

## ❓ Preguntas Frecuentes

### General

**P: ¿Es gratuito Cloudflare Turnstile?**
R: Sí, Cloudflare Turnstile es gratuito para uso básico. Incluye hasta 1 millón de verificaciones por mes.

**P: ¿Funciona sin JavaScript?**
R: No, Turnstile requiere JavaScript habilitado en el navegador del usuario.

**P: ¿Es compatible con todos los navegadores?**
R: Sí, es compatible con todos los navegadores modernos (Chrome, Firefox, Safari, Edge).

### Instalación

**P: ¿Puedo usar el plugin sin una cuenta de Cloudflare?**
R: No, necesitas una cuenta gratuita de Cloudflare y registrar tu sitio en Turnstile.

**P: ¿El plugin funciona en localhost?**
R: Sí, puedes configurar `localhost` como dominio en Cloudflare Turnstile para desarrollo.

**P: ¿Qué pasa si cambio de dominio?**
R: Debes actualizar la configuración en Cloudflare y generar nuevas claves para el nuevo dominio.

### Configuración

**P: ¿Cuál es la diferencia entre los temas?**
R: 
- **Light**: Fondo blanco, texto negro
- **Dark**: Fondo oscuro, texto blanco  
- **Auto**: Se adapta al tema del navegador/sistema

**P: ¿Debo ocultar el CAPTCHA para miembros registrados?**
R: Es recomendable para mejorar la experiencia de usuario, pero depende de tus necesidades de seguridad.

**P: ¿Cómo configuro rate limiting?**
R: Ve a la pestaña "Security" en la configuración. Ajusta los valores según tu tráfico y tolerancia al riesgo.

### Seguridad

**P: ¿Qué tan seguro es Turnstile comparado con reCAPTCHA?**
R: Turnstile ofrece el mismo nivel de seguridad que reCAPTCHA v3, pero con mejor privacidad y experiencia de usuario.

**P: ¿Los datos de mis usuarios van a Cloudflare?**
R: Cloudflare procesa datos mínimos necesarios para la verificación, sin cookies de seguimiento.

**P: ¿Puedo usar Turnstile con GDPR?**
R: Sí, Turnstile es compatible con GDPR y no requiere consentimiento adicional de cookies.

### Problemas Técnicos

**P: El widget no se muestra, ¿qué hago?**
R: 
1. Verifica las claves de API
2. Comprueba la consola del navegador
3. Asegúrate de que JavaScript esté habilitado
4. Revisa bloqueadores de anuncios

**P: ¿Por qué algunos usuarios son bloqueados incorrectamente?**
R: Ajusta la configuración de rate limiting. Aumenta el número de intentos permitidos o reduce la duración del bloqueo.

**P: ¿Cómo puedo desbloquear una IP?**
R: Ve a **Security Logs**, busca la IP y haz clic en "Unblock" o usa la API programática.

### Rendimiento

**P: ¿Turnstile afecta la velocidad de mi sitio?**
R: El impacto es mínimo. El script de Turnstile es ligero y se carga de forma asíncrona.

**P: ¿Puedo cachear el widget?**
R: No, el widget debe generarse dinámicamente para cada sesión.

**P: ¿Funciona con CDN?**
R: Sí, Turnstile es compatible con la mayoría de CDNs.

---

## 📞 Soporte y Recursos

### Documentación Oficial
- **Cloudflare Turnstile**: [https://developers.cloudflare.com/turnstile/](https://developers.cloudflare.com/turnstile/)
- **e107 CMS**: [https://e107.org/](https://e107.org/)

### Comunidad
- **Foro e107**: [https://e107.org/forum](https://e107.org/forum)
- **Discord e107**: Canal oficial de la comunidad

### Reportar Problemas
- **GitHub Issues**: [Repositorio del plugin]
- **Email**: [Email de soporte]

### Actualizaciones
- **Versión Actual**: 1.0.0
- **Última Actualización**: Marzo 2025
- **Próxima Versión**: 1.1.0 (Q2 2025)

---

## 📄 Licencia y Créditos

### Licencia
Este plugin se distribuye bajo la **GNU General Public License v3.0**.

### Créditos
- **Desarrollador**: Jimako
- **Sitio Web**: [https://www.e107sk.com/](https://www.e107sk.com/)
- **Basado en**: Cloudflare Turnstile API
- **Compatible con**: e107 CMS 2.3+

### Agradecimientos
- Comunidad e107 por el feedback y testing
- Cloudflare por proporcionar Turnstile gratuitamente
- Contribuidores del proyecto

---

*Esta guía fue generada automáticamente para el Plugin Turnstile CAPTCHA v1.0.0*
*Última actualización: Enero 2025*