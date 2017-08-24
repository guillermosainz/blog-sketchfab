<?php





/* ---------------------------------------- *\
 * Global settings
\* ---------------------------------------- */

// Set user agent string to bypass no-user-agent-block in .htaccess
ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');

/** Define mostly used function returns to tweak performance. Use these constants inside your theme **/
define('TEMPLATE_URL',get_template_directory_uri());
define('HOME_URL'    ,get_home_url());
define('SITE_NAME'   ,get_bloginfo('name'));

/** Disable Wordpress' automatic updater **/
add_filter( 'automatic_updater_disabled', '__return_true' );

/** Disable Wordpress' automatic core updates **/
add_filter( 'auto_update_core', '__return_false' );

/** Disable update emails **/
add_filter( 'auto_core_update_send_email', '__return_false' );

/** Set locale **/
setlocale(LC_ALL, 'nl_NL');





/* ---------------------------------------- *\
 * Includes
\* ---------------------------------------- */

/** Standaard settings **/
include_once 'includes/inc_misc_admin.php';

/** Security settings **/
include_once 'includes/inc_security.php';

/** Wordpress head cleanup **/
include_once 'includes/inc_head_cleanup.php';

/** Init menu's **/
include_once 'includes/inc_menus.php';

/** Settings page **/
include_once 'includes/inc_options.php';

/** Image sizes **/
include_once 'includes/inc_image_sizes.php';

/** Custom post types **/
//include_once 'includes/inc_post_types.php';

/** Custom meta boxes **/
include_once 'includes/inc_cmb2.php';

/** Shortcodes **/
include_once 'includes/inc_shortcodes.php';

/** Shortcodes YLT **/
include_once 'includes/inc_shortcodes_ylt.php';




if ( ! isset( $content_width ) ) $content_width = 690;





/** Load scripts **/
function load_scripts ()
{
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'load_scripts' );

/** Excerpt length **/
function wpdocs_custom_excerpt_length( $length )
{
    return 25;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );





// Query latest posts
function queryLatestPosts ( $count, $category = null )
{
    if ( ! $count )
    {
        return false;
    }

    $sticky = get_option( 'sticky_posts' );

    unset($sticky[0]);

    $args = array
    (
        'posts_per_page'        => $count,
        'post__in'              => $sticky,
        'tag__not_in'           => 733,
        //'ignore_sticky_posts'   => 1,
    );

    $sticky_query = new WP_Query( $args );

    if ( $sticky_query->post_count < $count || empty($sticky) )
    {
        $args = array
        (
            'posts_per_page'        => $count - count($sticky),
            'ignore_sticky_posts'   => 1,
            'post__not_in'          => get_option('sticky_posts'),
            'tag__not_in'           => 733,
        );

        $post_query = new WP_Query( $args );

        $query = new WP_Query();
        if ( !empty($sticky) )
        {
            $query->posts = array_merge( $sticky_query->posts, $post_query->posts );
            $query->post_count = $sticky_query->post_count + $post_query->post_count;
        }
        else
        {
            $query->posts = $post_query->posts;
            $query->post_count = $post_query->post_count;
        }
    }
    else
    {
        $query = $sticky_query;
    }

    return $query;
}





function pagination( $query )
{
    if ( isset ( $query->max_num_pages ))
    {
        $pages = $query->max_num_pages;
        $range = $query->max_num_pages;
    }
    else
    {
        $pages = '';
        $range = 4;
    }

    $showitems = ($range * 2) + 1;

    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if ( !$pages )
        {
            $pages = 1;
        }
    }



    $visible_pages = array();
    $show_dots = false;

    for ( $i = 1; $i <= 2; $i++ )
    {
        $visible_pages[] = $i;
    }

    for ( $i = $pages; $i > $pages-2; $i-- )
    {
        $visible_pages[] = $i;
    }

    $visible_pages[] = $paged;
    $visible_pages[] = $paged + 1;
    $visible_pages[] = $paged - 1;



    if ( 1 != $pages )
    {
        echo '<div class="pagination">';

        for ( $i=1; $i <= $pages; $i++ )
        {
            if ( in_array( $i, $visible_pages ) )
            {
                if ( 1 != $pages
                && ( !($i >= $paged+$range+1
                || $i <= $paged-$range-1)
                || $pages <= $showitems ))
                {
                    if ( $paged == $i )
                    {
                        echo '<span class="current item">'.$i.'</span>';
                        $show_dots = false;
                    }
                    else
                    {
                        echo '<a href="'.get_pagenum_link($i).'" class="inactive item">'.$i.'</a>';
                    }
                }
            }
            else
            {
                if ( ! $show_dots )
                {
                    $show_dots = true;
                    echo '<span class="item dots">...</span>';
                }
            }
        }

        echo "</div>\n";
    }
}





function getCurrentUrl ()
{
    global $wp;

    $current_url = HOME_URL;
    $current_url .= '/';
    $current_url .= $wp->request;
    $current_url .= '/';

    return $current_url;
}

function returnTagUrl ( $active_tags, $current_tag = false )
{
    $tags_url = '';
    $url_prefix = '?';
    $current_active = false;

    if ( !empty( $active_tags ))
    {
        foreach ( $active_tags as $tag )
        {
            if ( $tag != $current_tag )
            {
                $tags_url .= $url_prefix .'tag[]='. $tag;
                $url_prefix = '&';
            }
            else
            {
                $current_active = true;
            }
        }
    }

    if ( !$current_active && $current_tag )
    {
        $tags_url .= $url_prefix .'tag[]='. $current_tag;
    }

    return $tags_url;
}





function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}





/**
 * Change excerpt dots
 */

function trim_excerpt($text)
{
    return str_replace( '[&hellip;]', '&hellip;', $text );
}
add_filter('get_the_excerpt', 'trim_excerpt');






function register_category_sidebars ()
{
    $categories = get_terms('category');

    foreach ( $categories as $category )
    {
        register_sidebar
        (
            array
            (
                'name' => $category->name,
                'id' => 'sidebar_'.$category->slug,
                'before_widget' => '<section id="%1$s" class="content-white %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="title">',
            )
        );
    }

}
add_action( 'widgets_init', 'register_category_sidebars' );





/* ---------------------------------------- *\
 * Get image from url
\* ---------------------------------------- */

function get_image_id_from_url($image_url)
{
	global $wpdb;

    if ( !empty($image_url) )
    {
        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
        return $attachment[0];
    }
}





/* ---------------------------------------- *\
 * Excerpt button
\* ---------------------------------------- */

function sketchfab_excerpt_more( $more )
{
    return '';
}
add_filter( 'excerpt_more', 'sketchfab_excerpt_more' );





/* ---------------------------------------- *\
 * Author extra fields
\* ---------------------------------------- */

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
 
function my_show_extra_profile_fields( $user ) { ?>
 
    <h3>Extra profile information</h3>
 
    <table class="form-table">
 
        <tr>
            <th><label for="sketchfab-profile">Sketchfab profile</label></th>
 
            <td>
                <input type="text" name="sketchfab-profile" id="sketchfab-profile" value="<?php echo esc_attr( get_the_author_meta( 'sketchfab-profile', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your Sketchfab profile URL.</span>
            </td>
        </tr>
 
    </table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
 
function my_save_extra_profile_fields( $user_id ) {
 
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
 
    /* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
    update_user_meta( absint( $user_id ), 'sketchfab-profile', wp_kses_post( $_POST['sketchfab-profile'] ) );
}
