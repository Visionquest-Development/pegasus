# PEGASUS - WordPress Bootstrap Theme

## Overview

Pegasus is a free, open-source WordPress theme built with **Bootstrap 5**, **CMB2** for custom fields, and comprehensive **JavaScript libraries**. Developed by [Visionquest Development](http://visionquestdevelopment.com), this theme serves as a robust foundation for building custom WordPress websites.

**Key Features:**
- Built on Bootstrap 5.3.3 framework
- CMB2-powered theme options and custom fields
- WooCommerce ready
- Multiple header layouts (5 variations)
- Modular plugin architecture
- Responsive design with mobile-first approach
- Extensive customization options via theme options panel

**Official Website:** [https://pegasustheme.com](https://pegasustheme.com)

## What is this repository for?

* This is a WordPress theme based on **Bootstrap 5** for frontend markup, **CMB2** for custom fields and theme options, and **WooCommerce** for e-commerce functionality
* Designed as a flexible base theme for developers to build custom client websites
* Part of the Pegasus Plugin Suite ecosystem - see [Plugin Suite](#plugin-suite) section
* Version: 3.8 (Lead-up to v4.0)

## Installation

### Method 1: WordPress Admin Upload
1. Click the "Clone or download" button and select "Download ZIP"
2. **IMPORTANT:** Rename the extracted folder from `pegasus-master` to `pegasus`
3. In WordPress admin: Appearance → Themes → Add New → Upload Theme
4. Choose the renamed `pegasus` folder and upload
5. Activate the theme

### Method 2: Git Clone (Recommended for Developers)
```bash
cd path/to/wp-content/themes
git clone https://github.com/Visionquest-Development/pegasus.git pegasus
```

**Important:** Always ensure the theme folder is named exactly `pegasus` (not `pegasus-master`) for proper functionality.

## Development Setup

### Prerequisites
- Node.js and npm
- WordPress development environment

### Build Process
```bash
# Install dependencies
npm install

# Build assets (default task)
gulp

# Watch for changes during development
gulp watch

# Compile SCSS only
gulp compileSCSS

# Process JavaScript only  
gulp minifyJS
```

### File Structure
```
pegasus/
├── scss/               # SCSS source files
├── js/                 # JavaScript source files
├── dist/               # Compiled assets (auto-generated)
├── templates/          # Header and component templates
├── theme/              # Theme configuration files
├── inc/                # Third-party libraries (Bootstrap, CMB2, etc.)
└── functions.php       # Main theme functions
```

## Theme Architecture

### Header System
Pegasus includes **5 distinct header layouts**:

1. **Header One** - Basic horizontal navigation
2. **Header Two** - Enhanced horizontal with additional features
3. **Header Three** - Overlay/transparent header with scroll effects
4. **Header Four** - Sidebar navigation layout
5. **Header Five** - Mobile-first responsive header

Each header includes:
- Configurable container options (full-width/boxed)
- Logo positioning and centering
- Navigation alignment options
- Mobile hamburger menu
- WooCommerce cart integration
- Social media menu support

### Template System
- **Modular templates:** Located in `templates/` directory
- **Header variations:** `header_one.php` through `header_five.php`
- **Component templates:** `top_bar.php`, `sticky_header.php`, `social_icons.php`, etc.
- **Content templates:** `content_item.php` for post loops
- **Page templates:** Custom page templates prefixed with `tpl_`

### Theme Options (CMB2)
Comprehensive theme customization via **CMB2-powered options panel**:

#### Global Settings
- **Layout Options:** Boxed/full-width containers, sidebar configurations
- **Background Settings:** Colors, images, patterns with positioning controls
- **Typography:** Color schemes and font options

#### Header Configuration  
- **Header Selection:** Choose from 5 header layouts
- **Navigation Options:** Color schemes, positioning, mobile breakpoints
- **Logo Settings:** Upload, positioning, centering options
- **Top Bar:** Enable/disable with content and styling options

#### Additional Header Options (Per Page/Post)
- **Header Types:** No header, spacing only, small parallax, large full-screen
- **Background Images:** Per-page header backgrounds with parallax support
- **Overlay Controls:** Color and opacity settings
- **Parallax Settings:** Enable/disable parallax effects

#### Footer Customization
- **Widget Areas:** Configurable number of footer widget columns
- **Color Schemes:** Background and text color controls
- **Social Integration:** Footer social media widget area

#### Advanced Options
- **Custom CSS:** Built-in custom CSS editor
- **WooCommerce Integration:** Cart display and shop settings
- **Admin Bar:** Show/hide WordPress admin bar
- **Mega Menu:** Multi-column navigation support

### Plugin Suite

Pegasus works with a companion suite of plugins available separately:

#### Core Plugins
- **pegasus-blog** - Enhanced blog layouts and features
- **pegasus-callout** - Call-to-action sections
- **pegasus-carousel** - Image/content carousels  
- **pegasus-circle-progress** - Animated progress circles
- **pegasus-countup** - Animated counters
- **pegasus-lightbox** - Image lightbox galleries
- **pegasus-masonry** - Masonry grid layouts
- **pegasus-onepage** - Single-page navigation
- **pegasus-popup** - Modal/popup functionality
- **pegasus-slider** - Content sliders
- **pegasus-tabs** - Tabbed content sections
- **pegasus-toggleslide** - Accordion/toggle sections
- **pegasus-wow** - Scroll animation effects

#### Recommended WordPress Plugins
The theme includes **TGMPA** (Theme Plugin Manager) integration recommending:
- **Breadcrumb NavXT** - Navigation breadcrumbs
- **Page Builder by SiteOrigin** - Drag-and-drop page building
- **SiteOrigin Widgets Bundle** - Additional page builder widgets
- **Yoast SEO** - Search engine optimization
- **WooCommerce** - E-commerce functionality
- **WP Bootstrap Hooks** - Enhanced Bootstrap integration

## CSS/SCSS Development

### Build System
- **Main SCSS file:** `scss/main.scss`
- **Bootstrap integration:** Imports Bootstrap 5.3.3 from `inc/bootstrap/scss/`
- **Custom variables:** Override Bootstrap defaults in SCSS files
- **Compilation:** Gulp processes SCSS with autoprefixer and minification

### CSS Custom Properties
The theme uses CSS custom properties (CSS variables) for dynamic styling:
```css
:root {
  --pegasus-background-color: /* Body background */
  --pegasus-header-bkg-color: /* Header background */
  --pegasus-nav-item-color: /* Navigation text color */
  --pegasus-footer-bkg-color: /* Footer background */
  /* ...and many more */
}
```

### Responsive Design
- **Mobile-first approach** with Bootstrap 5 breakpoints
- **Configurable breakpoints** for navigation collapse
- **Header-specific responsive styles** in dedicated CSS files

## JavaScript Development

### Core JavaScript
- **Main file:** `js/pegasus-custom.js` (compiled to `dist/js/main.js`)
- **Bootstrap 5 Bundle:** Full Bootstrap JavaScript functionality
- **jQuery support:** Included for compatibility

### Header-Specific Scripts
- `js/header_three.js` - Overlay header scroll effects
- `js/header_four.js` - Sidebar navigation controls  
- `js/header_five.js` - Mobile-responsive features
- `js/parallax.js` - Parallax background effects
- `js/animheader.js` - Large header animations

### External Libraries
- **Font Awesome** - Icon fonts
- **Parallax effects** - Background image animations
- **Animation libraries** - For enhanced user interactions

## Functions.php Overview

The main `functions.php` file handles:

### Core Functionality
- **Theme setup:** Title tag, menus, post thumbnails support
- **Navigation registration:** Primary, social, user, and mega menu support
- **Widget areas:** Configurable sidebar and footer widget areas
- **Script/style enqueuing:** Bootstrap, custom CSS/JS, header-specific assets

### Dynamic Features
- **Mega menu system:** Configurable multi-column navigation
- **WooCommerce integration:** Cart fragments, theme support, custom wrappers
- **Color utility functions:** Hex to RGB/RGBA conversion for dynamic styling
- **Image display functions:** Featured image fallbacks and processing
- **Body class filters:** Dynamic CSS classes based on theme options

### Plugin Integration
- **TGMPA setup:** Required/recommended plugin management
- **CMB2 integration:** Custom fields and theme options
- **Shortcode support:** `[pegasus_settings_table]` for plugin documentation

## Page Templates

### Standard Templates
- `page.php` - Default page template
- `single.php` - Blog post template  
- `archive.php` - Archive pages
- `category.php` - Category archives
- `search.php` - Search results
- `404.php` - Error page

### Custom Page Templates
- `tpl_page-full-width.php` - Full-width page layout
- `tpl_parent_page.php` - Parent page with child navigation
- `tpl_pagination.php` - Custom pagination template

### Special Templates
- `blog.php` - Dedicated blog page template
- `woocommerce.php` - WooCommerce integration template

## Troubleshooting

### Common Issues

#### Folder Naming
**Problem:** Theme not working after download  
**Solution:** Ensure the theme folder is named `pegasus` (not `pegasus-master`)

#### Missing Styles
**Problem:** Styles not loading properly  
**Solution:** Run `gulp` to compile SCSS files, check for `dist/css/main.css`

#### Header Options Not Showing
**Problem:** Header settings not appearing  
**Solution:** Ensure CMB2 plugin is active or included library is loading

#### Plugin Recommendations
**Problem:** Plugin installation notices  
**Solution:** Install recommended plugins via Appearance → Install Plugins

#### WooCommerce Issues
**Problem:** Shop pages not styling correctly  
**Solution:** Enable WooCommerce option in Pegasus Options → WooCommerce Settings

### Development Tips

1. **Always work in source files** (`scss/`, `js/`) never edit compiled files in `dist/`
2. **Use theme options** instead of hardcoding values when possible
3. **Test across header layouts** as each has different styling requirements
4. **Check responsive behavior** especially navigation collapse points
5. **Use browser dev tools** to inspect CSS custom properties for dynamic values

## Contribution Guidelines

### Development Workflow
1. Fork the repository
2. Create a feature branch: `git checkout -b new-feature-name`
3. Make your changes following WordPress coding standards
4. Test across multiple header layouts and responsive breakpoints
5. Update documentation if needed
6. Submit a pull request

### Coding Standards
- Follow WordPress coding standards
- Use proper PHP documentation blocks
- Test CMB2 integrations thoroughly
- Ensure backward compatibility
- Include browser testing for CSS/JS changes

## Support and Resources

### Documentation
- **Official Website:** [https://pegasustheme.com](https://pegasustheme.com)
- **GitHub Repository:** [https://github.com/Visionquest-Development/pegasus](https://github.com/Visionquest-Development/pegasus)
- **Developer Website:** [http://visionquestdevelopment.com](http://visionquestdevelopment.com)

### Contact
- **GitHub Issues:** For bug reports and feature requests
- **Email:** jim.obrien3@gmail.com for direct support
- **Plugin Documentation:** Available in WordPress admin when plugins are installed

### Version Information
- **Current Version:** 3.8 (approaching v4.0)
- **Bootstrap Version:** 5.3.3
- **CMB2 Version:** Latest included
- **WordPress Compatibility:** Tested with latest WordPress versions

---

**License:** GNU General Public License v2 or later  
**Developer:** Jim O'Brien, Visionquest Development 