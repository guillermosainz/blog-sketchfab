<?php

if ( is_admin() )
{
    add_action( 'admin_menu', 'add_settings_menu' );
}

function add_settings_menu()
{
	add_menu_page('Website opties', 'Website opties', 'administrator', 'website-opties', 'theme_settings');

	add_action( 'admin_init', 'register_theme_settings' );

}

function register_theme_settings()
{

    register_setting( 'theme_settings', 'social_facebook');
    register_setting( 'theme_settings', 'social_twitter');
    register_setting( 'theme_settings', 'social_google');
    register_setting( 'theme_settings', 'social_pinterest');
    register_setting( 'theme_settings', 'social_linkedin');
    register_setting( 'theme_settings', 'social_instagram');


    register_setting( 'theme_settings', 'hot_topics');
    register_setting( 'theme_settings', 'hot_topics_page');

}

function theme_settings()
{

    ?>

    <div class="wrap">

    <h2><?php _e('Website opties','ylt-dev'); ?></h2>

    <?php if (isset($_GET['settings-updated'])): ?>

        <div id="setting-error-settings_updated" class="updated settings-error">
        <p><strong>Instellingen opgeslagen.</strong></p></div>

    <?php endif; ?>

    <form method="post" action="options.php">
    <?php settings_fields( 'theme_settings' ); ?>
    <?php do_settings_sections( 'theme_settings' ); ?>

    <h3 class="title">Social</h3>
    <table class="form-table">
    <tr>
        <th scope="row"><label>Facebook</label></th>
        <td><input type="text" name="social_facebook" value="<?php echo get_option('social_facebook'); ?>" class="regular-text"/></td>
    </tr>
    <tr>
        <th scope="row"><label>Twitter</label></th>
        <td><input type="text" name="social_twitter" value="<?php echo get_option('social_twitter'); ?>" class="regular-text"/></td>
    </tr>
    <tr>
        <th scope="row"><label>Google+</label></th>
        <td><input type="text" name="social_google" value="<?php echo get_option('social_google'); ?>" class="regular-text"/></td>
    </tr>
    <tr>
        <th scope="row"><label>Pinterest</label></th>
        <td><input type="text" name="social_pinterest" value="<?php echo get_option('social_pinterest'); ?>" class="regular-text"/></td>
    </tr>
    <tr>
        <th scope="row"><label>LinkedIn</label></th>
        <td><input type="text" name="social_linkedin" value="<?php echo get_option('social_linkedin'); ?>" class="regular-text"/></td>
    </tr>
    <tr>
        <th scope="row"><label>Instagram</label></th>
        <td><input type="text" name="social_instagram" value="<?php echo get_option('social_instagram'); ?>" class="regular-text"/></td>
    </tr>
    </table>




    <?php
    global $post;
    $pages = array();

    $args = array
    (
        'post_type'     => 'page',
        'posts_per_page'=> -1,
    );

    $query = new WP_Query( $args );

    while ( $query->have_posts() )
    {
        $query->the_post();
        $pages[$post->ID] = get_the_title();
    }
    ?>
    <h3 class="title">Navigation</h3>
    <table class="form-table">
    <tr>
        <th scope="row"><label>Hot topics</label></th>
        <td>
        <?php

        $hot_topics = get_option('hot_topics');
        $hot_topics_pages = get_option('hot_topics_page');

        $args = array
        (
            'taxonomy'      => 'category',
            'hide_empty'    => false,
            'exclude'       => 1,
        );

        echo '<table>';
        foreach ( get_terms($args) as $term )
        {
            $checked = '';
            if ( isset($hot_topics[$term->slug])
            && $hot_topics[$term->slug] == 'on' )
            {
                $checked = 'checked="checked"';
            }
        
            echo '<tr>';
            echo '<td>';
            printf('<input type="checkbox" name="hot_topics[%s]" id="%s" %s />',
                $term->slug,
                $term->slug,
                $checked );
            printf('<label for="%s">%s</label>', $term->slug, $term->name );
            echo '</td>';

            echo '<td>';

            printf('<select name="hot_topics_page[%s]">', $term->slug);
            foreach ( $pages as $id => $name )
            {
                $selected = '';
                if ( $hot_topics_pages[$term->slug] == $id )
                {
                    $selected = 'selected="selected"';
                }
                printf('<option value="%s" %s>%s</option>', $id, $selected, $name);
            }
            echo '</select>';
            echo '</td>';

            echo '</tr>';
        }
        echo '</table>';
        ?>
        </td>
    </tr>
    </table>

    <?php submit_button(__('Instellingen opslaan','ylt-dev')); ?>

    </form>
    </div>

    <?php

}

?>
