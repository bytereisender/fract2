# Proceso de Instalación del CMS Fract2

## Tabla de Contenidos
1. [Visión General](#visión-general)
2. [Requisitos del Sistema](#requisitos-del-sistema)
3. [Pasos Previos a la Instalación](#pasos-previos-a-la-instalación)
4. [Pasos de Instalación](#pasos-de-instalación)
5. [Configuración Post-Instalación](#configuración-post-instalación)
6. [Solución de Problemas](#solución-de-problemas)
7. [Actualización del CMS Fract2](#actualización-del-cms-fract2)

## Visión General

El proceso de instalación del CMS Fract2 está diseñado para ser sencillo y fácil de usar. Este documento le guiará a través de los pasos necesarios para poner en marcha su CMS Fract2.

## Requisitos del Sistema

Antes de comenzar la instalación, asegúrese de que su sistema cumple con los siguientes requisitos:

- PHP 7.4 o superior
- PostgreSQL 12+ o MariaDB 10.3+
- Apache 2.4+ o Nginx 1.18+
- Mínimo 64MB de RAM asignada a PHP
- 100MB de espacio libre en disco
- Composer (opcional, pero recomendado)
- Git (opcional)

## Pasos Previos a la Instalación

1. Descargue el paquete de instalación del CMS Fract2 desde el sitio web oficial o repositorio.
2. Extraiga el contenido del paquete en el directorio de instalación deseado.
3. Asegúrese de que su servidor web tiene permisos de escritura en el directorio de instalación.

## Pasos de Instalación

1. Abra una terminal y navegue hasta el directorio que contiene los archivos de instalación de Fract2.

2. Ejecute el script de instalación:
   ```
   ./fract2-setup.sh
   ```

3. El script realizará las siguientes acciones:
   - Detectar su sistema operativo
   - Extraer archivos de `distribution.tar` en un nuevo directorio `fract2`
   - Mostrar el progreso con salida coloreada

4. Siga las indicaciones en pantalla. Se le pedirá:
   - Elegir el sistema de base de datos (PostgreSQL o MariaDB)
   - Proporcionar detalles de conexión a la base de datos
   - Configurar el usuario administrador

5. Si Composer está disponible en su sistema, el script instalará automáticamente las dependencias. Si no, recibirá instrucciones para la instalación manual.

6. El script ofrecerá inicializar un repositorio Git para su instalación de Fract2. Puede elegir si desea hacer esto o no.

## Configuración Post-Instalación

Después de completar la instalación:

1. Navegue hasta el directorio `fract2` recién creado.
2. Abra el archivo `config/config.yaml` y ajuste la configuración según sea necesario.
3. Configure su servidor web para que apunte al directorio de instalación de Fract2.
4. Establezca los permisos apropiados para directorios y archivos:
   ```
   chmod 755 /ruta/a/fract2
   chmod 750 /ruta/a/fract2/config
   chmod 644 /ruta/a/fract2/index.php
   ```

5. Acceda a su CMS Fract2 a través de un navegador web y complete cualquier paso adicional de configuración que se le solicite.

## Solución de Problemas

Si encuentra problemas durante la instalación:

- **Problemas de Extracción**: Asegúrese de tener permisos de escritura en el directorio de destino.
- **Errores de Composer**: Verifique su instalación de Composer e intente ejecutar `composer install` manualmente en el directorio de Fract2.
- **Errores de Inicialización de Git**: Asegúrese de que Git esté correctamente instalado y tenga los permisos necesarios.
- **Problemas de Conexión a la Base de Datos**: Verifique sus credenciales de base de datos y asegúrese de que el servidor de base de datos esté en funcionamiento.
- **Errores de Permisos**: Verifique los permisos de archivos y directorios, y el propietario del proceso del servidor web.

Para problemas persistentes, consulte la documentación detallada o comuníquese con la comunidad de soporte.

## Actualización del CMS Fract2

Para actualizar su instalación del CMS Fract2:

1. Haga una copia de seguridad de su instalación actual de Fract2 y de la base de datos.
2. Descargue el último paquete de actualización de Fract2.
3. Ejecute el script de actualización:
   ```
   ./fract2-update.sh
   ```
4. Siga las instrucciones en pantalla para completar el proceso de actualización.

Siempre consulte la documentación de actualización específica de la versión para conocer pasos o consideraciones adicionales.

Recuerde probar el proceso de actualización en un entorno de pruebas antes de aplicarlo a su sitio de producción.

Siguiendo estos pasos, debería tener una instalación funcional del CMS Fract2. Para obtener información más detallada sobre el uso y la configuración de Fract2, consulte el manual de usuario y la guía de administración.