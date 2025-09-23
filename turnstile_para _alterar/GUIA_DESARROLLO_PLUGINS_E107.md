# 🚀 Guía Completa de Desarrollo de Plugins para e107 Bootstrap CMS

> **De Principiante a Experto** - Una guía completa basada en el análisis del plugin `_blank` y la documentación oficial de e107.

## 📋 Tabla de Contenidos

1. [Introducción](#introducción)
2. [Estructura Básica de un Plugin](#estructura-básica-de-un-plugin)
3. [Archivos Clave y su Función](#archivos-clave-y-su-función)
4. [Roadmap de Desarrollo](#roadmap-de-desarrollo)
5. [Ejemplos Prácticos](#ejemplos-prácticos)
6. [Mejores Prácticas](#mejores-prácticas)
7. [Recursos Adicionales](#recursos-adicionales)

---

## 🎯 Introducción

e107 Bootstrap CMS es un sistema de gestión de contenidos potente y flexible que permite crear plugins personalizados para extender su funcionalidad. Esta guía te llevará desde los conceptos básicos hasta técnicas avanzadas de desarrollo.

### ¿Por qué desarrollar plugins para e107?

- ✅ **Extensibilidad**: Añade funcionalidades específicas sin modificar el núcleo
- ✅ **Reutilización**: Comparte tus plugins con la comunidad
- ✅ **Mantenibilidad**: Código organizado y estructurado
- ✅ **Escalabilidad**: Arquitectura robusta para proyectos grandes

---

## 📁 Estructura Básica de un Plugin

Basado en el análisis completo del plugin `_blank` (plantilla oficial de e107), aquí tienes la estructura detallada que debe seguir todo plugin profesional:

### 🗂️ Estructura Completa del Plugin _blank

```
e107_plugins/_blank/
├── 📄 plugin.xml                    # ⚙️ Configuración principal del plugin
├── 📄 _blank.php                    # 🏠 Archivo principal (frontend)
├── 📄 _blank_setup.php              # 🔧 Instalación/desinstalación/actualización
├── 📄 _blank_sql.php                # 🗄️ Estructura de base de datos
├── 📄 _blank_menu.php               # 📋 Configuración de menús específicos
├── 📄 _blank_shortcodes.php         # 🔗 Shortcodes del plugin (legacy)
├── 📄 admin_config.php              # 🎛️ Panel de administración principal
├── 📄 e_admin.php                   # 🔌 Extensiones de administración
├── 📄 e_cron.php                    # ⏰ Tareas programadas
├── 📄 e_dashboard.php               # 📊 Widget del dashboard
├── 📄 e_event.php                   # 🎯 Manejo de eventos del sistema
├── 📄 e_frontpage.php               # 🏡 Contenido de página principal
├── 📄 e_header.php                  # 📄 Modificaciones del header
├── 📄 e_library.php                 # 📚 Librerías y funciones auxiliares
├── 📄 e_menu.php                    # 📋 Configuración de menús (v2.x)
├── 📄 e_notify.php                  # 📧 Sistema de notificaciones
├── 📄 e_parse.php                   # 🔄 Parseo personalizado
├── 📄 e_print.php                   # 🖨️ Versión para imprimir
├── 📄 e_related.php                 # 🔗 Contenido relacionado
├── 📄 e_rss.php                     # 📡 Feeds RSS
├── 📄 e_search.php                  # 🔍 Integración con búsqueda
├── 📄 e_shortcode.php               # 🔗 Shortcodes personalizados (v2.x)
├── 📄 e_sitelink.php                # 🌐 Enlaces del sitio
├── 📄 e_url.php                     # 🔗 URLs amigables
├── 📄 e_user.php                    # 👤 Extensiones de usuario
├── 📁 css/
│   └── blank.css                    # 🎨 Estilos del plugin
├── 📁 images/
│   ├── blank_16.png                 # 🖼️ Icono 16x16
│   ├── blank_32.png                 # 🖼️ Icono 32x32
│   ├── icon_128.png                 # 🖼️ Icono 128x128
│   ├── icon_16.png                  # 🖼️ Icono alternativo 16x16
│   └── icon_32.png                  # 🖼️ Icono alternativo 32x32
├── 📁 languages/
│   ├── English/
│   │   └── English_global.php       # 🌍 Idioma inglés
│   └── Portuguese/
│       └── Portuguese_global.php    # 🌍 Idioma portugués
├── 📁 templates/
│   └── _blank_template.php          # 📄 Plantillas del plugin
└── 📁 tests/
    └── unit/
        └── _blank_eventTest.php     # 🧪 Pruebas unitarias
```

### 📋 Categorización de Archivos

#### 🏠 Archivos Principales
- **plugin.xml** - Configuración principal del plugin
- **_blank.php** - Frontend del plugin (lógica principal)
- **_blank_setup.php** - Instalación, actualización y desinstalación
- **_blank_sql.php** - Estructura de base de datos
- **admin_config.php** - Panel de administración

#### 🔌 Archivos de Extensión (e_*.php)
- **e_admin.php** - Extensiones de administración
- **e_shortcode.php** - Shortcodes globales (v2.x)
- **e_menu.php** - Configuración de menús
- **e_cron.php** - Tareas programadas
- **e_dashboard.php** - Widget del dashboard
- **e_event.php** - Manejo de eventos del sistema
- **e_search.php** - Integración con búsqueda
- **e_url.php** - URLs amigables SEO
- **e_rss.php** - Feeds RSS
- **e_notify.php** - Sistema de notificaciones

#### 📁 Recursos y Assets
- **css/blank.css** - Estilos del plugin
- **images/*.png** - Iconos en múltiples tamaños
- **languages/** - Archivos de idioma (multiidioma)
- **templates/** - Plantillas HTML del plugin
- **tests/** - Pruebas unitarias (opcional pero recomendado)

### 🔍 Descripción de Elementos

| Elemento | Obligatorio | Descripción |
|----------|-------------|-------------|
| `plugin.xml` | ✅ | Metadatos, configuración, enlaces de administración |
| `{plugin}.php` | ✅ | Lógica principal del frontend |
| `{plugin}_setup.php` | ⚠️ | Rutinas de instalación (si usa BD) |
| `{plugin}_sql.php` | ⚠️ | Estructura de base de datos (si aplica) |
| `admin_config.php` | ⚠️ | Panel de administración (si necesita configuración) |
| `templates/` | ⚠️ | Plantillas HTML (recomendado) |
| `languages/` | ⚠️ | Archivos de idioma (recomendado) |
| `css/`, `js/`, `images/` | ❌ | Recursos estáticos (según necesidad) |

---

## 🔍 Análisis Detallado de Archivos del Plugin _blank

### 📄 plugin.xml - Configuración Principal
**Función:** Define todos los metadatos, configuraciones y dependencias del plugin.

**Estructura Básica:**
```xml
<?xml version="1.0" encoding="utf-8"?>
<e107Plugin name="_blank" lan="LAN_PLUGIN__BLANK_NAME" version="1.0" date="2024-01-01" compatibility="2.0" installRequired="true">
    <author name="e107 Inc" url="https://e107.org" email="admin@e107.org" />
    <summary lan="LAN_PLUGIN__BLANK_DIZ">Plugin de ejemplo para desarrollo</summary>
    <description lan="LAN_PLUGIN__BLANK_DIZ">Plantilla base para crear nuevos plugins</description>
    <category>misc</category>
    <keywords>
        <word>blank</word>
        <word>template</word>
        <word>example</word>
    </keywords>
    <copyright>Copyright (c) e107 Inc</copyright>
    <adminLinks>
        <link url="admin_config.php" description="Configuración" icon="images/blank_32.png" iconSmall="images/blank_16.png" primary="true" />
    </adminLinks>
    <siteLinks>
        <link url="blank.php" description="Ver Plugin" icon="images/blank_16.png" />
    </siteLinks>
    <pluginPrefs>
        <pref name="blank_setting1">default_value</pref>
        <pref name="blank_setting2">another_value</pref>
    </pluginPrefs>
    <userClasses>
        <class name="blank_access" description="Acceso al plugin blank" />
    </userClasses>
    <extendedFields>
        <field name="blank_field" type="text" />
    </extendedFields>
</e107Plugin>
```

### 🏠 _blank.php - Frontend Principal
**Función:** Contiene la lógica principal del plugin para el frontend.

**Estructura Básica:**
```php
<?php
if (!defined('e107_INIT')) { exit; }

class _blank_front
{
    function __construct()
    {
        // Cargar recursos necesarios
        e107::js('_blank', 'js/blank.js');
        e107::css('_blank', 'css/blank.css');
        e107::lan('_blank', 'English_global');
    }
    
    function run()
    {
        // Lógica principal del plugin
        $tp = e107::getParser();
        $sql = e107::getDb();
        
        // Ejemplo de consulta a base de datos
        if($sql->select('blank', '*', 'ORDER BY blank_id DESC LIMIT 10'))
        {
            while($row = $sql->fetch())
            {
                // Procesar datos
                $data[] = $row;
            }
        }
        
        // Renderizar template
        $template = e107::getTemplate('_blank');
        $sc = e107::getScBatch('_blank');
        
        return $tp->parseTemplate($template['MAIN'], true, $sc);
    }
}

// Inicializar plugin
$_blank = new _blank_front();
echo $_blank->run();
?>
```

### 🔧 _blank_setup.php - Instalación y Configuración
**Función:** Maneja la instalación, actualización y desinstalación del plugin.

**Métodos Principales:**
- `install_pre()` - Ejecutado antes de crear tablas
- `install_post()` - Ejecutado después de crear tablas
- `upgrade()` - Maneja actualizaciones
- `uninstall()` - Limpieza al desinstalar

**Ejemplo de Implementación:**
```php
<?php
if (!defined('e107_INIT')) { exit; }

class _blank_setup
{
    function install_pre($var)
    {
        // Verificaciones previas a la instalación
        return true;
    }
    
    function install_post($var)
    {
        // Insertar datos iniciales
        $sql = e107::getDb();
        
        $data = array(
            'blank_name' => 'Ejemplo',
            'blank_description' => 'Contenido de ejemplo',
            'blank_datestamp' => time()
        );
        
        $sql->insert('blank', $data);
        
        // Configurar preferencias por defecto
        e107::getConfig()->set('_blank_installed', time());
        e107::getConfig()->save();
        
        return true;
    }
    
    function upgrade($var)
    {
        // Lógica de actualización
        $from_version = $var['plugin_version'];
        $to_version = $var['plugin_new_version'];
        
        if(version_compare($from_version, '1.1', '<'))
        {
            // Actualizar a versión 1.1
            // Añadir nuevas columnas, migrar datos, etc.
        }
        
        return true;
    }
    
    function uninstall($var)
    {
        // Limpiar configuraciones
        e107::getConfig()->remove('_blank_installed');
        e107::getConfig()->save();
        
        return true;
    }
}
?>
```

### 🔌 e_admin.php - Extensiones de Administración
**Función:** Extiende la funcionalidad del panel de administración.

**Implementación:**
```php
<?php
if (!defined('e107_INIT')) { exit; }

class _blank_admin implements e_admin_addon_interface
{
    function load($field, $current_value, $attributes)
    {
        // Cargar valores personalizados para campos
        switch($field)
        {
            case 'blank_custom_field':
                return array(
                    'option1' => 'Opción 1',
                    'option2' => 'Opción 2',
                    'option3' => 'Opción 3'
                );
                break;
        }
        
        return $current_value;
    }
    
    function config($field, $current_value, $attributes)
    {
        // Configurar parámetros de campos
        switch($field)
        {
            case 'blank_date_field':
                return array(
                    'type' => 'datepicker',
                    'data' => 'date',
                    'help' => 'Selecciona una fecha'
                );
                break;
        }
        
        return array();
    }
}
?>
```

### 🔗 e_shortcode.php - Shortcodes Personalizados
**Función:** Define shortcodes que pueden usarse en contenido, plantillas y menús.

**Mejores Prácticas:**
- Usar nombres descriptivos con prefijo del plugin
- Validar parámetros de entrada
- Manejar errores graciosamente
- Documentar cada shortcode

**Ejemplo Avanzado:**
```php
<?php
if (!defined('e107_INIT')) { exit; }

class _blank_shortcodes extends e_shortcode
{
    /**
     * Shortcode básico que retorna "Hello World!"
     * Uso: {_BLANK_CUSTOM}
     */
    function sc__blank_custom($parm = '')
    {
        return "Hello World!";
    }
    
    /**
     * Shortcode con parámetros
     * Uso: {_BLANK_USER: name=Juan&age=25}
     */
    function sc__blank_user($parm = '')
    {
        $defaults = array(
            'name' => 'Usuario',
            'age' => '0'
        );
        
        $parms = array_merge($defaults, $parm);
        
        return "Hola {$parms['name']}, tienes {$parms['age']} años.";
    }
    
    /**
     * Shortcode que accede a la base de datos
     * Uso: {_BLANK_LIST: limit=5&order=date}
     */
    function sc__blank_list($parm = '')
    {
        $sql = e107::getDb();
        $tp = e107::getParser();
        
        $limit = (int) vartrue($parm['limit'], 10);
        $order = vartrue($parm['order'], 'blank_id');
        
        $output = "<ul class='blank-list'>";
        
        if($sql->select('blank', '*', "ORDER BY {$order} DESC LIMIT {$limit}"))
        {
            while($row = $sql->fetch())
            {
                $name = $tp->toHTML($row['blank_name']);
                $output .= "<li>{$name}</li>";
            }
        }
        
        $output .= "</ul>";
        
        return $output;
    }
}
?>
```

---

## 📄 Archivos Clave y su Función

### 1. plugin.xml - El Corazón del Plugin

El archivo `plugin.xml` es el descriptor principal que define todos los metadatos y configuraciones del plugin.

#### Versión Básica (Mínima)

```xml
<?xml version="1.0" encoding="utf-8"?>
<e107Plugin name="Mi Plugin" version="1.0.0" date="2024-01-15" compatibility="2.3.0" installRequired="true">
    <author name="Tu Nombre" email="tu@email.com" url="https://tusitio.com" />
    <summary>Descripción breve del plugin</summary>
    <description>Descripción detallada de las funcionalidades del plugin</description>
    <keywords>palabras, clave, del, plugin</keywords>
    <category>content</category>
    <copyright>GPL v3</copyright>
</e107Plugin>
```

#### 🚀 XML Profesional - Elementos Clave Avanzados

```xml
<?xml version="1.0" encoding="utf-8"?>
<e107Plugin name="Mi Plugin Profesional" 
           version="2.1.0" 
           date="2024-01-15" 
           compatibility="2.3.0" 
           installRequired="true"
           plugin_php="true">
    
    <!-- Metadatos del Desarrollador -->
    <author name="Desarrollador Pro" 
            email="dev@empresa.com" 
            url="https://miempresa.com" />
    
    <!-- Información Descriptiva -->
    <summary>Plugin avanzado con funcionalidades completas</summary>
    <description>Este plugin proporciona funcionalidades avanzadas incluyendo gestión de contenido, APIs personalizadas y integración con servicios externos.</description>
    <keywords>avanzado, api, contenido, gestión, profesional</keywords>
    <category>content</category>
    <copyright>Licencia Comercial 2024</copyright>
    
    <!-- Preferencias Categorizadas -->
    <preferences>
        <pref name="enable_api" type="boolean" default="1">Habilitar API</pref>
        <pref name="api_key" type="text" default="">Clave API</pref>
        <pref name="cache_time" type="number" default="3600">Tiempo de caché (segundos)</pref>
        <pref name="theme_style" type="dropdown" default="modern">Estilo del tema</pref>
        <pref name="debug_mode" type="boolean" default="0">Modo debug</pref>
    </preferences>
    
    <!-- Dependencias del Sistema -->
    <dependencies>
        <plugin name="news" version="2.0+" />
        <plugin name="page" version="1.5+" optional="true" />
        <extension name="curl" />
        <extension name="json" />
        <php_version>7.4.0</php_version>
    </dependencies>
    
    <!-- Estructura de Base de Datos -->
    <tables>
        <table name="mi_plugin_data" primary="id">
            <field name="id" type="int" auto_increment="true" />
            <field name="title" type="varchar" length="255" />
            <field name="content" type="text" />
            <field name="created" type="timestamp" />
        </table>
        <table name="mi_plugin_settings" primary="setting_id">
            <field name="setting_id" type="int" auto_increment="true" />
            <field name="setting_name" type="varchar" length="100" />
            <field name="setting_value" type="text" />
        </table>
    </tables>
    
    <!-- Enlaces de Administración -->
    <adminLinks>
        <link url="admin_config.php" description="Configuración Principal" icon="fa-cog" primary="true" />
        <link url="admin_manage.php" description="Gestionar Contenido" icon="fa-list" />
        <link url="admin_stats.php" description="Estadísticas" icon="fa-chart-bar" />
        <link url="admin_import.php" description="Importar Datos" icon="fa-upload" />
    </adminLinks>
    
    <!-- URLs Amigables -->
    <urls>
        <url name="main" path="mi-plugin" file="plugin.php" />
        <url name="view" path="mi-plugin/ver/{id}" file="view.php" />
        <url name="category" path="mi-plugin/categoria/{cat}" file="category.php" />
        <url name="api" path="api/mi-plugin/{action}" file="api.php" />
    </urls>
    
    <!-- Shortcodes Disponibles -->
    <shortcodes>
        <shortcode name="MI_PLUGIN_LIST" description="Lista elementos del plugin" />
        <shortcode name="MI_PLUGIN_FORM" description="Formulario de contacto" />
        <shortcode name="MI_PLUGIN_STATS" description="Estadísticas del plugin" />
    </shortcodes>
    
</e107Plugin>
```

#### 🎯 Beneficios del XML Profesional:

- **🔧 Gestión Avanzada**: Control completo sobre preferencias y configuraciones
- **📦 Dependencias Claras**: Especifica requisitos del sistema y otros plugins
- **🗄️ Base de Datos Estructurada**: Define tablas y campos automáticamente
- **🧭 Navegación Intuitiva**: Enlaces de administración organizados
- **🔍 SEO Optimizado**: URLs amigables para mejor posicionamiento
- **⚡ Funcionalidad Extendida**: Shortcodes personalizados para flexibilidad
    
    <!-- Descripción -->
    <summary>Descripción breve del plugin</summary>
    <description lan="LAN_PLUGIN_MI_PLUGIN_DIZ">Descripción detallada del plugin</description>
    
    <!-- Categoría -->
    <category>misc</category>
    
    <!-- Palabras clave para búsqueda -->
    <keywords>
        <word>mi</word>
        <word>plugin</word>
        <word>personalizado</word>
    </keywords>
    
    <!-- Enlaces en el panel de administración -->
    <adminLinks>
        <link url='admin_config.php' description='Configurar Mi Plugin' 
              icon='images/mi_plugin_32.png' iconSmall='images/mi_plugin_16.png' 
              primary='true'>LAN_CONFIGURE</link>
        <link url="admin_config.php?mode=stats" description="Estadísticas" 
              icon="chart">Estadísticas</link>
    </adminLinks>
    
    <!-- Enlaces públicos del sitio -->
    <siteLinks>
        <link category="1" url="{e_PLUGIN}mi_plugin/mi_plugin.php" 
              perm='everyone' sef='mi-plugin'>Mi Plugin</link>
    </siteLinks>
    
    <!-- Preferencias del plugin -->
    <pluginPrefs>
        <pref name="mi_plugin_habilitado">1</pref>
        <pref name="mi_plugin_limite">10</pref>
        <pref name="mi_plugin_config">[configuración JSON]</pref>
    </pluginPrefs>
    
    <!-- Clases de usuario personalizadas -->
    <userClasses>
        <class name="mi_plugin_usuarios" description="Usuarios del plugin" />
    </userClasses>
    
    <!-- Campos extendidos de usuario -->
    <extendedFields>
        <field name="mi_campo_personalizado" type='EUF_TEXT' default='' active="true" />
    </extendedFields>
    
    <!-- Categorías de medios -->
    <mediaCategories>
        <category type="image">Imágenes Mi Plugin</category>
    </mediaCategories>
    
</e107Plugin>
```

### 2. Archivo Principal del Plugin

El archivo principal controla la lógica del frontend de tu plugin.

```php
<?php
/*
 * Mi Plugin para e107
 * Descripción del plugin
 */

if (!defined('e107_INIT')) {
    require_once(__DIR__.'/../../class2.php');
}

class mi_plugin_front {
    
    function __construct() {
        // Cargar recursos necesarios
        e107::js('mi_plugin','js/mi_plugin.js','jquery');    // JavaScript
        e107::css('mi_plugin','css/mi_plugin.css');          // CSS
        e107::lan('mi_plugin');                              // Idioma
        e107::meta('keywords','mi plugin, personalizado');   // Meta tags
    }
    
    public function run() {
        // Obtener instancias de clases principales
        $sql = e107::getDb();           // Base de datos
        $tp = e107::getParser();        // Parser HTML
        $frm = e107::getForm();         // Formularios
        $ns = e107::getRender();        // Renderizado en tema
        $mes = e107::getMessage();      // Mensajes del sistema
        
        // Configurar breadcrumb
        $this->setBreadcrumb();
        
        // Lógica principal del plugin
        $text = $this->generateContent();
        
        // Renderizar en el tema
        $ns->tablerender('Mi Plugin', $text);
    }
    
    private function setBreadcrumb() {
        $bc = e107::getBreadcrumb();
        $bc->add('Inicio', e107::url('', 'full'));
        $bc->add('Mi Plugin', e107::url('mi_plugin', 'mi_plugin'));
    }
    
    private function generateContent() {
        $sql = e107::getDb();
        $tp = e107::getParser();
        
        // Ejemplo: obtener datos de la base de datos
        if($rows = $sql->retrieve('mi_plugin_data', '*', 'activo=1', true)) {
            $template = e107::getTemplate('mi_plugin', 'mi_plugin', 'default');
            $sc = e107::getScBatch('mi_plugin', true, 'mi_plugin');
            
            $text = $tp->parseTemplate($template['start'], true, $sc);
            
            foreach($rows as $row) {
                $sc->setVars($row);
                $text .= $tp->parseTemplate($template['item'], true, $sc);
            }
            
            $text .= $tp->parseTemplate($template['end'], true, $sc);
            
            return $text;
        }
        
        return '<p>No hay contenido disponible.</p>';
    }
}

// Inicializar y ejecutar el plugin
$plugin = new mi_plugin_front();
$plugin->run();
```

### 3. Setup y Gestión de Base de Datos

#### mi_plugin_sql.php - Estructura de Base de Datos

```sql
/**
 * Estructura de base de datos para Mi Plugin
 * 
 * IMPORTANTE: No incluir prefijo de tabla e107_
 * El sistema lo añadirá automáticamente
 */

CREATE TABLE mi_plugin_data (
    id int(10) NOT NULL AUTO_INCREMENT,
    titulo varchar(255) NOT NULL,
    descripcion text,
    imagen varchar(255),
    fecha_creacion int(10) NOT NULL,
    fecha_modificacion int(10),
    usuario_id int(10) NOT NULL DEFAULT 0,
    activo tinyint(1) NOT NULL DEFAULT 1,
    orden int(5) NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    KEY idx_activo (activo),
    KEY idx_usuario (usuario_id),
    KEY idx_fecha (fecha_creacion)
);

CREATE TABLE mi_plugin_categorias (
    categoria_id int(10) NOT NULL AUTO_INCREMENT,
    categoria_nombre varchar(100) NOT NULL,
    categoria_descripcion text,
    categoria_activa tinyint(1) NOT NULL DEFAULT 1,
    PRIMARY KEY (categoria_id)
);
```

#### mi_plugin_setup.php - Rutinas de Instalación

```php
<?php

if(!class_exists("mi_plugin_setup")) {
    class mi_plugin_setup {
        
        /**
         * Ejecutado ANTES de crear las tablas
         */
        function install_pre($var) {
            // Verificaciones previas
            $mes = e107::getMessage();
            
            // Verificar versión de PHP
            if(version_compare(PHP_VERSION, '7.4.0', '<')) {
                $mes->addError('Este plugin requiere PHP 7.4 o superior');
                return false;
            }
            
            return true;
        }
        
        /**
         * Ejecutado DESPUÉS de crear las tablas
         * Para insertar datos iniciales
         */
        function install_post($var) {
            $sql = e107::getDb();
            $mes = e107::getMessage();
            
            // Insertar categorías por defecto
            $categorias_default = [
                ['categoria_nombre' => 'General', 'categoria_descripcion' => 'Categoría general'],
                ['categoria_nombre' => 'Destacados', 'categoria_descripcion' => 'Elementos destacados']
            ];
            
            foreach($categorias_default as $categoria) {
                $sql->insert('mi_plugin_categorias', $categoria);
            }
            
            // Insertar datos de ejemplo
            $datos_ejemplo = [
                'titulo' => 'Elemento de ejemplo',
                'descripcion' => 'Este es un elemento de ejemplo creado durante la instalación',
                'fecha_creacion' => time(),
                'usuario_id' => 1,
                'activo' => 1
            ];
            
            $sql->insert('mi_plugin_data', $datos_ejemplo);
            
            $mes->addSuccess('Plugin instalado correctamente con datos de ejemplo');
        }
        
        /**
         * Ejecutado durante actualizaciones
         */
        function upgrade_post($var) {
            $sql = e107::getDb();
            $mes = e107::getMessage();
            
            // Lógica de actualización según versión
            $version_actual = $var['plugin_version'];
            $version_nueva = $var['plugin_version_new'];
            
            if(version_compare($version_actual, '1.1', '<')) {
                // Actualización a versión 1.1
                // Añadir nueva columna si no existe
                if(!$sql->field_exists('mi_plugin_data', 'nueva_columna')) {
                    $sql->gen('ALTER TABLE '.MPREFIX.'mi_plugin_data ADD nueva_columna VARCHAR(100) DEFAULT ""');
                }
            }
            
            $mes->addSuccess('Plugin actualizado correctamente');
        }
        
        /**
         * Ejecutado ANTES de desinstalar
         */
        function uninstall_pre($var) {
            // Crear backup de datos importantes si es necesario
            return true;
        }
        
        /**
         * Ejecutado DESPUÉS de desinstalar
         */
        function uninstall_post($var) {
            $mes = e107::getMessage();
            
            // Limpiar archivos subidos, caché, etc.
            $upload_path = e107::getFolder('media').'mi_plugin/';
            if(is_dir($upload_path)) {
                e107::getFile()->rmdir($upload_path, true);
            }
            
            // Limpiar preferencias relacionadas
            e107::getConfig()->remove('mi_plugin_config_extra');
            e107::getConfig()->save();
            
            $mes->addSuccess('Plugin desinstalado completamente');
        }
    }
}
```

### 4. Shortcodes Personalizados

```php
<?php
/**
 * Shortcodes personalizados para Mi Plugin
 * Disponibles en todo el sitio
 */

if(!defined('e107_INIT')) {
    exit;
}

class mi_plugin_shortcodes extends e_shortcode {
    
    public $override = false; // No sobrescribir shortcodes existentes
    
    /**
     * Shortcode: {MI_PLUGIN_LISTA}
     * Muestra una lista de elementos
     */
    function sc_mi_plugin_lista($parm = '') {
        $sql = e107::getDb();
        $tp = e107::getParser();
        
        // Parámetros: limite|categoria|orden
        $params = explode('|', $parm);
        $limite = (int)($params[0] ?? 5);
        $categoria = (int)($params[1] ?? 0);
        $orden = $params[2] ?? 'fecha_creacion DESC';
        
        $where = 'activo=1';
        if($categoria > 0) {
            $where .= ' AND categoria_id='.$categoria;
        }
        
        if($elementos = $sql->retrieve('mi_plugin_data', '*', 
           $where.' ORDER BY '.$orden.' LIMIT '.$limite, true)) {
            
            $html = '<div class="mi-plugin-lista">';
            foreach($elementos as $elemento) {
                $html .= '<div class="mi-plugin-item">';
                $html .= '<h3>'.$tp->toHTML($elemento['titulo']).'</h3>';
                $html .= '<p>'.$tp->toHTML($elemento['descripcion']).'</p>';
                $html .= '<small>'.date('d/m/Y', $elemento['fecha_creacion']).'</small>';
                $html .= '</div>';
            }
            $html .= '</div>';
            
            return $html;
        }
        
        return '<p>No hay elementos disponibles.</p>';
    }
    
    /**
     * Shortcode: {MI_PLUGIN_CONTADOR}
     * Muestra el número total de elementos
     */
    function sc_mi_plugin_contador($parm = '') {
        $sql = e107::getDb();
        
        $activos_solo = ($parm === 'activos');
        $where = $activos_solo ? 'activo=1' : '1';
        
        $count = $sql->count('mi_plugin_data', '(*)', $where);
        
        return '<span class="mi-plugin-contador">'.$count.'</span>';
    }
    
    /**
     * Shortcode: {MI_PLUGIN_DESTACADO}
     * Muestra un elemento aleatorio destacado
     */
    function sc_mi_plugin_destacado($parm = '') {
        $sql = e107::getDb();
        $tp = e107::getParser();
        
        if($elemento = $sql->retrieve('mi_plugin_data', '*', 
           'activo=1 ORDER BY RAND() LIMIT 1')) {
            
            $template = e107::getTemplate('mi_plugin', 'destacado');
            $sc = e107::getScBatch('mi_plugin', true);
            $sc->setVars($elemento);
            
            return $tp->parseTemplate($template, true, $sc);
        }
        
        return '';
    }
}
```

---

## 🗺️ Roadmap de Desarrollo

Sigue este roadmap paso a paso para crear plugins robustos y escalables:

### Fase 1: Planificación y Diseño (1-2 días)

#### ✅ Paso 1: Definir Objetivos
- [ ] **Propósito del plugin**: ¿Qué problema resuelve?
- [ ] **Funcionalidades principales**: Lista de características core
- [ ] **Usuarios objetivo**: ¿Quién lo usará?
- [ ] **Compatibilidad**: Versiones de e107 soportadas

#### ✅ Paso 2: Diseño de Base de Datos
- [ ] **Identificar entidades**: Tablas necesarias
- [ ] **Definir relaciones**: Claves foráneas y vínculos
- [ ] **Campos requeridos**: Estructura de cada tabla
- [ ] **Índices y optimización**: Para consultas eficientes

#### ✅ Paso 3: Arquitectura del Plugin
- [ ] **Flujo de usuario**: Cómo interactuarán con el plugin
- [ ] **Interfaz de administración**: Qué configuraciones necesita
- [ ] **Integración con e107**: Qué hooks y eventos usar
- [ ] **Dependencias**: Otros plugins o librerías necesarias

### Fase 2: Configuración Inicial (1 día)

#### ✅ Paso 4: Preparar Estructura Base
```bash
# Copiar plugin _blank como plantilla
cp -r e107_plugins/_blank e107_plugins/mi_plugin

# Renombrar archivos principales
mv _blank.php mi_plugin.php
mv _blank_setup.php mi_plugin_setup.php
mv _blank_sql.php mi_plugin_sql.php
# ... etc
```

#### ✅ Paso 5: Configurar plugin.xml
- [ ] **Metadatos básicos**: Nombre, versión, autor
- [ ] **Descripción**: Summary y description detallada
- [ ] **Enlaces de administración**: AdminLinks necesarios
- [ ] **Enlaces públicos**: SiteLinks del frontend
- [ ] **Preferencias**: PluginPrefs por defecto

#### ✅ Paso 6: Estructura de Directorios
- [ ] **Crear carpetas**: templates/, css/, js/, images/, languages/
- [ ] **Iconos del plugin**: 16px, 32px, 128px
- [ ] **Archivos base**: Crear archivos vacíos necesarios

### Fase 3: Base de Datos (1-2 días)

#### ✅ Paso 7: Definir Esquema SQL
- [ ] **Crear mi_plugin_sql.php**: Estructura de tablas
- [ ] **Definir campos**: Tipos de datos apropiados
- [ ] **Añadir índices**: Para optimización
- [ ] **Documentar estructura**: Comentarios en SQL

#### ✅ Paso 8: Rutinas de Instalación
- [ ] **install_pre()**: Verificaciones previas
- [ ] **install_post()**: Datos iniciales
- [ ] **upgrade_post()**: Lógica de actualización
- [ ] **uninstall_post()**: Limpieza completa

#### ✅ Paso 9: Pruebas de BD
- [ ] **Instalar plugin**: Verificar creación de tablas
- [ ] **Datos de prueba**: Insertar contenido de ejemplo
- [ ] **Desinstalar**: Verificar limpieza completa
- [ ] **Reinstalar**: Confirmar que funciona correctamente

### Fase 4: Lógica Principal (3-5 días)

#### ✅ Paso 10: Archivo Principal
- [ ] **Clase principal**: mi_plugin_front
- [ ] **Constructor**: Cargar recursos (CSS, JS, idiomas)
- [ ] **Método run()**: Lógica principal del frontend
- [ ] **Métodos auxiliares**: Funciones de soporte

#### ✅ Paso 11: Acceso a Datos
- [ ] **Métodos CRUD**: Create, Read, Update, Delete
- [ ] **Validaciones**: Sanitización de datos
- [ ] **Manejo de errores**: Try-catch y logging
- [ ] **Optimización**: Consultas eficientes

#### ✅ Paso 12: Lógica de Negocio
- [ ] **Funcionalidades core**: Implementar características principales
- [ ] **Validaciones de negocio**: Reglas específicas
- [ ] **Integración con e107**: Usar APIs del sistema
- [ ] **Manejo de permisos**: Verificar accesos

### Fase 5: Panel de Administración (2-3 días)

#### ✅ Paso 13: admin_config.php Base
- [ ] **Clase dispatcher**: plugin_mi_plugin_admin
- [ ] **Modos de operación**: main, config, stats, etc.
- [ ] **Menú de administración**: adminMenu array
- [ ] **Permisos**: Verificar acceso de administrador

#### ✅ Paso 14: Formularios de Configuración
- [ ] **Clase UI**: plugin_mi_plugin_admin_form_ui
- [ ] **Campos de configuración**: Usando e_form
- [ ] **Validación de formularios**: Server-side validation
- [ ] **Mensajes de confirmación**: Success/error feedback

#### ✅ Paso 15: Gestión de Contenido
- [ ] **Listado de elementos**: Tabla con paginación
- [ ] **Formularios CRUD**: Crear, editar, eliminar
- [ ] **Búsqueda y filtros**: Funcionalidad de búsqueda
- [ ] **Acciones en lote**: Operaciones múltiples

### Fase 6: Frontend y Templates (2-3 días)

#### ✅ Paso 16: Plantillas HTML
- [ ] **Template principal**: mi_plugin_template.php
- [ ] **Estructura responsive**: Bootstrap-compatible
- [ ] **Shortcodes de template**: Variables dinámicas
- [ ] **Múltiples layouts**: Diferentes vistas

#### ✅ Paso 17: Estilos CSS
- [ ] **CSS principal**: mi_plugin.css
- [ ] **Responsive design**: Media queries
- [ ] **Integración con tema**: Variables CSS del tema
- [ ] **Optimización**: Minificación para producción

#### ✅ Paso 18: JavaScript (si necesario)
- [ ] **Funcionalidad interactiva**: mi_plugin.js
- [ ] **Integración con jQuery**: Usar framework incluido
- [ ] **AJAX**: Comunicación asíncrona
- [ ] **Validación client-side**: Mejorar UX

### Fase 7: Extensiones del Sistema (1-2 días)

#### ✅ Paso 19: Shortcodes Personalizados
- [ ] **e_shortcode.php**: Clase de shortcodes
- [ ] **Shortcodes útiles**: Lista, contador, destacados
- [ ] **Parámetros flexibles**: Configuración por shortcode
- [ ] **Documentación**: Cómo usar cada shortcode

#### ✅ Paso 20: Integración con Sistema
- [ ] **e_search.php**: Búsqueda del sitio
- [ ] **e_url.php**: URLs amigables
- [ ] **e_event.php**: Eventos y hooks
- [ ] **e_menu.php**: Configuración de menús

### Fase 8: Internacionalización (1 día)

#### ✅ Paso 21: Archivos de Idioma
- [ ] **English_global.php**: Strings principales
- [ ] **English_admin.php**: Textos de administración
- [ ] **Constantes LAN_**: Nomenclatura correcta
- [ ] **Pluralización**: Manejo de singular/plural

#### ✅ Paso 22: Implementar Traducciones
- [ ] **Usar e107::lan()**: Cargar idiomas
- [ ] **Constantes en código**: Reemplazar strings hardcoded
- [ ] **Templates multiidioma**: Soporte en plantillas
- [ ] **Idiomas adicionales**: Traducir a otros idiomas

### Fase 9: Testing y Debugging (2-3 días)

#### ✅ Paso 23: Pruebas Funcionales
- [ ] **Instalación/desinstalación**: Múltiples ciclos
- [ ] **Funcionalidades core**: Cada característica
- [ ] **Panel de administración**: Todos los formularios
- [ ] **Frontend**: Diferentes escenarios de uso

#### ✅ Paso 24: Pruebas de Compatibilidad
- [ ] **Versiones de e107**: 2.3.x compatibility
- [ ] **Versiones de PHP**: 7.4, 8.0, 8.1, 8.2
- [ ] **Diferentes temas**: Verificar renderizado
- [ ] **Navegadores**: Chrome, Firefox, Safari, Edge

#### ✅ Paso 25: Optimización
- [ ] **Rendimiento**: Profiling de consultas
- [ ] **Memoria**: Verificar uso de RAM
- [ ] **Caché**: Implementar donde sea apropiado
- [ ] **Seguridad**: Audit de vulnerabilidades

### Fase 10: Documentación y Distribución (1-2 días)

#### ✅ Paso 26: Documentación
- [ ] **README.md**: Instalación y uso básico
- [ ] **Documentación técnica**: Para desarrolladores
- [ ] **Manual de usuario**: Para administradores
- [ ] **Changelog**: Historial de versiones

#### ✅ Paso 27: Preparar Distribución
- [ ] **Limpiar código**: Remover debug y comentarios
- [ ] **Versión final**: Actualizar plugin.xml
- [ ] **Crear package**: ZIP para distribución
- [ ] **Publicar**: GitHub, e107.org, etc.

---

## 💡 Ejemplos Prácticos

### Ejemplo Completo: Plugin de Testimonios

Vamos a crear un plugin completo paso a paso para gestionar testimonios de clientes.

#### 1. Estructura del Plugin

```
testimonios/
├── plugin.xml
├── testimonios.php
├── testimonios_setup.php
├── testimonios_sql.php
├── admin_config.php
├── e_shortcode.php
├── e_search.php
├── templates/
│   ├── testimonios_template.php
│   └── testimonios_admin_template.php
├── css/
│   └── testimonios.css
├── js/
│   └── testimonios.js
├── images/
│   ├── testimonios_16.png
│   ├── testimonios_32.png
│   └── testimonios_128.png
└── languages/
    └── English/
        ├── English_global.php
        └── English_admin.php
```

#### 2. plugin.xml

```xml
<?xml version="1.0" encoding="utf-8"?>
<e107Plugin name="Testimonios" lan="LAN_PLUGIN_TESTIMONIOS_NAME" 
            version="1.0" date="2024-01-01" compatibility="2.3" 
            installRequired="true">
    
    <author name="Tu Nombre" url="https://tuwebsite.com" />
    <summary>Sistema completo de testimonios para tu sitio web</summary>
    <description lan="LAN_PLUGIN_TESTIMONIOS_DIZ">Permite a los usuarios enviar testimonios y a los administradores gestionarlos con sistema de aprobación.</description>
    <category>content</category>
    
    <keywords>
        <word>testimonios</word>
        <word>reviews</word>
        <word>clientes</word>
        <word>opiniones</word>
    </keywords>
    
    <adminLinks>
        <link url='admin_config.php' description='Gestionar Testimonios' 
              icon='images/testimonios_32.png' iconSmall='images/testimonios_16.png' 
              primary='true'>LAN_PLUGIN_TESTIMONIOS_ADMIN</link>
        <link url="admin_config.php?mode=config" description="Configuración" 
              icon="settings">LAN_PLUGIN_TESTIMONIOS_CONFIG</link>
        <link url="admin_config.php?mode=stats" description="Estadísticas" 
              icon="chart">LAN_PLUGIN_TESTIMONIOS_STATS</link>
    </adminLinks>
    
    <siteLinks>
        <link category="1" url="{e_PLUGIN}testimonios/testimonios.php" 
              perm='everyone' sef='testimonios'>LAN_PLUGIN_TESTIMONIOS_LINK</link>
    </siteLinks>
    
    <pluginPrefs>
        <pref name="testimonios_habilitado">1</pref>
        <pref name="testimonios_aprobacion_requerida">1</pref>
        <pref name="testimonios_por_pagina">10</pref>
        <pref name="testimonios_permitir_anonimos">0</pref>
        <pref name="testimonios_rating_habilitado">1</pref>
        <pref name="testimonios_email_notificacion">admin@sitio.com</pref>
    </pluginPrefs>
    
</e107Plugin>
```

#### 3. Base de Datos (testimonios_sql.php)

```sql
/**
 * Estructura de base de datos para el plugin Testimonios
 */

CREATE TABLE testimonios (
    testimonio_id int(10) NOT NULL AUTO_INCREMENT,
    testimonio_nombre varchar(100) NOT NULL,
    testimonio_email varchar(100) NOT NULL,
    testimonio_empresa varchar(100),
    testimonio_cargo varchar(100),
    testimonio_sitio_web varchar(255),
    testimonio_texto text NOT NULL,
    testimonio_rating int(1) DEFAULT 5,
    testimonio_imagen varchar(255),
    testimonio_fecha int(10) NOT NULL,
    testimonio_ip varchar(45),
    testimonio_usuario_id int(10) DEFAULT 0,
    testimonio_aprobado tinyint(1) DEFAULT 0,
    testimonio_destacado tinyint(1) DEFAULT 0,
    testimonio_activo tinyint(1) DEFAULT 1,
    testimonio_orden int(5) DEFAULT 0,
    PRIMARY KEY (testimonio_id),
    KEY idx_aprobado (testimonio_aprobado),
    KEY idx_destacado (testimonio_destacado),
    KEY idx_fecha (testimonio_fecha),
    KEY idx_usuario (testimonio_usuario_id)
);

CREATE TABLE testimonios_categorias (
    categoria_id int(10) NOT NULL AUTO_INCREMENT,
    categoria_nombre varchar(100) NOT NULL,
    categoria_descripcion text,
    categoria_activa tinyint(1) DEFAULT 1,
    categoria_orden int(5) DEFAULT 0,
    PRIMARY KEY (categoria_id)
);

CREATE TABLE testimonios_config (
    config_nombre varchar(100) NOT NULL,
    config_valor text,
    PRIMARY KEY (config_nombre)
);
```

#### 4. Setup (testimonios_setup.php)

```php
<?php

if(!class_exists("testimonios_setup")) {
    class testimonios_setup {
        
        function install_post($var) {
            $sql = e107::getDb();
            $mes = e107::getMessage();
            
            // Insertar categorías por defecto
            $categorias = [
                ['categoria_nombre' => 'General', 'categoria_descripcion' => 'Testimonios generales', 'categoria_orden' => 1],
                ['categoria_nombre' => 'Servicios', 'categoria_descripcion' => 'Testimonios sobre servicios', 'categoria_orden' => 2],
                ['categoria_nombre' => 'Productos', 'categoria_descripcion' => 'Testimonios sobre productos', 'categoria_orden' => 3]
            ];
            
            foreach($categorias as $categoria) {
                $sql->insert('testimonios_categorias', $categoria);
            }
            
            // Insertar testimonio de ejemplo
            $testimonio_ejemplo = [
                'testimonio_nombre' => 'Juan Pérez',
                'testimonio_email' => 'juan@ejemplo.com',
                'testimonio_empresa' => 'Empresa Ejemplo S.L.',
                'testimonio_cargo' => 'Director General',
                'testimonio_texto' => 'Excelente servicio, muy recomendable. El equipo es profesional y los resultados superaron nuestras expectativas.',
                'testimonio_rating' => 5,
                'testimonio_fecha' => time(),
                'testimonio_aprobado' => 1,
                'testimonio_destacado' => 1,
                'testimonio_activo' => 1
            ];
            
            $sql->insert('testimonios', $testimonio_ejemplo);
            
            // Configuración inicial
            $config_inicial = [
                ['config_nombre' => 'email_template_nuevo', 'config_valor' => 'Nuevo testimonio recibido de {NOMBRE}'],
                ['config_nombre' => 'email_template_aprobado', 'config_valor' => 'Su testimonio ha sido aprobado']
            ];
            
            foreach($config_inicial as $config) {
                $sql->insert('testimonios_config', $config);
            }
            
            $mes->addSuccess('Plugin Testimonios instalado correctamente');
        }
        
        function uninstall_post($var) {
            $mes = e107::getMessage();
            
            // Limpiar archivos de imágenes
            $upload_path = e107::getFolder('media').'testimonios/';
            if(is_dir($upload_path)) {
                e107::getFile()->rmdir($upload_path, true);
            }
            
            $mes->addSuccess('Plugin Testimonios desinstalado completamente');
        }
    }
}
```

#### 5. Shortcodes (e_shortcode.php)

```php
<?php

if(!defined('e107_INIT')) {
    exit;
}

class testimonios_shortcodes extends e_shortcode {
    
    /**
     * Shortcode: {TESTIMONIOS_LISTA=limite|categoria|destacados}
     * Ejemplo: {TESTIMONIOS_LISTA=5|1|1} - 5 testimonios destacados de categoría 1
     */
    function sc_testimonios_lista($parm = '') {
        $sql = e107::getDb();
        $tp = e107::getParser();
        
        // Parsear parámetros
        $params = explode('|', $parm);
        $limite = (int)($params[0] ?? 5);
        $categoria = (int)($params[1] ?? 0);
        $solo_destacados = (int)($params[2] ?? 0);
        
        // Construir WHERE
        $where = 'testimonio_aprobado=1 AND testimonio_activo=1';
        
        if($categoria > 0) {
            $where .= ' AND categoria_id='.$categoria;
        }
        
        if($solo_destacados) {
            $where .= ' AND testimonio_destacado=1';
        }
        
        // Obtener testimonios
        if($testimonios = $sql->retrieve('testimonios', '*', 
           $where.' ORDER BY testimonio_orden ASC, testimonio_fecha DESC LIMIT '.$limite, true)) {
            
            $template = e107::getTemplate('testimonios', 'testimonios', 'lista');
            $html = $tp->parseTemplate($template['start'], true);
            
            foreach($testimonios as $testimonio) {
                $sc = e107::getScBatch('testimonios', true);
                $sc->setVars($testimonio);
                $html .= $tp->parseTemplate($template['item'], true, $sc);
            }
            
            $html .= $tp->parseTemplate($template['end'], true);
            return $html;
        }
        
        return '<div class="alert alert-info">No hay testimonios disponibles.</div>';
    }
    
    /**
     * Shortcode: {TESTIMONIOS_CONTADOR}
     * Muestra el número total de testimonios aprobados
     */
    function sc_testimonios_contador($parm = '') {
        $sql = e107::getDb();
        
        $count = $sql->count('testimonios', '(*)', 'testimonio_aprobado=1 AND testimonio_activo=1');
        
        return '<span class="testimonios-contador badge badge-primary">'.$count.'</span>';
    }
    
    /**
     * Shortcode: {TESTIMONIOS_RATING_PROMEDIO}
     * Calcula y muestra el rating promedio
     */
    function sc_testimonios_rating_promedio($parm = '') {
        $sql = e107::getDb();
        
        if($result = $sql->retrieve('testimonios', 'AVG(testimonio_rating) as promedio', 
           'testimonio_aprobado=1 AND testimonio_activo=1 AND testimonio_rating > 0')) {
            
            $promedio = round($result['promedio'], 1);
            $estrellas = str_repeat('★', floor($promedio)) . str_repeat('☆', 5 - floor($promedio));
            
            return '<span class="testimonios-rating" title="'.$promedio.' de 5">'.$estrellas.' ('.$promedio.')</span>';
        }
        
        return '';
    }
    
    /**
     * Shortcode: {TESTIMONIOS_FORMULARIO}
     * Muestra el formulario para enviar testimonios
     */
    function sc_testimonios_formulario($parm = '') {
        $frm = e107::getForm();
        $tp = e107::getParser();
        
        // Verificar si está habilitado
        if(!e107::pref('testimonios_habilitado')) {
            return '<div class="alert alert-warning">Los testimonios están deshabilitados temporalmente.</div>';
        }
        
        // Verificar permisos
        if(!e107::pref('testimonios_permitir_anonimos') && !USER) {
            return '<div class="alert alert-info">Debe <a href="'.e107::url('login').'">iniciar sesión</a> para enviar un testimonio.</div>';
        }
        
        $template = e107::getTemplate('testimonios', 'testimonios', 'formulario');
        
        // Variables para el template
        $vars = [
            'FORM_OPEN' => $frm->open('testimonio_form', 'post', e107::url('testimonios', 'testimonios')),
            'FORM_CLOSE' => $frm->close(),
            'NOMBRE_INPUT' => $frm->text('testimonio_nombre', '', 100, ['placeholder' => 'Su nombre completo', 'required' => true]),
            'EMAIL_INPUT' => $frm->email('testimonio_email', '', 100, ['placeholder' => 'su@email.com', 'required' => true]),
            'EMPRESA_INPUT' => $frm->text('testimonio_empresa', '', 100, ['placeholder' => 'Nombre de su empresa (opcional)']),
            'CARGO_INPUT' => $frm->text('testimonio_cargo', '', 100, ['placeholder' => 'Su cargo (opcional)']),
            'TEXTO_INPUT' => $frm->textarea('testimonio_texto', '', 5, 80, ['placeholder' => 'Escriba su testimonio aquí...', 'required' => true]),
            'RATING_INPUT' => $this->generateRatingInput(),
            'SUBMIT_BUTTON' => $frm->submit('enviar_testimonio', 'Enviar Testimonio', ['class' => 'btn btn-primary'])
        ];
        
        $sc = e107::getScBatch('testimonios', true);
        $sc->setVars($vars);
        
        return $tp->parseTemplate($template, true, $sc);
    }
    
    private function generateRatingInput() {
        if(!e107::pref('testimonios_rating_habilitado')) {
            return '';
        }
        
        $html = '<div class="rating-input">';
        $html .= '<label>Calificación:</label>';
        for($i = 5; $i >= 1; $i--) {
            $html .= '<input type="radio" name="testimonio_rating" value="'.$i.'" id="rating'.$i.'">';
            $html .= '<label for="rating'.$i.'">★</label>';
        }
        $html .= '</div>';
        
        return $html;
    }
}
```

#### 6. Templates (templates/testimonios_template.php)

```php
<?php
/**
 * Templates para el plugin Testimonios
 */

// Template para lista de testimonios
$TESTIMONIOS_TEMPLATE['lista']['start'] = '
<div class="testimonios-container">
    <div class="row">';

$TESTIMONIOS_TEMPLATE['lista']['item'] = '
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="testimonio-card card h-100">
            <div class="card-body">
                <div class="testimonio-rating mb-2">
                    {TESTIMONIO_RATING_STARS}
                </div>
                <blockquote class="testimonio-texto">
                    "{TESTIMONIO_TEXTO}"
                </blockquote>
                <footer class="testimonio-autor">
                    <strong>{TESTIMONIO_NOMBRE}</strong>
                    {TESTIMONIO_EMPRESA: <br><small class="text-muted">{TESTIMONIO_CARGO}, {TESTIMONIO_EMPRESA}</small>}
                    <small class="text-muted d-block">{TESTIMONIO_FECHA=relative}</small>
                </footer>
            </div>
        </div>
    </div>';

$TESTIMONIOS_TEMPLATE['lista']['end'] = '
    </div>
</div>';

// Template para testimonio destacado
$TESTIMONIOS_TEMPLATE['destacado'] = '
<div class="testimonio-destacado bg-light p-4 rounded">
    <div class="row align-items-center">
        <div class="col-md-8">
            <blockquote class="mb-3">
                <p class="lead">"{TESTIMONIO_TEXTO}"</p>
            </blockquote>
            <footer>
                <strong>{TESTIMONIO_NOMBRE}</strong>
                {TESTIMONIO_EMPRESA: - <em>{TESTIMONIO_CARGO}, {TESTIMONIO_EMPRESA}</em>}
            </footer>
        </div>
        <div class="col-md-4 text-center">
            <div class="testimonio-rating-large">
                {TESTIMONIO_RATING_STARS}
            </div>
        </div>
    </div>
</div>';

// Template para formulario
$TESTIMONIOS_TEMPLATE['formulario'] = '
<div class="testimonio-formulario">
    <h3>Enviar Testimonio</h3>
    {FORM_OPEN}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nombre *</label>
                    {NOMBRE_INPUT}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email *</label>
                    {EMAIL_INPUT}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Empresa</label>
                    {EMPRESA_INPUT}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Cargo</label>
                    {CARGO_INPUT}
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Su Testimonio *</label>
            {TEXTO_INPUT}
        </div>
        <div class="form-group">
            {RATING_INPUT}
        </div>
        <div class="form-group">
            {SUBMIT_BUTTON}
        </div>
    {FORM_CLOSE}
</div>';

// Shortcodes específicos para testimonios
class testimonios_template_shortcodes extends e_shortcode {
    
    function sc_testimonio_rating_stars($parm = '') {
        $rating = (int)$this->var['testimonio_rating'];
        if($rating <= 0) return '';
        
        $stars = str_repeat('<i class="fas fa-star text-warning"></i>', $rating);
        $empty = str_repeat('<i class="far fa-star text-muted"></i>', 5 - $rating);
        
        return '<div class="rating-stars">'.$stars.$empty.'</div>';
    }
    
    function sc_testimonio_texto($parm = '') {
        $tp = e107::getParser();
        $texto = $this->var['testimonio_texto'];
        
        // Limitar longitud si se especifica
        if($parm && is_numeric($parm)) {
            $texto = $tp->text_truncate($texto, (int)$parm);
        }
        
        return $tp->toHTML($texto, true);
    }
    
    function sc_testimonio_fecha($parm = 'short') {
        $fecha = (int)$this->var['testimonio_fecha'];
        
        switch($parm) {
            case 'relative':
                return e107::getDate()->computeLapse($fecha);
            case 'long':
                return date('d \d\e F \d\e Y', $fecha);
            default:
                return date('d/m/Y', $fecha);
        }
    }
}
```

---

## ⭐ Mejores Prácticas

### 🔒 Seguridad

#### Validación y Sanitización de Datos

```php
// ✅ CORRECTO: Validar y sanitizar entrada
function procesarTestimonio($datos) {
    $sql = e107::getDb();
    $tp = e107::getParser();
    $mes = e107::getMessage();
    
    // Validar campos requeridos
    if(empty($datos['nombre']) || empty($datos['email']) || empty($datos['texto'])) {
        $mes->addError('Todos los campos marcados con * son obligatorios');
        return false;
    }
    
    // Validar email
    if(!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $mes->addError('El email no tiene un formato válido');
        return false;
    }
    
    // Sanitizar datos
    $testimonio = [
        'testimonio_nombre' => $tp->toDB($datos['nombre']),
        'testimonio_email' => $tp->toDB($datos['email']),
        'testimonio_texto' => $tp->toDB($datos['texto']),
        'testimonio_rating' => (int)$datos['rating'],
        'testimonio_fecha' => time(),
        'testimonio_ip' => e107::getIPHandler()->getIP(),
        'testimonio_usuario_id' => (int)USERID
    ];
    
    // Usar prepared statement
    return $sql->insert('testimonios', $testimonio);
}

// ❌ INCORRECTO: Insertar datos sin validar
function procesarTestimonioMal($datos) {
    $sql = e107::getDb();
    
    // Peligroso: datos sin validar ni sanitizar
    $sql->gen("INSERT INTO testimonios (nombre, email, texto) VALUES 
               ('{$datos['nombre']}', '{$datos['email']}', '{$datos['texto']}')");
}
```

#### Verificación de Permisos

```php
// ✅ CORRECTO: Verificar permisos antes de acciones críticas
class testimonios_admin {
    
    function __construct() {
        // Verificar permisos de administrador
        if(!getperms('P')) {
            e107::redirect('admin');
            exit;
        }
    }
    
    function eliminarTestimonio($id) {
        // Doble verificación
        if(!getperms('P') || !is_numeric($id)) {
            return false;
        }
        
        $sql = e107::getDb();
        return $sql->delete('testimonios', 'testimonio_id='.(int)$id);
    }
}

// Frontend: verificar si el usuario puede enviar testimonios
function puedeEnviarTestimonio() {
    // Si requiere login y no está logueado
    if(!e107::pref('testimonios_permitir_anonimos') && !USER) {
        return false;
    }
    
    // Si está deshabilitado
    if(!e107::pref('testimonios_habilitado')) {
        return false;
    }
    
    // Verificar límite por IP (anti-spam)
    $sql = e107::getDb();
    $ip = e107::getIPHandler()->getIP();
    $hace_24h = time() - (24 * 3600);
    
    $count = $sql->count('testimonios', '(*)', 
        'testimonio_ip="'.$sql->escape($ip).'" AND testimonio_fecha > '.$hace_24h);
    
    return $count < 3; // Máximo 3 por día por IP
}
```

### ⚠️ Errores Comunes a Evitar

#### 1. No usar prefijos de tabla

```php
// ❌ INCORRECTO
$sql->select('testimonios', '*', 'activo=1');

// ✅ CORRECTO - e107 añade el prefijo automáticamente
$sql->select('testimonios', '*', 'testimonio_activo=1');
```

#### 2. Hardcodear rutas

```php
// ❌ INCORRECTO
$imagen_url = '/e107_plugins/testimonios/images/default.jpg';

// ✅ CORRECTO
$imagen_url = e107::getPluginPath('testimonios').'images/default.jpg';
// o mejor aún
$imagen_url = '{e_PLUGIN}testimonios/images/default.jpg';
```

#### 3. No manejar errores de base de datos

```php
// ❌ INCORRECTO
function obtenerTestimonios() {
    $sql = e107::getDb();
    return $sql->retrieve('testimonios', '*', 'activo=1', true);
}

// ✅ CORRECTO
function obtenerTestimonios() {
    $sql = e107::getDb();
    
    try {
        $result = $sql->retrieve('testimonios', '*', 'testimonio_activo=1', true);
        
        if($result === false) {
            e107::getMessage()->addError('Error al obtener testimonios');
            return [];
        }
        
        return $result;
        
    } catch(Exception $e) {
        e107::getMessage()->addError('Error de base de datos: '.$e->getMessage());
        return [];
    }
}
```

#### 4. Ignorar la internacionalización

```php
// ❌ INCORRECTO
echo '<h2>Lista de Testimonios</h2>';
echo '<p>No hay testimonios disponibles</p>';

// ✅ CORRECTO
echo '<h2>'.LAN_PLUGIN_TESTIMONIOS_LISTA_TITULO.'</h2>';
echo '<p>'.LAN_PLUGIN_TESTIMONIOS_NO_DISPONIBLES.'</p>';

// o usando el parser
$tp = e107::getParser();
echo $tp->lanVars('<h2>[LAN=LAN_PLUGIN_TESTIMONIOS_LISTA_TITULO]</h2>');
```

### ✅ Convenciones de Código

#### Nomenclatura de Archivos y Clases

```php
// Estructura de nombres
Plugin: testimonios
Archivo principal: testimonios.php
Clase principal: testimonios_front
Setup: testimonios_setup
Shortcodes: testimonios_shortcodes
Admin: testimonios_admin
Tabla: testimonios (sin prefijo)
Campos: testimonio_id, testimonio_nombre, etc.
```

#### Constantes de Idioma

```php
// languages/English/English_global.php
define('LAN_PLUGIN_TESTIMONIOS_NAME', 'Testimonios');
define('LAN_PLUGIN_TESTIMONIOS_DIZ', 'Sistema de testimonios');
define('LAN_PLUGIN_TESTIMONIOS_LISTA_TITULO', 'Lista de Testimonios');
define('LAN_PLUGIN_TESTIMONIOS_NO_DISPONIBLES', 'No hay testimonios disponibles');
define('LAN_PLUGIN_TESTIMONIOS_ENVIAR', 'Enviar Testimonio');
define('LAN_PLUGIN_TESTIMONIOS_NOMBRE', 'Nombre');
define('LAN_PLUGIN_TESTIMONIOS_EMAIL', 'Email');
define('LAN_PLUGIN_TESTIMONIOS_TEXTO', 'Testimonio');
define('LAN_PLUGIN_TESTIMONIOS_RATING', 'Calificación');

// languages/English/English_admin.php
define('LAN_PLUGIN_TESTIMONIOS_ADMIN', 'Gestionar Testimonios');
define('LAN_PLUGIN_TESTIMONIOS_CONFIG', 'Configuración');
define('LAN_PLUGIN_TESTIMONIOS_STATS', 'Estadísticas');
define('LAN_PLUGIN_TESTIMONIOS_APROBAR', 'Aprobar');
define('LAN_PLUGIN_TESTIMONIOS_RECHAZAR', 'Rechazar');
define('LAN_PLUGIN_TESTIMONIOS_ELIMINAR', 'Eliminar');
```

### 🚀 Optimización y Rendimiento

#### Uso de Caché

```php
// ✅ CORRECTO: Usar caché para consultas pesadas
function obtenerTestimoniosDestacados() {
    $cache_key = 'testimonios_destacados_'.md5('destacados_activos');
    
    // Intentar obtener del caché
    if($cached = e107::getCache()->retrieve($cache_key)) {
        return $cached;
    }
    
    // Si no está en caché, consultar BD
    $sql = e107::getDb();
    $testimonios = $sql->retrieve('testimonios', '*', 
        'testimonio_destacado=1 AND testimonio_aprobado=1 AND testimonio_activo=1 
         ORDER BY testimonio_orden ASC, testimonio_fecha DESC LIMIT 5', true);
    
    // Guardar en caché por 1 hora
    e107::getCache()->set($cache_key, $testimonios, 3600);
    
    return $testimonios;
}

// Limpiar caché cuando se modifiquen testimonios
function actualizarTestimonio($id, $datos) {
    $sql = e107::getDb();
    
    if($sql->update('testimonios', $datos, 'testimonio_id='.(int)$id)) {
        // Limpiar cachés relacionados
        e107::getCache()->clear('testimonios_');
        return true;
    }
    
    return false;
}
```

#### Consultas Optimizadas

```php
// ✅ CORRECTO: Usar índices y limitar resultados
function buscarTestimonios($termino, $limite = 10, $offset = 0) {
    $sql = e107::getDb();
    $tp = e107::getParser();
    
    $termino_seguro = $sql->escape($tp->toDB($termino));
    
    // Usar FULLTEXT si está disponible, sino LIKE optimizado
    $where = "(testimonio_nombre LIKE '%{$termino_seguro}%' 
               OR testimonio_empresa LIKE '%{$termino_seguro}%' 
               OR testimonio_texto LIKE '%{$termino_seguro}%') 
              AND testimonio_aprobado=1 AND testimonio_activo=1";
    
    return $sql->retrieve('testimonios', '*', 
        $where.' ORDER BY testimonio_destacado DESC, testimonio_fecha DESC 
        LIMIT '.(int)$offset.','.(int)$limite, true);
}

// ❌ INCORRECTO: Consulta sin optimizar
function buscarTestimoniosMal($termino) {
    $sql = e107::getDb();
    
    // Sin escape, sin límite, sin índices
    return $sql->gen("SELECT * FROM testimonios WHERE testimonio_texto LIKE '%{$termino}%'");
}
```

---

## 📚 Recursos Adicionales

### 🔗 Enlaces Oficiales

- **Repositorio Principal**: [https://github.com/e107inc/e107](https://github.com/e107inc/e107)
- **Manual de Desarrollador**: [https://e107.org/developer-manual](https://e107.org/developer-manual)
- **Guía de Desarrollo**: [https://devguide.e107.org/](https://devguide.e107.org/)
- **Foro de Desarrolladores**: [https://e107.org/forum](https://e107.org/forum)
- **Wiki Técnica**: [https://github.com/e107inc/e107/wiki](https://github.com/e107inc/e107/wiki)

### 📖 Documentación Técnica

#### APIs Principales de e107

| Clase | Propósito | Obtener Instancia |
|-------|-----------|-------------------|
| `e107::getDb()` | Base de datos | `$sql = e107::getDb();` |
| `e107::getParser()` | Parsing HTML/texto | `$tp = e107::getParser();` |
| `e107::getForm()` | Formularios | `$frm = e107::getForm();` |
| `e107::getRender()` | Renderizado | `$ns = e107::getRender();` |
| `e107::getMessage()` | Mensajes sistema | `$mes = e107::getMessage();` |
| `e107::getCache()` | Sistema caché | `$cache = e107::getCache();` |
| `e107::getFile()` | Manejo archivos | `$file = e107::getFile();` |
| `e107::getDate()` | Fechas y tiempo | `$date = e107::getDate();` |
| `e107::getConfig()` | Configuración | `$config = e107::getConfig();` |
| `e107::getUser()` | Datos usuario | `$user = e107::getUser();` |

#### Funciones Globales Útiles

```php
// Verificación de permisos
getperms('P')           // Permisos de plugin
getperms('0')           // Administrador principal
check_class($userclass) // Verificar clase de usuario

// URLs y rutas
e107::url('plugin', 'page')     // URL del plugin
e107::getPluginPath('plugin')   // Ruta del plugin
e107::base_path('file.php')     // Ruta base del sitio

// Constantes útiles
USER                    // Datos del usuario actual
USERID                  // ID del usuario
USERNAME               // Nombre del usuario
ADMIN                  // Booleano si es admin
e_PLUGIN               // Ruta a plugins
e_IMAGE                // Ruta a imágenes
e_FILE                 // Ruta a archivos
e_THEME                // Ruta al tema actual
```

### 🛠️ Herramientas de Desarrollo

#### Debug y Logging

```php
// Habilitar debug en e107_config.php
$E107_DEBUG_LEVEL = E107_DEBUG_LEVEL_MAXIMUM;

// Logging personalizado
e107::getLog()->add('MI_PLUGIN', 'Mensaje de debug', E_LOG_INFORMATIVE);
e107::getLog()->add('MI_PLUGIN_ERROR', 'Error crítico', E_LOG_ERROR);

// Debug de consultas SQL
$sql = e107::getDb();
$sql->debug = true; // Mostrar consultas
```

#### Testing

```php
// tests/unit/testimonios_test.php
class TestimoniosTest extends PHPUnit_Framework_TestCase {
    
    public function setUp() {
        // Configurar entorno de prueba
        require_once(__DIR__.'/../../class2.php');
    }
    
    public function testCrearTestimonio() {
        $datos = array(
            'testimonio_nombre' => 'Juan Pérez',
            'testimonio_email' => 'juan@test.com',
            'testimonio_texto' => 'Excelente servicio',
            'testimonio_rating' => 5
        );
        
        $resultado = testimonios_crear($datos);
        $this->assertTrue($resultado);
    }
}
```

---

## 🐛 Debugging y Desarrollo

### Habilitar Debug

```php
// En e107_config.php
$mySQLdefaultdb = "tu_base_datos";
$E107_DEBUG_LEVEL = 9; // Nivel máximo de debug
```

### Logging Personalizado

```php
class MiPlugin_Logger
{
    public static function log($message, $level = 'info')
    {
        if (E107_DEBUG_LEVEL > 0) {
            $log_file = e_LOG . 'mi_plugin.log';
            $timestamp = date('Y-m-d H:i:s');
            $log_entry = "[{$timestamp}] [{$level}] {$message}" . PHP_EOL;
            file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
        }
    }
    
    public static function debug($data)
    {
        if (E107_DEBUG_LEVEL > 5) {
            self::log('DEBUG: ' . print_r($data, true), 'debug');
        }
    }
}

// Uso
MiPlugin_Logger::log('Plugin inicializado correctamente');
MiPlugin_Logger::debug($config_array);
```

### Herramientas de Debug

```php
// Mostrar información de debug en pantalla
if (E107_DEBUG_LEVEL > 0) {
    echo "<pre>";
    print_r($debug_data);
    echo "</pre>";
}

// Usar el sistema de mensajes para debug
e107::getMessage()->addDebug('Valor de variable: ' . $variable);

// Logging de consultas SQL
$sql = e107::getDb();
$sql->debug = true; // Habilitar debug SQL
```

---

## 🗺️ Roadmap de Desarrollo Completo

### Fase 1: Planificación (1-2 días)

#### 1. **Definir Objetivos**
- [ ] Identificar funcionalidades principales
- [ ] Definir audiencia objetivo
- [ ] Establecer requisitos técnicos
- [ ] Crear wireframes básicos

#### 2. **Diseño de Arquitectura**
- [ ] Crear diagrama de base de datos
- [ ] Definir estructura de archivos
- [ ] Planificar flujo de usuario
- [ ] Documentar APIs necesarias

#### 3. **Preparación del Entorno**
- [ ] Configurar entorno de desarrollo
- [ ] Instalar herramientas necesarias
- [ ] Crear repositorio de código
- [ ] Configurar sistema de versionado

### Fase 2: Desarrollo Base (3-5 días)

#### 4. **Estructura Inicial**
- [ ] Crear directorio del plugin
- [ ] Configurar `plugin.xml`
- [ ] Implementar `e_module.php`
- [ ] Crear estructura de carpetas

#### 5. **Funcionalidad Core**
- [ ] Desarrollar `plugin.php`
- [ ] Crear panel de administración
- [ ] Implementar base de datos
- [ ] Configurar sistema de permisos

#### 6. **Templates y Vistas**
- [ ] Diseñar templates principales
- [ ] Crear formularios de usuario
- [ ] Implementar shortcodes básicos
- [ ] Añadir estilos CSS básicos

### Fase 3: Funcionalidades Avanzadas (5-7 días)

#### 7. **Características Especiales**
- [ ] Implementar API REST
- [ ] Agregar sistema de caché
- [ ] Desarrollar widgets personalizados
- [ ] Integrar con servicios externos

#### 8. **Integración**
- [ ] Conectar con otros plugins
- [ ] Implementar hooks y filtros
- [ ] Agregar soporte multiidioma
- [ ] Configurar URLs amigables

#### 9. **Optimización**
- [ ] Optimizar consultas de base de datos
- [ ] Implementar lazy loading
- [ ] Comprimir assets (CSS/JS)
- [ ] Configurar CDN si es necesario

### Fase 4: Testing y Refinamiento (2-3 días)

#### 10. **Testing Exhaustivo**
- [ ] Pruebas unitarias
- [ ] Pruebas de integración
- [ ] Testing de rendimiento
- [ ] Pruebas de seguridad

#### 11. **Debugging y Correcciones**
- [ ] Corregir bugs encontrados
- [ ] Optimizar código
- [ ] Validar seguridad
- [ ] Revisar compatibilidad

#### 12. **Documentación**
- [ ] Crear documentación de usuario
- [ ] Documentar API
- [ ] Preparar guía de instalación
- [ ] Crear changelog

### Fase 5: Despliegue y Mantenimiento (1-2 días)

#### 13. **Preparación para Producción**
- [ ] Crear paquete de instalación
- [ ] Validar en entorno de producción
- [ ] Preparar scripts de migración
- [ ] Configurar backups

#### 14. **Lanzamiento**
- [ ] Desplegar en servidor de producción
- [ ] Configurar monitoreo
- [ ] Notificar a usuarios
- [ ] Publicar en repositorio

#### 15. **Post-Lanzamiento**
- [ ] Monitorear rendimiento
- [ ] Recopilar feedback
- [ ] Planificar actualizaciones
- [ ] Mantener documentación actualizada

---

## ✅ Checklist de Calidad

### Antes del Lanzamiento

#### Funcionalidad
- [ ] Todas las características funcionan correctamente
- [ ] Formularios validan datos apropiadamente
- [ ] Mensajes de error son claros y útiles
- [ ] Navegación es intuitiva
- [ ] Shortcodes funcionan en diferentes contextos

#### Seguridad
- [ ] Datos de entrada son validados y sanitizados
- [ ] Permisos de usuario son verificados
- [ ] Consultas SQL usan parámetros preparados
- [ ] Archivos subidos son validados
- [ ] No hay vulnerabilidades XSS o CSRF

#### Rendimiento
- [ ] Consultas de base de datos están optimizadas
- [ ] Sistema de caché está implementado
- [ ] Assets están minificados
- [ ] Imágenes están optimizadas
- [ ] Tiempo de carga es aceptable

#### Compatibilidad
- [ ] Funciona en diferentes navegadores
- [ ] Responsive en dispositivos móviles
- [ ] Compatible con versión mínima de e107
- [ ] No conflictos con otros plugins
- [ ] Funciona con diferentes temas

#### Código
- [ ] Código sigue convenciones de e107
- [ ] Comentarios son claros y útiles
- [ ] No hay código duplicado
- [ ] Manejo de errores está implementado
- [ ] Código está documentado

---

## 🎓 Conclusión

Esta guía completa proporciona todo lo necesario para desarrollar plugins profesionales para e107 Bootstrap CMS. Recuerda siempre:

### 🔑 Principios Fundamentales

1. **🛡️ Seguridad Primero**: Valida, sanitiza y escapa todos los datos
2. **⚡ Rendimiento**: Optimiza consultas y usa caché inteligentemente
3. **📱 Responsive**: Diseña pensando en todos los dispositivos
4. **🌍 Accesibilidad**: Haz tu plugin usable para todos
5. **📚 Documentación**: Documenta tu código y funcionalidades
6. **🧪 Testing**: Prueba exhaustivamente antes del lanzamiento
7. **🔄 Mantenimiento**: Planifica actualizaciones y soporte

### 🚀 Próximos Pasos

1. **Practica** con el plugin `_blank` como base
2. **Estudia** otros plugins existentes en `e107_plugins/`
3. **Participa** en la comunidad de e107
4. **Contribuye** con tus plugins al ecosistema
5. **Mantente actualizado** con las nuevas versiones

### 📞 Soporte y Comunidad

- **Foro Oficial**: [https://e107.org/forum](https://e107.org/forum)
- **Discord**: [https://discord.gg/e107](https://discord.gg/e107)
- **GitHub**: [https://github.com/e107inc/e107](https://github.com/e107inc/e107)
- **Documentación**: [https://e107.org/docs](https://e107.org/docs)

---

**¡Feliz desarrollo!** 🎉

*Última actualización: Enero 2024*  
*Versión de la guía: 2.1.0*  
*Compatible con e107 Bootstrap CMS v2.3.0+*

---

> **💡 Tip Final**: La mejor manera de aprender es practicando. Comienza con un plugin simple y ve añadiendo funcionalidades gradualmente. ¡La comunidad de e107 está aquí para ayudarte!
