<?php





/*******************************\
 * Require init
\*******************************/

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}





/*******************************\
 * Post header
\*******************************/

function register_page_info ()
{
	$prefix = 'ylt_';

    $cmb_post_header = new_cmb2_box
    (
        array
        (
            'id'           => $prefix . 'header_info',
            'title'        => __( 'Header', 'ylt-dev' ),
            'object_types' => array( 'post', ), // Post type
            'context'      => 'normal',
            'priority'     => 'high',
            'show_names'   => true, // Show field names on the left
        )
    );



    /* Fields */


    $cmb_post_header->add_field
    (
        array
        (
            'name' => __( 'Text color', 'ylt-dev' ),
            'desc' => __( 'Text color in header', 'ylt-dev' ),
            'id'   => $prefix . 'text_color',
            'type' => 'select',
            'options' => array
            (
                '#1caad9' => 'Blue',
                '#fff' => 'White',
                '#000' => 'Black',
            ),
        )
    );

    $cmb_post_header->add_field
    (
        array
        (
            'name' => __( 'Overlay', 'ylt-dev' ),
            'desc' => __( 'Show overlay in header', 'ylt-dev' ),
            'id'   => $prefix . 'overlay',
            'type' => 'checkbox',
        )
    );
}
add_action( 'cmb2_admin_init', 'register_page_info' );
