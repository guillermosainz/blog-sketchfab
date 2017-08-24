<?php





/* ---------------------------------------- *\
 * Custom post types
\* ---------------------------------------- */

function register_post_types ()
{
    $prefix = 'ylt_';



    /*
     * Extra labels
     *
For register_post_type():

[php]
'filter_items_list' => __( 'Filter your-cpt-name list', 'your-plugin-text-domain' ) ),
'items_list_navigation' => __( 'Your-cpt-name list navigation', 'your-plugin-text-domain' ) ),
'items_list' => __( 'Your-cpt-name list', 'your-plugin-text-domain' ) ),
[/php]

For register_taxonomy():

[php]
'items_list_navigation' => __( 'Your-tax-name list navigation', 'your-plugin-text-domain' ) ),
'items_list' => __( 'Your-tax-name list', 'your-plugin-text-domain' ) ),
[/php]
     */



    /* ---------------------------------------- *\
     * Producten
    \* ---------------------------------------- */

    register_post_type('producten_posts', array
        (
            'label' => __('Producten', 'ylt-dev'),
            'labels' => array
            (
                'name'                  => __('Product', 'ylt-dev'),
                'singular_name'         => __('Product', 'ylt-dev'),
                'add_new'               => __('Product toevoegen', 'ylt-dev'),
                'add_new_item'          => __('Nieuw product', 'ylt-dev'),
                'edit_item'             => __('Wijzig product', 'ylt-dev'),
                'new_item'              => __('Nieuw product', 'ylt-dev'),
                'all_items'             => __('Alle producten', 'ylt-dev'),
                'view_item'             => __('Bekijk product', 'ylt-dev'),
                'search_items'          => __('Zoek producten', 'ylt-dev'),
                'not_found'             => __('Er zijn geen producten gevonden', 'ylt-dev'),
                'not_found_in_trash'    => __('Geen producten gevonden in de prullenbak', 'ylt-dev'),
            ),
            'public'            => true,
            'can_export'        => false,
            'show_ui'           => true,
            '_builtin'          => false,
            '_edit_link'        => 'post.php?post=%d',
            'capability_type'   => 'post',
            'hierarchical'      => false,
            'rewrite'           => array("slug" => 'producten'), // Permalinks
            'supports'          => array
            (
                'title',
                'editor',
                'revisions'
                //'excerpt',
                //'thumbnail',
                //'author',
                //'comments',
                //'trackbacks',
                //'custom-fields',
                //'page-attributes',
                //'post-formats',
            ),
            'show_in_menu'      => true,
            'menu_icon'         => 'dashicons-admin-post',
            'taxonomies'        => array()
        )
    );
}

add_action('init','register_post_types');
