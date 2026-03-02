# Memoria Técnica del Proyecto

## Trabajo de 2º Año de DAW - Institut Manuel Vazquez Montalbán
<img width="1536" height="811" alt="ChatGPT Image 14 nov 2025, 13_25_07" src="https://github.com/user-attachments/assets/23318b55-f70f-4c10-b1a5-6d6130e8b2c2" />

## Planificación y Diseño

Antes de comenzar la implementación, se definió una guía de estilos completa en la fase del
**plan de negocio**. Se establecieron colores, tipografías y logotipo basándonos en principios
de psicología del color y en el perfil del cliente objetivo. El objetivo fue evitar decisiones
improvisadas durante el desarrollo.<br><br>
Se realizaron **wireframes** iniciales a mano para definir la estructura de navegación y la
jerarquía visual. Luego, se trasladaron a **Figma** para crear un mockup de alta fidelidad. Esto
permitió comenzar la programación con una referencia visual clara y reducir cambios en
fases avanzadas.

## Arquitectura MVC

El proyecto se desarrolló siguiendo el **patrón Modelo, Vista, Controlador (MVC)** , estudiado
en la asignatura de DWES.
Se decidió usar esta arquitectura porque permite separar responsabilidades claramente:<br>
**Modelo:** Gestiona la conexión con la base de datos y las operaciones CRUD.<br>
**Vista:** Contiene únicamente la parte visual (HTML y Bootstrap).<br>
**Controlador:** Actúa como intermediario, gestionando la lógica de flujo entre modelo y vista.<br>


El archivo **index.php** funciona como Front Controller. Recibe todas las peticiones y las
redirige al controlador y acción correspondientes mediante parámetros GET. Esta estructura
evita mezclar la lógica de negocio con la presentación, lo que mejora la mantenibilidad y
facilita futuras ampliaciones del sistema.

## Gestión de Rutas:

Se configuró **mod_rewrite** mediante **.htaccess** para permitir URLs más limpias con el
formato: controlador/acción Internamente, estas rutas se transforman en:
index.php?controller=...&action=...<br>
Se simplificó la expresión regular para capturar solo dos segmentos separados por barra,
eliminando configuraciones innecesarias como RewriteBase, ya que el proyecto corre en la
raíz del servidor. Esta simplificación mejora la claridad del sistema de rutas.

## Backend y Base de Datos:

El **backend** se desarrolló en **PHP** y la base de datos en **MySQL**.
Se utilizó **PDO** para la conexión, lo que permite trabajar con sentencias preparadas y
aumenta la seguridad frente a inyecciones SQL. Todas las consultas se realizan mediante
parámetros enlazados.<br>
Se implementaron **bloques try-catch** para controlar excepciones y evitar que errores de
base de datos se muestran directamente al usuario. En caso de fallo, el sistema redirige a
una vista de error controlada.

## Seguridad:

Se aplicaron varias medidas básicas de seguridad:<br>
Las contraseñas no se almacenan en texto plano. Se utiliza **password_hash()** para su
almacenamiento y **password_verify()** para su validación.<br>
Se emplea **htmlspecialchars()** al mostrar datos introducidos por el usuario para prevenir
ataques XSS.<br>
Se implementó un sistema de **control de acceso (ACL) basado en roles** , donde cada
usuario tiene permisos específicos en una estructura centralizada.<br>
Estas decisiones permiten alcanzar un nivel básico de seguridad adecuado para una
aplicación web académica.

## Frontend y Responsive:

Para el diseño responsive, se utilizó **CSS con Bootstrap** , con el objetivo de agilizar el
desarrollo y asegurar compatibilidad en dispositivos móviles sin crear estilos personalizados
complejos.<br>
Se añadió **JavaScript** básico para mejorar la experiencia de usuario en ciertas
interacciones, evitando depender exclusivamente de recargas de página completas.

## Organización y Reutilización de Código:

Se separaron **componentes comunes** como header y footer en una **carpeta /shared**. Esto
evita duplicación de código y facilita modificaciones globales en la estructura o navegación.
Esta decisión mejora la escalabilidad y sigue el principio DRY (Don’t Repeat Yourself).

## Estrategia PWA :

Se planteó la posibilidad de convertir el proyecto en una **Progressive Web App (PWA)** para
ofrecer una experiencia más cercana a una aplicación móvil sin desarrollar una app nativa
desde cero. El objetivo es reutilizar la base desarrollada en PHP y complementar la
experiencia con tecnologías móviles cuando sea necesario, optimizando así el tiempo de
desarrollo.

## Entorno de Desarrollo y Despliegue:

El proyecto se desarrolló en una **máquina virtual Linux (Isard)** , lo que permitió trabajar en
un entorno similar a producción, gestionando permisos y configuración real de **Apache**.
Además, se utilizó **Docker** para asegurar portabilidad y facilitar la ejecución del proyecto en
distintos entornos.

## Entorno y Entrega:

El desarrollo se realizó en **Linux (VM Isard)** para trabajar con permisos y **Apache** de forma
similar a un entorno real. La entrega se prepara para ser “clonar e importar”:<br><br>
● Repositorio en GitHub con toda la estructura MVC y assets.<br>
● Dump .sql con estructura/datos de prueba.<br>
● Archivo de conexión configurable para adaptar credenciales según entorno.<br>

