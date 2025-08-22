# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is the Pegasus WordPress theme, a Bootstrap-based theme developed by Visionquest Development for custom WordPress sites. The theme is designed for integration with CMB2 for custom fields, multiple header layouts, WooCommerce support, and the Pegasus plugins suite.

## Core Commands

### Development Workflow
- `npm install` - Install development dependencies
- `gulp` or `gulp build` - Build CSS and JavaScript assets (default task)
- `gulp watch` - Watch files and rebuild on changes
- `gulp compileSCSS` - Compile SCSS to CSS with Bootstrap integration
- `gulp minifyJS` - Process and concatenate JavaScript files

### Asset Building
The theme uses Gulp for asset compilation:
- **SCSS compilation**: `./scss/main.scss` → `./dist/css/main.css`
- **JavaScript processing**: `./js/pegasus-custom.js` → `./dist/js/main.js`
- **Source maps**: Generated for both CSS and JS in development
- **PostCSS processing**: Autoprefixer and cssnano for CSS optimization

## Architecture

### Theme Structure
- **Core files**: Standard WordPress theme files (functions.php, style.css, header.php, footer.php)
- **Templates**: Modular header templates in `templates/` directory (header_one.php through header_five.php)
- **Custom page templates**: `tpl_*.php` files for specialized layouts
- **Theme configuration**: `theme/` directory contains configuration modules
- **Assets**: `scss/` for stylesheets, `js/` for JavaScript, `dist/` for compiled assets

### Bootstrap Integration
- **Bootstrap 5.3.3**: Latest version included in `inc/bootstrap/`
- **SCSS compilation**: Main entry point at `scss/main.scss` imports Bootstrap and custom styles
- **Custom variables**: Override Bootstrap defaults in SCSS files
- **Component support**: Full Bootstrap component library available

### CMB2 Integration
- **Custom fields**: CMB2 library included in `inc/cmb2/` for meta boxes and options pages
- **Theme options**: Custom theme options page powered by CMB2
- **Plugin requirements**: TGMPA (Theme Plugin Manager) handles required plugin recommendations

### Header System
The theme supports multiple header layouts:
- **Five header variations**: `templates/header_one.php` through `templates/header_five.php`
- **Modular components**: Top bar, sticky header, search, cart, social icons
- **JavaScript controllers**: Dedicated JS files for header types (header_three.js, header_four.js, header_five.js)

### Plugin Ecosystem
- **Pegasus Suite**: Integration with multiple Pegasus plugins (blog, carousel, lightbox, etc.)
- **Plugin menu**: `theme/pegasus_plugins_suite_admin_menu.php` manages plugin documentation
- **WooCommerce**: Built-in support with dedicated templates

### File Organization
- **inc/**: Third-party libraries (Bootstrap, CMB2, Font Awesome, theme options)
- **templates/**: Reusable template parts for headers and components
- **theme/**: Theme-specific configuration (CPT, page options, Bootstrap config)
- **admin/**: Admin-specific CSS and JavaScript
- **images/**: Theme images and assets
- **css/**: Legacy CSS files for specific header styles

## Development Notes

### SCSS Development
- **Main entry**: Always edit `scss/main.scss` and related SCSS files
- **Bootstrap customization**: Override variables before importing Bootstrap
- **Header styles**: `scss/header.scss` contains header-specific styles
- **Build requirement**: Run `gulp` after SCSS changes to compile to `dist/css/`

### JavaScript Development
- **Main file**: `js/pegasus-custom.js` is the primary custom JavaScript file
- **Specialized scripts**: Header-specific JS files for advanced functionality
- **External libraries**: jQuery, Parallax, animation libraries included
- **Build process**: JavaScript is concatenated and can be minified via Gulp

### WordPress Integration
- **Functions.php**: Loads CMB2, theme options, plugin requirements, and Bootstrap support
- **Template hierarchy**: Uses WordPress standards with custom page templates
- **Custom post types**: Defined in `theme/cpt.php`
- **Page options**: Meta box configurations in `theme/page_options.php`

### Asset Management
- **Compiled assets**: Always work in `scss/` and `js/`, never edit `dist/` directly
- **Source maps**: Available for debugging compiled assets
- **Version control**: Include source files, exclude compiled assets from git if possible