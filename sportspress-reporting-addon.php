<?php
/*
   Plugin Name: Sportspress Reporting Addon
   Plugin URI: http://wordpress.org/extend/plugins/wpf-spreports/
   Version: 1.0.0
   Author: Renee Allred
   Description: Reporting for SportsPress Events
   Text Domain: wpf-spreports
   License: GPLv3
  */

/*
    "WordPress Plugin Template" Copyright (C) 2017 Michael Simpson  (email : michael.d.simpson@gmail.com)

    This following part of this file is part of WordPress Plugin Template for WordPress.

    WordPress Plugin Template is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    WordPress Plugin Template is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Contact Form to Database Extension.
    If not, see http://www.gnu.org/licenses/gpl-3.0.html
*/

$wpf_spreports_minimalRequiredPhpVersion = '5.0';

/**
 * Check the PHP version and give a useful error message if the user's version is less than the required version
 * @return boolean true if version check passed. If false, triggers an error which WP will handle, by displaying
 * an error message on the Admin page
 */
function wpf_spreports_noticePhpVersionWrong() {
    global $wpf_spreports_minimalRequiredPhpVersion;
    echo '<div class="updated fade">' .
      __('Error: plugin "wpf-spreports" requires a newer version of PHP to be running.',  'wpf-spreports').
            '<br/>' . __('Minimal version of PHP required: ', 'wpf-spreports') . '<strong>' . $wpf_spreports_minimalRequiredPhpVersion . '</strong>' .
            '<br/>' . __('Your server\'s PHP version: ', 'wpf-spreports') . '<strong>' . phpversion() . '</strong>' .
         '</div>';
}


function wpf_spreports_PhpVersionCheck() {
    global $wpf_spreports_minimalRequiredPhpVersion;
    if (version_compare(phpversion(), $wpf_spreports_minimalRequiredPhpVersion) < 0) {
        add_action('admin_notices', 'wpf_spreports_noticePhpVersionWrong');
        return false;
    }
    return true;
}


/**
 * Initialize internationalization (i18n) for this plugin.
 * References:
 *      http://codex.wordpress.org/I18n_for_WordPress_Developers
 *      http://www.wdmac.com/how-to-create-a-po-language-translation#more-631
 * @return void
 */
function wpf_spreports_i18n_init() {
    $pluginDir = dirname(plugin_basename(__FILE__));
    load_plugin_textdomain('wpf-spreports', false, $pluginDir . '/languages/');
}


//////////////////////////////////
// Run initialization
/////////////////////////////////

// Initialize i18n
add_action('plugins_loadedi','wpf_spreports_i18n_init');

// Run the version check.
// If it is successful, continue with initialization for this plugin
if (wpf_spreports_PhpVersionCheck()) {
    // Only load and run the init function if we know PHP version can parse it
    include_once('wpf_spreports_init.php');
    wpf_spreports_init(__FILE__);
}
