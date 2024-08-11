# Fract2 CMS Package Structure

## Table of Contents
1. [Overview](#overview)
2. [Package Structure](#package-structure)
3. [Core Packages](#core-packages)
4. [Custom Packages](#custom-packages)
5. [Package Management](#package-management)
6. [Dependencies](#dependencies)
7. [Best Practices](#best-practices)
8. [Package Development](#package-development)
9. [Package Distribution](#package-distribution)

## Overview

The package system is a central component of the Fract2 CMS architecture. It enables a modular and extensible structure that allows developers to add new features or modify existing ones without altering the core of the system. This document outlines the structure and management of packages in Fract2 CMS.

## Package Structure

A typical Fract2 package has the following structure:

```
package-name/
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

- `config/`: Contains package-specific configurations
- `src/`: Contains the PHP source code of the package
  - `Functions/`: Contains functional components
  - `Handlers/`: Contains request handlers
  - `Services/`: Contains services and helper functions
- `templates/`: TWIG templates for output
- `assets/`: Static resources such as CSS, JavaScript, and images
- `migrations/`: Database migrations for the package
- `tests/`: Unit and integration tests
- `package.yaml`: Metadata and configuration of the package

## Core Packages

Fract2 CMS includes the following core packages:

1. **f2.core**: Basic CMS functionalities
2. **f2.users**: User management and authentication
3. **f2.content**: Content management and administration
4. **f2.media**: Media management
5. **f2.seo**: SEO optimizations and tools

These core packages provide the fundamental functionality of the CMS and serve as examples for custom package development.

## Custom Packages

Developers can create their own packages to extend the functionality of Fract2. A custom package should:

1. Follow the structure outlined above
2. Use a unique namespace prefix
3. Contain clear documentation and comments
4. Provide unit tests for critical functionalities

## Package Management

Fract2 CMS uses its own package management system:

- Installation: `php fract2 package:install package-name`
- Update: `php fract2 package:update package-name`
- Removal: `php fract2 package:remove package-name`
- Activation/Deactivation: `php fract2 package:toggle package-name`

These commands interact with the package system to manage the lifecycle of packages within the CMS.

## Dependencies

Package dependencies are defined in the `package.yaml` file:

```yaml
name: my-package
version: 1.0.0
dependencies:
  - f2.core: "^2.0"
  - f2.users: "^1.5"
```

The package management system automatically resolves dependencies and ensures that all required packages are installed.

## Best Practices

1. Keep packages as small and focused as possible
2. Use functional programming where it makes sense
3. Follow the Fract2 coding standards
4. Document public APIs thoroughly
5. Write comprehensive tests for your packages
6. Use semantic versioning for your packages
7. Avoid tight coupling between packages
8. Use dependency injection for better modularity

## Package Development

When developing a new package:

1. Use the package creation command: `php fract2 package:create package-name`
2. Implement the required interfaces and hooks
3. Use the Fract2 API for interacting with core functionalities
4. Follow the naming conventions for functions, handlers, and services
5. Utilize the built-in dependency injection container
6. Leverage existing core packages rather than reinventing functionality

## Package Distribution

To distribute your package:

1. Ensure all tests pass and the package is well-documented
2. Create a `README.md` file with installation and usage instructions
3. Use the package build command: `php fract2 package:build package-name`
4. Publish your package to the Fract2 package repository or your own distribution channel

Remember that distributed packages should be self-contained and not rely on external resources that may not be available on the end user's system.

By following these guidelines, you can create robust and maintainable packages that extend the functionality of Fract2 CMS while adhering to its principles of simplicity and efficiency.