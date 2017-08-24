<?php





/* ---------------------------------------- *\
 * Add YLT footer text
\* ---------------------------------------- */

if ( is_admin() )
{
    function my_admin_footer_text( $default_text )
    {
        return '<span id="footer-thankyou">Website ontwikkeld door <a href="http://www.yellowlemontree.nl" target="_blank">Yellow Lemon Tree</a><span> | Mede mogelijk gemaakt door <a href="http://www.wordpress.org">WordPress</a>';

    }

    add_filter( 'admin_footer_text', 'my_admin_footer_text' );
}





/* ---------------------------------------- *\
 * File uploads lowercase
\* ---------------------------------------- */

function mfl_make_filename_lowercase ( $filename )
{
    $info = pathinfo($filename);
    $ext = empty($info['extension']) ? '' : '.' . $info['extension']; $name = basename($filename, $ext);

    return strtolower($name) . $ext;
}
add_filter('sanitize_file_name', 'mfl_make_filename_lowercase', 10);
