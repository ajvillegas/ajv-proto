# AJV Proto

A starter theme for creating custom WordPress websites.

**Contributors**: [ajvillegas](http://profiles.wordpress.org/ajvillegas)  
**Tags**: [one-column](http://wordpress.org/themes/tags/one-column), [two-columns](http://wordpress.org/themes/tags/two-columns), [left-sidebar](http://wordpress.org/themes/tags/left-sidebar), [right-sidebar](http://wordpress.org/themes/tags/right-sidebar), [custom-menu](http://wordpress.org/themes/tags/custom-menu), [custom-logo](http://wordpress.org/themes/tags/custom-logo), [editor-style](http://wordpress.org/themes/tags/editor-style), [featured-images](http://wordpress.org/themes/tags/featured-images), [footer-widgets](http://wordpress.org/themes/tags/footer-widgets), [full-width-template](http://wordpress.org/themes/tags/full-width-template), [sticky-post](http://wordpress.org/themes/tags/sticky-post), [threaded-comments](http://wordpress.org/themes/tags/threaded-comments), [translation-ready](http://wordpress.org/themes/tags/translation-ready)  
**Requires at least**: 4.6  
**Tested up to**: 5.7  
**Stable tag**: 1.2.0  
**License**: [GPLv2 or later](http://www.gnu.org/licenses/gpl-2.0.html)

## Description

AJV Proto is a custom WordPress starter theme based on Automattic's [Underscores](https://github.com/Automattic/_s).

It features options for controlling layout globally or individually on each page/post, and a Gulp.js workflow for easy local development.

### Prefixing Your Theme

In order to make the theme your own, you'll have to change all the AJV Proto theme prefixes. Do a find and replace of the following strings (case sensitive). Do NOT match the whole word when doing the search as it will miss some instances:

* AJV Proto -> My Theme Name
* AJV_Proto -> My_Theme_Name
* AJV_PROTO -> MY_THEME_NAME
* ajv_proto -> my_theme_name
* ajv-proto -> my-theme-name

### Gulp.js Workflow

The AJV Proto theme uses the Gulp.js task runner for compiling CSS, generating RTL stylesheets, translation POT files, optimizing images, as well as concatenating, transpiling (Babel) and minifying JS files.

The Gulp.js workflow is based on the Ahmad Awais' [WPGulp](https://github.com/ahmadawais/WPGulp) project and it is extensively documented throughout.

### Working with SCSS

This theme uses SCSS to generate the main CSS stylesheet. All the files are located under the `assets/css/scss` folder. You should only edit the theme's stylesheet file header in the `assets/css/scss/styles.scss` file to avoid overriding the comment block when CSS is compiled.

### Custom Dashboard Widget

AJV Proto adds a custom WordPress Dashboard widget with the developer's contact information and logo, perfect for adding support and contact information to client websites.

The contact information is extracted from the theme's stylesheet file header (`assets/css/scss/styles.scss`) and from theme constants defined in the `inc/init.php` file.

To modify the widget's content edit the `ajv_proto_dashboard_widget()` function under the `inc/admin-functions.php` file.

## Installation

### Using The WordPress Dashboard

1. In your admin panel, go to Appearance > Themes and click the 'Add New' button
2. Click on 'Upload Theme' and select `ajv-proto.zip` from your computer
3. Click on 'Install Now'
4. Activate the theme on the WordPress Themes Dashboard

### Using FTP

1. Extract `ajv-proto.zip` to your computer
2. Upload the `ajv-proto` directory to your `wp-content/themes` directory
3. Activate the theme on the WordPress Themes Dashboard

## Frequently Asked Questions

### Does this theme support any plugins?

AJV Proto includes support for Infinite Scroll in [Jetpack](https://wordpress.org/plugins/jetpack/) and it integrates with the [Breadcrumb Trail](https://wordpress.org/plugins/breadcrumb-trail/) plugin out of the box.

## Changelog

### 1.2.0

* Added custom CSS Grid block.
* Added Cover and Group block inner container width setings.
* Added custom responsive column settings to the Columns block.
* Added custom responsive height settings to the Spacer block.
* Added filter for removing the layout settings in both posts and the Customizer.
* Updated the custom sample CTA block.
* Updated the SCSS partials for better organization.
* Updated theme template tags.
* Updated the `[year]` shortcode to optionaly include the copyright sysmbol.

### 1.1.0

* Added a Gulp.js workflow.
* Updated code syntax to follow WordPress Coding Standards.
* Added custom WordPress Dashboard widget.
* Added support for block editor.
* Added Customizer theme settings.

### 1.0.0

* Initial release.

## Credits

* Based on Underscores [https://underscores.me/](https://underscores.me/), (C) 2012-2017 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* Gulp.js workflow based on WPGulp [https://github.com/ahmadawais/WPGulp](https://github.com/ahmadawais/WPGulp), Ahmad Awais, [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* Customizer controls based on Customizer Custom Controls [https://github.com/maddisondesigns/customizer-custom-controls](https://github.com/maddisondesigns/customizer-custom-controls), Maddison Designs, [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css [https://necolas.github.io/normalize.css/](https://necolas.github.io/normalize.css/), (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)
