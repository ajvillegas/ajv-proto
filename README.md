# AJV Proto

A standards compliant starter theme for creating custom WordPress websites.

**Contributors**: [ajvillegas](http://profiles.wordpress.org/ajvillegas)  
**Tags**: [one-column](http://wordpress.org/themes/tags/one-column), [two-columns](http://wordpress.org/themes/tags/two-columns), [left-sidebar](http://wordpress.org/themes/tags/left-sidebar), [right-sidebar](http://wordpress.org/themes/tags/right-sidebar), [custom-menu](http://wordpress.org/themes/tags/custom-menu), [custom-logo](http://wordpress.org/themes/tags/custom-logo), [editor-style](http://wordpress.org/themes/tags/editor-style), [featured-images](http://wordpress.org/themes/tags/featured-images), [footer-widgets](http://wordpress.org/themes/tags/footer-widgets), [full-width-template](http://wordpress.org/themes/tags/full-width-template), [sticky-post](http://wordpress.org/themes/tags/sticky-post), [threaded-comments](http://wordpress.org/themes/tags/threaded-comments), [translation-ready](http://wordpress.org/themes/tags/translation-ready)  
**Requires at least**: 4.5  
**Tested up to**: 4.9  
**Stable tag**: 1.0.0  
**License**: [GPLv2 or later](http://www.gnu.org/licenses/gpl-2.0.html)

# Description

This is a custom, standards compliant WordPress starter theme based on Automattic's [Underscores](https://github.com/Automattic/_s).

**Prefixing Your Theme**

In order to make the theme your own, you'll have to change all the AJV Proto theme prefixes. Do a find and replace of the following strings (case sensitive). Do NOT match the whole word when doing the search as it will miss some instances:

* AJV Proto -> My Theme Name
* AJV_Proto -> My_Theme_Name
* AJV_PROTO -> MY_THEME_NAME
* ajv_proto -> my_theme_name
* ajv-proto -> my-theme-name

**Responsive Menus**

The AJV Proto theme uses a modified version of the [ResponsiveMenus.js](https://github.com/copyblogger/responsive-menus) script developed by StudioPress. In order to edit the settings, go to `/inc/scripts-and-styles.php` and edit the settings array in the `wp_localize_script` function for the `ajv-proto-responsive-menus` script.

Please refer to the [ResponsiveMenus.js](https://github.com/copyblogger/responsive-menus) page for more information regarding the option parameters.

**Working with SCSS**

This theme uses SCSS to generate the main CSS stylesheet. All the files are located under the `/scss` folder. You should only edit the theme's stylesheet file header in the `\scss\styles.scss` file to avoid overriding the comment block when CSS is compiled.

You can use your favorite task runner or software for compiling your CSS. Alternatively, you can use the [WP-SCSS plugin](https://wordpress.org/plugins/wp-scss/) which uses the [scssphp](https://github.com/leafo/scssphp) compiler library written in PHP. The theme file system is compatible with the plugin, but you'll have to specify the file paths in the plugin settings page.

Under WP-SCSS Settings page > Configure paths, enter the following:

**Scss Location** -> "/scss/" (no quotes)  
**CSS Location**  -> "/" (no quotes)

Now you can edit the SCSS files directly and the CSS will compile into `styles.css` in the theme root every time the page is reloaded in the front-end. Remember to clear the browser cache afterwards to make sure it loads the latest CSS.

# Installation

**Using The WordPress Dashboard**

1. In your admin panel, go to Appearance > Themes and click the 'Add New' button
2. Click on 'Upload Theme' and select `ajv-proto.zip` from your computer
3. Click on 'Install Now'
4. Activate the theme on the WordPress Themes Dashboard

**Using FTP**

1. Extract `ajv-proto.zip` to your computer
2. Upload the `ajv-proto` directory to your `wp-content/themes` directory
3. Activate the theme on the WordPress Themes Dashboard

# Frequently Asked Questions

**Does this theme support any plugins?**

AJV Proto includes support for Infinite Scroll in Jetpack.

# Changelog

**1.0.0**
* Initial release.

# Credits

* Based on Underscores https://underscores.me/, (C) 2012-2017 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css https://necolas.github.io/normalize.css/, (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)
