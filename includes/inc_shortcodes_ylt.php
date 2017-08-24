<?php





function popular_articles( $atts, $content = null )
{
    return get_popular_articles( @$atts['cat'] );
}
add_shortcode( 'popular_articles', 'popular_articles' );




function latest_posts( $atts, $content = null )
{
    return get_latest_posts( @$atts['cat'] );
}
add_shortcode( 'latest_posts', 'latest_posts' );




function highlights( $atts, $content = null )
{
    return get_highlights( @$atts['cat'] );
}
add_shortcode( 'highlights', 'highlights' );





function get_popular_articles ( $category )
{
    global $post;

    ob_start();
    ?>
    <div class="row">
        <header class="col-xs-12">
            <h1><?php _e('Popular articles', 'ylt-dev'); ?></h1>
        </header><!-- .col-xs-12 -->

        <section class="populair-articles col-xs-12">
            <?php

            $args = array
            (
                'post_type'         => 'post',
                'posts_per_page'    => 3,
                'ignore_sticky_posts'   => 1,
                'category_name'          => $category,
            );

            $popular = new WP_Query( $args );

            $exclude = array();

            while ( $popular->have_posts() ): $popular->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="article">
                    <?php the_post_thumbnail('blog-thumb'); ?>
                    <div class="article-info">
                        <div class="categories">
                            <?php foreach ( get_the_category() as $category ): ?>
                                <?php $exclude[] = $post->ID; ?>
                                <span class="category">
                                    <?php echo $category->name; ?>
                                </span>
                            <?php endforeach; ?>
                        </div><!-- .categories -->
                        <h2 class="title"><?php the_title(); ?></h2>
                    </div><!-- .article-info -->
                </a><!-- .article -->
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </section><!-- .populair-articles -->
    </div><!-- .row -->
    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}





function get_latest_posts ( $category )
{
    global $post;

    ob_start();
    ?>
    <div class="row latest-news">

        <div class="col-md-9 col-sm-12">
            <header class="container-top">
                <h2 class="title"><?php _e('Latest posts', 'ylt-dev'); ?></h2>
            </header><!-- .col-xs-12 -->
            <?php
            $args = array
            (
                'post_type'         => 'post',
                'posts_per_page'    => 3,
                'ignore_sticky_posts'     => true,
                'category_name'     => $category,
            );

            $news = new WP_Query( $args );

            while ( $news->have_posts() ): $news->the_post(); ?>

                <article class="news-item">
                    <?php the_post_thumbnail('blog-thumb'); ?>
                    <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php echo $post->post_excerpt; ?>
                </article>

            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>


        <div class="col-md-3 hidden-sm latest-uploads">
            <header class="container-top">
                <h2 class="title"><?php _e('Latest uploads', 'ylt-dev'); ?></h2>
            </header><!-- .col-xs-12 -->

            <?php
            $args = array
            (
                'post_type'         => 'post',
                'posts_per_page'    => 3,
                'ignore_sticky_posts' => true,
                'orderby'           => 'date',
            );

            $uploads = new WP_Query($args);

            while ( $uploads->have_posts() ): $uploads->the_post(); ?>

                <a class="latest-upload" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail('blog-thumb'); ?>
                </a>

            <?php endwhile; ?>

            <a href="<?php echo HOME_URL; ?>/articles/" class="more"><?php _e('More uploads', 'ylt-dev'); ?></a>
        </div>

    </div><!-- .row -->
    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}





function get_highlights ( $category )
{
    global $post;

    ob_start();
    ?>
    <div class="container highlights art-spotlight fixed-grid">
        <?php
        $category_id = get_cat_ID( $category );
        $category_link = get_category_link( $category_id );
        ?>

        <header class="container-top">
            <h1 class="title"><?php _e('Highlight', 'ylt-dev'); ?></h1>
            <a class="more" href="<?php echo $category_link; ?>"><?php _e('More', 'ylt-dev'); ?></a>
        </header>

        <div class="row posts">
            <?php

            $args = array
            (
                'post_type'             => 'post',
                'posts_per_page'        => 5,
                'category_name'        => $category,
            );

            $highlights = new WP_Query( $args );

            while ( $highlights->have_posts() ): $highlights->the_post(); ?>

                <article class="post-link">
                    <a href="<?php the_permalink(); ?>" class="thumb-link">
                        <?php the_post_thumbnail( 'blog-thumb' ); ?>
                    </a>

                    <h2 class="title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <span class="author">By <?php the_author(); ?></span>
                </article>

            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div><!-- .posts -->
    </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
