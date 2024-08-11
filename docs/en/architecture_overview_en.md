# Fract2 CMS Architecture Overview

## Table of Contents
1. [Introduction](#introduction)
2. [Core Principles](#core-principles)
3. [System Architecture](#system-architecture)
4. [Main Components](#main-components)
5. [Data Flow](#data-flow)
6. [Extensibility](#extensibility)
7. [Security Architecture](#security-architecture)
8. [Performance Considerations](#performance-considerations)
9. [Future Plans](#future-plans)

## Introduction

Fract2 is a modular Content Management System (CMS) built on the principles of simplicity, efficiency, and extensibility. This architecture overview provides a comprehensive insight into the structure and functionality of the system.

## Core Principles

1. **No Frameworks - Pure Vanilla Code**: Fract2 avoids heavy frameworks to maintain full control over the code and optimize performance.

2. **No MVC for Maximum Code Simplicity**: Instead of the traditional MVC pattern, Fract2 uses a more direct approach to reduce complexity.

3. **Modular and Robust Data Structure**: The system is divided into independent modules that can be easily added or removed.

4. **Clean Code Separation**: HTML, CSS, JavaScript, and PHP are clearly separated to improve maintainability.

5. **TWIG for Secure Templating**: The use of TWIG increases the security and efficiency of the templating process.

6. **Readable Code Structure**: The code uses descriptive names and is self-explanatory in its structure.

7. **Efficient Resource Utilization**: The system is designed to optimally use server resources.

8. **Linux and Unix Compatibility**: Fract2 is fully compatible with common Linux and Unix systems.

## System Architecture

The architecture of Fract2 can be divided into three main layers:

1. **Core (Core)**: Contains the basic functions and classes of the CMS.
2. **Modules (Packages)**: Extensible functional units that provide specific functionalities.
3. **Presentation**: Includes templates and assets for content presentation.

```
[Core] <-> [Modules] <-> [Presentation]
```

## Main Components

1. **Bootstrapper**: Initializes the system and loads the necessary components.
2. **Router**: Processes incoming requests and forwards them to the appropriate handlers.
3. **Database Abstraction**: Provides a unified interface for different database systems.
4. **Templating Engine (TWIG)**: Renders the output based on predefined templates.
5. **Package Manager**: Manages the installation, updating, and removal of modules.
6. **Configuration Manager**: Handles system-wide and module-specific settings.
7. **Caching System**: Optimizes performance through intelligent caching of data and outputs.
8. **Logging System**: Logs system events and errors for debugging and monitoring.

## Data Flow

1. A request reaches the web server and is forwarded to Fract2.
2. The Bootstrapper initializes the system and loads the configuration.
3. The Router analyzes the URL and determines the responsible handler.
4. The handler processes the request, interacts with the database, and prepares the data.
5. The Templating Engine renders the output based on the prepared data.
6. The finished output is sent back to the user.

## Extensibility

Fract2 supports extensibility through:

1. **Modular Package System**: New features can be added as separate packages.
2. **Hook System**: Allows intervention at various points in the processing process.
3. **Event System**: Allows reaction to specific system events.
4. **Templating Overrides**: Templates can be overridden at various levels.

## Security Architecture

1. **Input Validation**: Strict checking and sanitization of all user inputs.
2. **Prepared Statements**: Use of prepared SQL statements to prevent SQL injection.
3. **CSRF Protection**: Implementation of token-based protection against Cross-Site Request Forgery.
4. **XSS Prevention**: Automatic escaping of outputs through the templating engine.
5. **Secure Configuration**: Sensitive configuration data is stored outside the webroot.
6. **Filesystem Isolation**: Strict control of access to the filesystem.

## Performance Considerations

1. **Efficient Database Design**: Optimized database structures and queries.
2. **Multi-level Caching**: Implementation of object, query, and full-page caching.
3. **Lazy Loading**: Resources are only loaded when needed.
4. **Asynchronous Processing**: Time-intensive tasks are moved to the background.
5. **Compression**: Automatic compression of outputs and assets.
6. **CDN Support**: Easy integration of Content Delivery Networks.

## Future Plans

1. **API Extension**: Development of a comprehensive RESTful API for external integrations.
2. **Improved Media Management**: Implementation of advanced image editing and video processing functions.
3. **Enhanced Multilingualism**: Improvement of support for multilingual content and localization.
4. **AI Integration**: Introduction of AI-supported functions for content analysis and creation.
5. **Improved Search Functionality**: Implementation of a more powerful, faceted search function.
6. **Progressive Web App (PWA) Support**: Extension of the system for easy creation of PWAs.

This architecture overview provides a comprehensive insight into the structure and functionality of Fract2 CMS. It serves as a starting point for developers who want to understand, extend, or customize the system.