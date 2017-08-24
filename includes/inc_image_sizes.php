<?php

add_theme_support( 'post-thumbnails', array( 'post' ) );

add_image_size( 'blog-thumb', 370, 200, true );
add_image_size( 'blog-thumb-high', 740, 400, true );
add_image_size( 'blog-thumb-large', 600, 500, true );
add_image_size( 'head-img', 1500, 500, false );

add_filter( 'image_size_names_choose', 'register_image_sizes' );

function register_image_sizes( $sizes )
{
    return array_merge( $sizes, array(
        'blog-thumb' => __( 'Blog afbeelding', 'ylt-dev' ),
        'blog-thumb-large' => __( 'Blog afbeelding groot', 'ylt-dev' ),
        'head-img' => __( 'Header', 'ylt-dev' ),
    ) );
}
