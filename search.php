



<?php get_header(); ?>





<section class="container">
    <div class="row">

        <header id="filter" class="content-header content-white col-xs-12">

            <h1 class="title">Search results for <?php echo esc_attr(get_query_var('s')); ?></h1>

            <?php

            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

            ?>

        </header><!-- .content-header -->

        <section class="posts content-white">

        <?php while ( have_posts() ): the_post(); ?>
            <article class="post-link">
                <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail($post->ID) ): ?>
                        <?php the_post_thumbnail( 'blog-thumb' ); ?>
                    <?php else: ?>
                        <img width="370" height="200" src="<?php echo TEMPLATE_URL; ?>/img/thumb-placeholder.png" class="attachment-blog-thumb size-blog-thumb wp-post-image">
                    <?php endif; ?>
                </a>

                <?php
                switch ( get_post_type($post->ID) )
                {
                    case 'post':
                        the_category();
                    break;

                    case 'page':
                        echo '<span class="post-type">Page</span>';
                    break;
                }

                ?>

                <h2 class="title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
            </article><!-- .post-link -->
        <?php endwhile; ?>

            <p class="result-count"><?php printf('%d results', $wp_query->found_posts); ?></p>

            <?php pagination($wp_query); ?>

        </section><!-- .posts -->

    </div><!-- .row -->
</section><!-- .container -->





<?php get_footer(); ?>
