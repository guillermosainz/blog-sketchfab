<?php





/** Disable XMLRPC **/
add_filter('xmlrpc_enabled', '__return_false');

/** Disable login messages **/
add_filter('login_errors',create_function('$a', "return null;"));

/** Disable editor **/
define( 'DISALLOW_FILE_EDIT', true);
