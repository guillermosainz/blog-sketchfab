




<?php get_header(); ?>
<?php

$author_id = $post->post_author;
$author = get_user_by('id', $author_id);

?>





<section class="container">
    <div class="row">

        <header class="content-header content-white col-xs-12">

            <h1 class="title"><?php printf( __('Posts by %s'), $author->user_nicename); ?></h1>
            <?php pagination($wp_query); ?>

        </header><!-- .content-header -->

        <section class="posts content-white large">

        <?php while ( have_posts() ): the_post(); ?>
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

            <p class="result-count"><?php printf('%d results', $wp_query->found_posts); ?></p>
        </section><!-- .posts -->

    </div><!-- .row -->
</section><!-- .container -->





<?php get_footer(); ?>
