# Fract2 CMS Installation Process

## Table of Contents
1. [Overview](#overview)
2. [System Requirements](#system-requirements)
3. [Pre-Installation Steps](#pre-installation-steps)
4. [Installation Steps](#installation-steps)
5. [Post-Installation Configuration](#post-installation-configuration)
6. [Troubleshooting](#troubleshooting)
7. [Updating Fract2 CMS](#updating-fract2-cms)

## Overview

The installation process of Fract2 CMS is designed to be straightforward and user-friendly. This document will guide you through the steps necessary to get your Fract2 CMS up and running.

## System Requirements

Before beginning the installation, ensure your system meets the following requirements:

- PHP 7.4 or higher
- PostgreSQL 12+ or MariaDB 10.3+
- Apache 2.4+ or Nginx 1.18+
- Minimum 64MB of RAM allocated to PHP
- 100MB of free disk space
- Composer (optional, but recommended)
- Git (optional)

## Pre-Installation Steps

1. Download the Fract2 CMS installation package from the official website or repository.
2. Extract the contents of the package to your desired installation directory.
3. Ensure that your web server has write permissions to the installation directory.

## Installation Steps

1. Open a terminal and navigate to the directory containing the Fract2 installation files.

2. Run the installation script:
   ```
   ./fract2-setup.sh
   ```

3. The script will perform the following actions:
   - Detect your operating system
   - Extract files from `distribution.tar` into a new `fract2` directory
   - Display progress with colored output

4. Follow the on-screen prompts. You will be asked to:
   - Choose the database system (PostgreSQL or MariaDB)
   - Provide database connection details
   - Set up the admin user

5. If Composer is available on your system, the script will automatically install dependencies. If not, you'll receive instructions for manual installation.

6. The script will offer to initialize a Git repository for your Fract2 installation. You can choose whether to do this or not.

## Post-Installation Configuration

After the installation is complete:

1. Navigate to the newly created `fract2` directory.
2. Open the `config/config.yaml` file and adjust settings as needed.
3. Configure your web server to point to the Fract2 installation directory.
4. Set appropriate permissions for directories and files:
   ```
   chmod 755 /path/to/fract2
   chmod 750 /path/to/fract2/config
   chmod 644 /path/to/fract2/index.php
   ```

5. Access your Fract2 CMS through a web browser and complete any additional setup steps as prompted.

## Troubleshooting

If you encounter issues during installation:

- **Extraction Problems**: Ensure you have write permissions in the target directory.
- **Composer Errors**: Check your Composer installation and try running `composer install` manually in the Fract2 directory.
- **Git Initialization Errors**: Make sure Git is correctly installed and you have the necessary permissions.
- **Database Connection Issues**: Verify your database credentials and ensure the database server is running.
- **Permission Errors**: Check file and directory permissions, and the web server process owner.

For persistent issues, consult the detailed documentation or reach out to the support community.

## Updating Fract2 CMS

To update your Fract2 CMS installation:

1. Back up your current Fract2 installation and database.
2. Download the latest Fract2 update package.
3. Run the update script:
   ```
   ./fract2-update.sh
   ```
4. Follow the on-screen instructions to complete the update process.

Always refer to the version-specific upgrade documentation for any additional steps or considerations.

Remember to test the update process in a staging environment before applying it to your production site.

By following these steps, you should have a functioning Fract2 CMS installation. For more detailed information about using and configuring Fract2, please refer to the user manual and administration guide.