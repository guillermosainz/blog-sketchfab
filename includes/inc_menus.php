<?php





/* ---------------------------------------- *\
 * Register menus
\* ---------------------------------------- */

function register_menus ()
{
    register_nav_menu('top-nav',__( 'Top nav' ));
    register_nav_menu('blog-nav',__( 'Blog nav' ));
    register_nav_menu('footer-nav',__( 'Footer nav' ));
    register_nav_menu('bottom-nav',__( 'Bottom nav' ));
}

add_action( 'init', 'register_menus' );
