<!doctype html>
<html lang="en">

<head>
    <title><?php echo SITE_NAME; ?> <?php echo wp_title('&raquo;',true,'left'); ?></title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo TEMPLATE_URL; ?>/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo TEMPLATE_URL; ?>/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo TEMPLATE_URL; ?>/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo TEMPLATE_URL; ?>/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo TEMPLATE_URL; ?>/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo TEMPLATE_URL; ?>/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo TEMPLATE_URL; ?>/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo TEMPLATE_URL; ?>/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo TEMPLATE_URL; ?>/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo TEMPLATE_URL; ?>/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo TEMPLATE_URL; ?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo TEMPLATE_URL; ?>/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo TEMPLATE_URL; ?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo TEMPLATE_URL; ?>/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#1caad9">
    <meta name="msapplication-TileImage" content="<?php echo TEMPLATE_URL; ?>/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#1caad9">

    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,400italic,700,700italic,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/css/style.css" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>








    <!-- Top nav -->

<section class="nav">
    <section class="top-nav container-fluid">
        <div class="top-container">

            <div class="logo">
                <a class="link" href="https://sketchfab.com/">

                <img src="<?php echo TEMPLATE_URL; ?>/img/sketchfab-logo.png" width="121" height="30" class="visual" alt="Sketchfab">

                </a>
            </div>


            <?php
            $args = array
            (
                'theme_location'    => 'top-nav',
                'container'         => false,
                'menu_class'        => 'navigation',
            );

            
            include( 'menu.php' );

            ?>

                <form class="search" data-action="search" action="<?php echo HOME_URL; ?>">
                <div class="box">
                    <button class="search-icon fa fa-search" type="submit"></button>
                    <input class="value header-search-form" type="text" name="s" placeholder="Search" autocapitalize="none" autocomplete="off" autocorrect="off" data-cip-id="cIPJQ342845639">
                    <a href="#" class="clear hidden"></a>
                </div>

                <button class="header-search-cancel" data-action="exit-search">Cancel</button>

            </form>

            <div class="actions">

                <div class="anonymous">
                    <a href="/login" class="button btn-medium login" data-action="open-login">Login</a>
                    <span class="or">or</span>
                    <a href="/signup" class="button btn-medium btn-secondary signup" data-action="open-signup">Sign Up</a>
                    <a href="/signup?next=/upload" class="button btn-medium btn-primary signup-upload" data-action="open-signup-upload">
                        <i class="icon fa fa-arrow-up"></i>
                        Upload
                    </a>
                </div>

            </div>
        </div>
    </section><!-- .top-nav -->



    <!-- Blog nav -->

    <section class="blog-nav container-fluid">
        <nav class="menu-container">
            <?php
            $args = array
            (
                'theme_location'     => 'blog-nav',
                'container'          => false,
            );

            wp_nav_menu( $args );
            ?>

            <div class="hot-topics">
                <span class="title"><?php _e('Hot topics', 'ylt-dev'); ?></span>
                <?php
                $hot_topics = get_option('hot_topics');
                if ( !empty($hot_topics) )
                {
                    foreach ( $hot_topics as $hot_topic => $v )
                    {
                        $term = get_term_by( 'slug', $hot_topic, 'category' );
                        $url = get_term_link($term->term_id) . '?hot-topic';

                        $hot_topics_pages = get_option('hot_topics_page');
                        $linked_page_id = $hot_topics_pages[$hot_topic];
                        $linked_page_url = get_the_permalink($linked_page_id);

                        printf('<a class="hot-topic" href="%s">%s</a>', $linked_page_url, $term->name );
                    }
                }
                ?>
            </div><!-- .hot-topics -->
        </nav><!-- .menu-container -->
    </section><!-- .blog-nav -->
</section><!-- .nav -->


<?php if ( is_front_page() ): ?>

    <?php

    $sticky = get_option( 'sticky_posts' );
    $args = array
    (
        'post_type'     => 'post',
        'p'             => $sticky[0],
        'orderby'       => 'rand',
        'posts_per_page'=> 1,
        'tag__not_in'           => 733,
    );

    $front_post = new WP_Query( $args );

    while ( $front_post->have_posts() ): $front_post->the_post(); ?>

    <?php

    $style = '';

    if ( $color = get_post_meta($post->ID, 'ylt_text_color', true) )
    {
        $style = sprintf('style="color: %s"', $color);
    }

    $overlay = false;
    if ( get_post_meta($post->ID, 'ylt_overlay', true) == 'on' )
    {
        $overlay = true;
    }

    ?>

    <header class="page-head">
        <a href="<?php the_permalink(); ?>" class="header-image">
            <?php the_post_thumbnail('head-img'); ?>
            <?php if ( $overlay ): ?>
            <div class="overlay"></div>
            <?php endif; ?>
            <section class="header-content container" <?php echo $style; ?>>
                <h1 class="title"><?php the_title(); ?></h1>
                <div class="content"><?php the_excerpt(); ?></div>
            </section><!-- .header-content -->
        </a><!-- .header-image -->
    </header><!-- .page-head -->

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>


<?php endif; ?>



<?php if ( is_single() && has_post_thumbnail() ): ?>
<header class="page-head">

    <picture class="header-image">
        <?php the_post_thumbnail('head-img'); ?>
    </picture><!-- .header-image -->

</header><!-- .page-head -->
<?php endif; ?>
