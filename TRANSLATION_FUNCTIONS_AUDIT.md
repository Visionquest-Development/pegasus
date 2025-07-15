# Pegasus Theme Translation Functions Audit

## Overview
This document provides a comprehensive audit of all WordPress translation functions used in the Pegasus theme. This audit was conducted to identify potential early text domain loading issues that could cause the "Translation loading for the pegasus domain was triggered too early" error in WordPress 6.7+.

## Executive Summary
- **Total Files Scanned**: All PHP files in the theme directory
- **Translation Functions Found**: 400+ instances
- **Text Domain Used**: 'pegasus' (consistently used throughout)
- **Primary Issue**: Translation functions being called before `init` action
- **Root Cause**: wp-bootstrap-hooks plugin calling translation functions without text domain, defaulting to theme domain

## Translation Function Usage by File

### Core Template Files

#### /searchform.php
- **Line 23**: `_x('Search for:', 'label', 'pegasus')` - ✅ Has text domain
- **Line 31**: `esc_attr_x('Search for:', 'label', 'pegasus')` - ✅ Has text domain  
- **Line 32**: `esc_attr_x('Search …', 'placeholder', 'pegasus')` - ✅ Has text domain

#### /page.php
- **Line 107**: `__('Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus')` - ✅ Has text domain
- **Line 116**: `__('Previous page', 'pegasus')` - ✅ Has text domain
- **Line 117**: `__('Next page', 'pegasus')` - ✅ Has text domain
- **Line 118**: `__('Page', 'pegasus')` - ✅ Has text domain

#### /tpl_page-full-width.php
- **Line 96**: `__('Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus')` - ✅ Has text domain
- **Line 105**: `__('Previous page', 'pegasus')` - ✅ Has text domain
- **Line 106**: `__('Next page', 'pegasus')` - ✅ Has text domain
- **Line 107**: `__('Page', 'pegasus')` - ✅ Has text domain

#### /single.php
- **Line 109**: `__('Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus')` - ✅ Has text domain
- **Line 122**: `__('Previous Post', 'pegasus')` - ✅ Has text domain
- **Line 123**: `__('Next Post', 'pegasus')` - ✅ Has text domain

#### /index.php
- **Line 175**: `__('Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus')` - ✅ Has text domain
- **Line 184**: `__('Previous page', 'pegasus')` - ✅ Has text domain
- **Line 185**: `__('Next page', 'pegasus')` - ✅ Has text domain
- **Line 186**: `__('Page', 'pegasus')` - ✅ Has text domain

#### /search.php
- **Line 127**: `_e("<h2 style='font-weight:bold;color:#000'>Search Results for: " . get_query_var('s') . "</h2>", 'pegasus')` - ✅ Has text domain
- **Line 154**: `esc_html_e('Sorry, no posts matched your criteria.', 'pegasus')` - ✅ Has text domain

### Theme Configuration Files

#### /theme/page_options.php
**Contains 50+ translation function calls - all have 'pegasus' text domain**

Key examples:
- **Line 33**: `__('Pegasus Page Options', 'pegasus')` - ✅ Has text domain
- **Line 38**: `__('Fullwidth Container Checkbox', 'pegasus')` - ✅ Has text domain
- **Line 45**: `__('Disable Page Header', 'pegasus')` - ✅ Has text domain

#### /theme/bootstrap_config.php
- **Line 10**: `__('Search', 'pegasus')` - ✅ Has text domain
- **Line 23**: `__('Comment', 'pegasus')` - ✅ Has text domain
- **Line 66**: `__('Close', 'pegasus')` - ✅ Has text domain

#### /theme/cpt.php
**Contains 100+ translation function calls - all have 'pegasus' text domain**

Key examples:
- **Line 15**: `_x('Portfolios', 'post type general name', 'pegasus')` - ✅ Has text domain
- **Line 18**: `__('Add New Portfolio', 'pegasus')` - ✅ Has text domain
- **Line 292**: `__('Shortcode', 'pegasus')` - ✅ Has text domain

### Functions.php
**Contains 100+ translation function calls - all have 'pegasus' text domain**

