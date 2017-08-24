test



<?php get_header(); ?>



<?php
 
$use_focus_landing = false;

if ( isset($_GET['hot-topic']) )
{
    $use_focus_landing = true;
}



// HOT TOPIC

if ( $use_focus_landing ): ?>





<section class="container populair-container">
    <div class="row">
        <header class="col-xs-12">
            <h1><?php _e('Popular articles', 'ylt-dev'); ?></h1>
        </header><!-- .col-xs-12 -->

        <section class="populair-articles col-xs-12">
            <?php

            //$query = queryLatestPosts(3);

            $current_category = get_query_var('category_name');

            $args = array
            (
                'post_type'         => 'post',
                'posts_per_page'    => 3,
                'ignore_sticky_posts'   => 1,
                'category_name'          => $current_category,
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
</section><!-- .container -->





<section class="latest-news container">
    <div class="row">

        <div class="col-md-9 col-sm-12">
            <header class="container-top">
                <h2 class="title"><?php _e('Latest news', 'ylt-dev'); ?></h2>
            </header><!-- .col-xs-12 -->
            <?php
            $args = array
            (
                'post_type'         => 'post',
                'posts_per_page'    => 3,
                'ignore_sticky_posts'     => true,
                'category_name'     => 'geen-categorie',
            );

            $news = new WP_Query( $args );

            while ( $news->have_posts() ): $news->the_post(); ?>

                <article class="news-item">
                    <?php the_post_thumbnail('blog-thumb'); ?>
                    <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php the_excerpt(); ?>
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
</section><!-- .latest-news -->





<section class="art-spotlight container-fluid fixed-grid">
    <div class="container">

        <?php
        $category_id = get_cat_ID( 'Art spotlight' );
        $category_link = get_category_link( $category_id );
        ?>

        <header class="container-top">
            <h1 class="title"><?php _e('Art Spotlights', 'ylt-dev'); ?></h1>
            <a class="more" href="<?php echo $category_link; ?>"><?php _e('More spotlights', 'ylt-dev'); ?></a>
        </header>

        <div class="row posts">
            <?php

            $args = array
            (
                'posts_per_page'        => 5,
                'category_name'        => 'art-spotlight',
            );

            query_posts( $args );

            while ( have_posts() ): the_post(); ?>

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

    </div><!-- .container -->
</section><!-- .tutorials -->





<section class="community-stories container">
    <div class="row">

        <div class="col-md-9 col-sm-12">
            <header class="container-top">
                <h2 class="title"><?php _e('Community stories', 'ylt-dev'); ?></h2>
            </header><!-- .col-xs-12 -->
            <?php
            $args = array
            (
                'post_type'         => 'post',
                'posts_per_page'    => 3,
                'ignore_sticky_posts'     => true,
                'category_name'     => 'community-story',
            );

            $news = new WP_Query( $args );

            while ( $news->have_posts() ): $news->the_post(); ?>

                <article class="news-item">
                    <?php the_post_thumbnail('blog-thumb'); ?>
                    <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php the_excerpt(); ?>
                </article>

            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>


        <div class="col-md-3 hidden-sm upcoming-event">
            <header class="container-top">
                <h2 class="title"><?php _e('Upcoming event', 'ylt-dev'); ?></h2>
            </header><!-- .col-xs-12 -->

            <?php
            $args = array
            (
                'post_type'         => 'post',
                'posts_per_page'    => 1,
                'category_name'     => 'event',
                'orderby'           => 'date',
            );

            $event = new WP_Query($args);

            while ( $event->have_posts() ): $event->the_post(); ?>

            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php the_excerpt(); ?>

            <a href="<?php the_permalink(); ?>" class="button-black"><?php _e('Keep reading', 'ylt-dev'); ?></a>

            <?php endwhile; ?>
        </div>
        
    </div><!-- .row -->
</section><!-- .latest-news -->








<?php else: ?>





<section class="container">
    <div class="row">

        <header id="filter" class="content-header content-white col-xs-12">
            <?php

            $page = get_page_by_path( 'articles' );

            if ( is_home() || $post->ID == $page->ID )
            {
                $title = __('All articles', 'ylt-dev');
                $active = 'active';
            }
            else
            {
                $title = single_cat_title('',false);
                $active = '';
            }
            ?>

            <?php
            $tags = get_query_var('tag');
            $active_tags = array();

            if ( !empty($tags) )
            {
                if ( is_array($tags) )
                {
                    $active_tags = $tags;
                }
                else
                {
                    $active_tags = explode(',', $tags);
                }
            }

            ?>
            <h1 class="title"><?php echo $title; ?></h1>
            <div class="categories">
                <a href="<?php echo get_the_permalink($page->ID); ?>"
                    class="button-black-outline <?php echo $active; ?>">
                    <?php _e('All categories', 'ylt-dev'); ?>
                </a>
                <?php

                $args = array
                (
                    //'exclude' => array(1),
                );
                    
                $categories = get_categories( $args );

                foreach ( $categories as $category ): ?>

                    <?php
                    $active = '';
                    if ( $category->name == single_cat_title('',false) )
                    {
                        $active = 'active';
                    }
                    ?>

                    <a href="<?php echo get_category_link( $category->term_id ); ?>"
                        class="button-black-outline <?php echo $active; ?>">
                        <?php echo $category->name; ?>
                    </a>

                <?php endforeach; ?>
            </div><!-- .categories -->



            <?php

            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

            $args = array
            (
                //'post__not_in'  => $exclude,
                'cat'           => get_query_var('cat'),
                'tag'           => $tags,
                'posts_per_page'=> 16,
                'paged'         => $paged,
            );

            $query = new WP_Query( $args );

            $post_count = $query->found_posts;
            ?>

        </header><!-- .content-header -->

        <section class="posts content-white large">

        <?php while ( $query->have_posts() ): $query->the_post(); ?>
            <article class="post-link">
                <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail($post->ID) ): ?>
                        <?php the_post_thumbnail( 'blog-thumb' ); ?>
                    <?php else: ?>
                        <img width="370" height="200" src="<?php echo TEMPLATE_URL; ?>/img/thumb-placeholder.png" class="attachment-blog-thumb size-blog-thumb wp-post-image">
                    <?php endif; ?>
                </a>

                <?php the_category(); ?>

                <h2 class="title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
            </article><!-- .post-link -->
        <?php endwhile; ?>

            <p class="result-count"><?php printf('%d results', $post_count); ?></p>

            <?php pagination($query); ?>

        </section><!-- .posts -->

    </div><!-- .row -->
</section><!-- .container -->


<?php endif; ?>




<?php get_footer(); ?>
