# Estructura de Paquetes del CMS Fract2

## Tabla de Contenidos
1. [Visión General](#visión-general)
2. [Estructura de Paquetes](#estructura-de-paquetes)
3. [Paquetes Principales](#paquetes-principales)
4. [Paquetes Personalizados](#paquetes-personalizados)
5. [Gestión de Paquetes](#gestión-de-paquetes)
6. [Dependencias](#dependencias)
7. [Mejores Prácticas](#mejores-prácticas)
8. [Desarrollo de Paquetes](#desarrollo-de-paquetes)
9. [Distribución de Paquetes](#distribución-de-paquetes)

## Visión General

El sistema de paquetes es un componente central de la arquitectura del CMS Fract2. Permite una estructura modular y extensible que permite a los desarrolladores añadir nuevas funcionalidades o modificar las existentes sin alterar el núcleo del sistema. Este documento describe la estructura y gestión de paquetes en el CMS Fract2.

## Estructura de Paquetes

Un paquete típico de Fract2 tiene la siguiente estructura:

```
nombre-del-paquete/
├── config/
│   └── config.yaml
├── src/
│   ├── Functions/
│   ├── Handlers/
│   └── Services/
├── templates/
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── migrations/
├── tests/
└── package.yaml
```

- `config/`: Contiene configuraciones específicas del paquete
- `src/`: Contiene el código fuente PHP del paquete
  - `Functions/`: Contiene componentes funcionales
  - `Handlers/`: Contiene manejadores de solicitudes
  - `Services/`: Contiene servicios y funciones auxiliares
- `templates/`: Plantillas TWIG para la salida
- `assets/`: Recursos estáticos como CSS, JavaScript e imágenes
- `migrations/`: Migraciones de base de datos para el paquete
- `tests/`: Pruebas unitarias y de integración
- `package.yaml`: Metadatos y configuración del paquete

## Paquetes Principales

El CMS Fract2 incluye los siguientes paquetes principales:

1. **f2.core**: Funcionalidades básicas del CMS
2. **f2.users**: Gestión de usuarios y autenticación
3. **f2.content**: Gestión y administración de contenido
4. **f2.media**: Gestión de medios
5. **f2.seo**: Optimizaciones y herramientas SEO

Estos paquetes principales proporcionan la funcionalidad fundamental del CMS y sirven como ejemplos para el desarrollo de paquetes personalizados.

## Paquetes Personalizados

Los desarrolladores pueden crear sus propios paquetes para extender la funcionalidad de Fract2. Un paquete personalizado debe:

1. Seguir la estructura descrita anteriormente
2. Utilizar un prefijo de espacio de nombres único
3. Contener documentación clara y comentarios
4. Proporcionar pruebas unitarias para las funcionalidades críticas

## Gestión de Paquetes

El CMS Fract2 utiliza su propio sistema de gestión de paquetes:

- Instalación: `php fract2 package:install nombre-del-paquete`
- Actualización: `php fract2 package:update nombre-del-paquete`
- Eliminación: `php fract2 package:remove nombre-del-paquete`
- Activación/Desactivación: `php fract2 package:toggle nombre-del-paquete`

Estos comandos interactúan con el sistema de paquetes para gestionar el ciclo de vida de los paquetes dentro del CMS.

## Dependencias

Las dependencias de los paquetes se definen en el archivo `package.yaml`:

```yaml
name: mi-paquete
version: 1.0.0
dependencies:
  - f2.core: "^2.0"
  - f2.users: "^1.5"
```

El sistema de gestión de paquetes resuelve automáticamente las dependencias y asegura que todos los paquetes requeridos estén instalados.

## Mejores Prácticas

1. Mantenga los paquetes lo más pequeños y enfocados posible
2. Utilice programación funcional cuando tenga sentido
3. Siga los estándares de codificación de Fract2
4. Documente las APIs públicas exhaustivamente
5. Escriba pruebas completas para sus paquetes
6. Utilice versionado semántico para sus paquetes
7. Evite el acoplamiento estrecho entre paquetes
8. Utilice inyección de dependencias para una mejor modularidad

## Desarrollo de Paquetes

Al desarrollar un nuevo paquete:

1. Utilice el comando de creación de paquetes: `php fract2 package:create nombre-del-paquete`
2. Implemente las interfaces y hooks requeridos
3. Utilice la API de Fract2 para interactuar con las funcionalidades principales
4. Siga las convenciones de nomenclatura para funciones, manejadores y servicios
5. Utilice el contenedor de inyección de dependencias incorporado
6. Aproveche los paquetes principales existentes en lugar de reinventar la funcionalidad

## Distribución de Paquetes

Para distribuir su paquete:

1. Asegúrese de que todas las pruebas pasen y el paquete esté bien documentado
2. Cree un archivo `README.md` con instrucciones de instalación y uso
3. Utilice el comando de construcción de paquetes: `php fract2 package:build nombre-del-paquete`
4. Publique su paquete en el repositorio de paquetes de Fract2 o en su propio canal de distribución

Recuerde que los paquetes distribuidos deben ser autónomos y no depender de recursos externos que pueden no estar disponibles en el sistema del usuario final.

Siguiendo estas pautas, puede crear paquetes robustos y mantenibles que extiendan la funcionalidad del CMS Fract2 mientras se adhieren a sus principios de simplicidad y eficiencia.