Key examples:
- **Line 247**: `__('Primary Menu', 'pegasus')` - ✅ Has text domain
- **Line 352**: `__('Mega Menu Column One', 'pegasus')` - ✅ Has text domain
- **Line 900**: `__('Clear', 'pegasus')` - ✅ Has text domain

### Header Template Files

#### /templates/header_cart.php
- **Line 35**: `__('View your shopping cart')` - ⚠️ **MISSING TEXT DOMAIN**
- **Line 73**: `_e('My Account')` - ⚠️ **MISSING TEXT DOMAIN**
- **Line 79**: `_e('Login / Register')` - ⚠️ **MISSING TEXT DOMAIN**

#### /templates/header_five.php
- **Line 138**: `__('Social Icons', 'pegasus')` - ✅ Has text domain

### Template Parts

#### /templates/content_item.php
- **Line 79**: `__('Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus')` - ✅ Has text domain

#### /templates/footer_one.php
- **Line 38**: `__('Proudly powered by %s', 'pegasus')` - ✅ Has text domain

### Additional Files

#### /inc/theme-options.php
**Contains 200+ translation function calls - all have 'pegasus' text domain**

#### /blog.php
- **Line 64**: `__('Previous page', 'pegasus')` - ✅ Has text domain

#### /archive.php
- **Line 92**: `__('Previous page', 'pegasus')` - ✅ Has text domain

#### /category.php
- **Line 71**: `__('Previous page', 'pegasus')` - ✅ Has text domain

## Issues Identified

### 1. Missing Text Domains
The following files contain translation functions WITHOUT text domains:

#### /templates/header_cart.php
- **Line 35**: `__('View your shopping cart')` - Should be `__('View your shopping cart', 'pegasus')`
- **Line 73**: `_e('My Account')` - Should be `_e('My Account', 'pegasus')`
- **Line 79**: `_e('Login / Register')` - Should be `_e('Login / Register', 'pegasus')`

**Impact**: These functions default to the theme's text domain but may load before `init` action.

### 2. Early Loading Context
Translation functions are being called in templates that load early in the WordPress lifecycle, including:
- Header templates (loaded in `wp_head`)
- Search form (loaded early for accessibility)
- Navigation menus (loaded before `init`)

### 3. External Plugin Impact
**PRIMARY ISSUE**: The wp-bootstrap-hooks plugin contains translation functions without text domains, causing WordPress to default to the active theme's text domain ('pegasus'), triggering early loading.

## Recommendations

### Immediate Fixes

1. **Fix missing text domains in header_cart.php**:
   ```php
   // Line 35
   $woo_url_title = __('View your shopping cart', 'pegasus');
   
   // Line 73
   _e('My Account', 'pegasus');
   
   // Line 79
   _e('Login / Register', 'pegasus');
   ```

2. **Fix wp-bootstrap-hooks plugin** (external plugin):
   - Add proper text domain to all translation functions
   - Load plugin text domain on `init` hook

### Long-term Solutions

1. **Implement delayed loading checks**:
   ```php
   // Add to templates that may load early
   if (!did_action('init')) {
       return;
   }
   ```

2. **Centralize text domain loading**:
   ```php
   // Load text domain safely on init
   add_action('init', function() {
       load_theme_textdomain('pegasus', get_template_directory() . '/languages');
   }, PHP_INT_MIN);
   ```

3. **Create translation wrapper functions**:
   ```php
   function pegasus_translate($text, $context = null) {
       if (!did_action('init')) {
           return $text; // Return untranslated text if too early
       }
       return $context ? _x($text, $context, 'pegasus') : __($text, 'pegasus');
   }
   ```

## Conclusion

The Pegasus theme has good translation function usage with consistent text domain implementation. The primary issue causing early text domain loading is the wp-bootstrap-hooks plugin, which needs to be fixed to prevent defaulting to the theme's text domain. The few missing text domains in the theme should be fixed as a secondary measure.

## Files Requiring Attention

1. **wp-bootstrap-hooks plugin** - Primary issue
2. **templates/header_cart.php** - Missing text domains
3. **Any templates loaded before `init`** - May need delayed loading checks

---

*Generated on: 2025-01-14*
*WordPress Version: 6.7.0*
*Theme: Pegasus*