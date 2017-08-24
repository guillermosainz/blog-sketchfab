




<?php get_header(); ?>





<section class="latest-news container">

        <?php
            $article_link = get_the_permalink(get_page_by_path( 'articles' ));
        ?>

    <header class="container-top">
        <h1 class="title"><?php _e('Latest news', 'ylt-dev'); ?></h1>
        <a class="more" href="<?php echo $article_link; ?>"><?php _e('All news', 'ylt-dev'); ?></a>
    </header>

    <div class="row posts">
        <?php

        $query = queryLatestPosts(7);

        while ( $query->have_posts() ): $query->the_post(); ?>

            <article class="post-link">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'blog-thumb' ); ?>
                </a>

                <?php the_category(); ?>

                <h2 class="title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>

                <div class="excerpt">
                    <?php the_excerpt(); ?>
                </div><!-- .excerpt -->
            </article>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div><!-- .row -->

    <div class="row bottom">
        <a href="<?php echo $article_link; ?>" class="button-blue"><?php _e('More news', 'ylt-dev'); ?></a>
    </div><!-- .row -->

</section><!-- .latest-news -->





<section class="tutorials container-fluid fixed-grid">
    <div class="container">

        <?php
        $category_id = get_cat_ID( 'Tutorials' );
        $category_link = get_category_link( $category_id );
        ?>

        <header class="container-top">
            <h1 class="title"><?php _e('Tutorials', 'ylt-dev'); ?></h1>
            <a class="more" href="<?php echo $category_link; ?>"><?php _e('More tutorials', 'ylt-dev'); ?></a>
        </header>

        <div class="row posts">
            <?php

            $args = array
            (
                'posts_per_page'        => 5,
                'category_name'        => 'tutorial',
            );

            query_posts( $args );

            while ( have_posts() ): the_post(); ?>

                <article class="post-link">
                    <a href="<?php the_permalink(); ?>" class="thumb-link">
                        <?php the_post_thumbnail( 'blog-thumb-high' ); ?>
                    </a>

                    <h2 class="title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                </article>

            <?php endwhile; ?>
        </div><!-- .posts -->

    </div><!-- .container -->
</section><!-- .tutorials -->





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

            $first_item = true;

            $args = array
            (
                'posts_per_page'        => 5,
                'category_name'        => 'art-spotlight',
            );

            query_posts( $args );

            while ( have_posts() ): the_post(); ?>

                <article class="post-link">
                    <a href="<?php the_permalink(); ?>" class="thumb-link">
                        <?php if ( $first_item )
                        {
                            $size = 'blog-thumb-large';
                            $first_item = false;
                        }
                        else
                        {
                            $size = 'blog-thumb';
                        } ?>
                        <?php the_post_thumbnail( $size ); ?>
                    </a>

                    <h2 class="title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <span class="author">By <?php the_author(); ?></span>
                </article>

            <?php endwhile; ?>
        </div><!-- .posts -->

    </div><!-- .container -->
</section><!-- .tutorials -->





<?php get_footer(); ?>
