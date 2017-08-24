



<?php get_header(); ?>





<?php while ( have_posts() ): the_post(); ?>
<section class="container">
    <div class="row">

        <header class="content-header col-xs-12">
            <h1 class="title">
                <?php echo $post->post_title; ?>
            </h1>
            <a href="#" class="back-button"><?php _e('Back to overview', 'ylt-dev'); ?></a>
            <section class="post-info">
                <?php the_category(); ?>
                <span class="date"><?php the_date(); ?></span>
            </section><!-- .post-info -->
        </header><!-- .content-header -->

        <article class="content col-sm-8">
            <div class="content-white">

                <?php the_content(); ?>

            </div><!-- .content-white -->

            <div class="content-white article-bottom author">
                <p class="title">About the author</p>
                <div class="author-info">
                    <?php $author_id = get_the_author_meta('ID'); ?>
                    <?php echo get_avatar($author_id); ?>
                    <h4 class="name"><?php the_author(); ?></h4>
                    <p><?php echo nl2br(get_the_author_meta('description')); ?></p>
                </div><!-- .author-info -->
                <hr />
            </div><!-- .content-white -->

            <div class="content-white article-bottom social-share">
                <h4 class="title"><?php _e('Share this article', 'ylt-dev'); ?></h4>
                <div class="socials">
                    <?php $current_url = urlencode(get_the_permalink()); ?>
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?<?php echo $current_url; ?>" class="social-link facebook"><?php _e('Facebook', 'ylt-dev'); ?></a>

                    <a target="_blank" href="https://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" class="social-link twitter"><?php _e('Twitter', 'ylt-dev'); ?></a>

                    <a target="_blank" href="https://plus.google.com/share?url=<?php echo $current_url; ?>" class="social-link google"><?php _e('Google+', 'ylt-dev'); ?></a>

                    <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $current_url; ?>&title=<?php urlencode(get_the_title()); ?>&summary=<?php urlencode(get_the_excerpt()); ?>" class="social-link linkedin"><?php _e('LinkedIn', 'ylt-dev'); ?></a>

                    <a target="_blank" href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo $current_url; ?>&title=<?php urlencode(get_the_title()); ?>&caption=<?php urlencode(get_the_excerpt()); ?>" class="social-link tumblr"><?php _e('Tumblr', 'ylt-dev'); ?></a>

                </div><!-- .share-buttons -->
            </div><!-- .content-white -->

            <div class="content-blue article-bottom leave-comment">
                <?php comment_form(); ?>
            </div><!-- .content-blue -->

            <div class="content-white article-bottom">
                <ul class="comments">
                <?php

                wp_list_comments
                (
                    array
                    (
                        'type' => 'comment',
                        'page' => $post->ID,
                        'avatar_size' => 96,
                    )
                );

                ?>
                </ul>

            </div><!-- .content-white -->

            <div class="content-white article-bottom related">
                <h3><?php _e('Related articles', 'ylt-dev'); ?></h3>

                <div class="related-articles">
                    <?php

                    $categories = get_the_category();
                    $category_ids = array();

                    foreach ( $categories as $category )
                    {
                        $category_ids[] = $category->term_id;
                    }

                    $args = array
                    (
                        'posts__not_in' => array( $post->ID ),
                        'category__in'  => $category_ids,
                        'posts_per_page'=> 3,
                        'orderby'       => 'rand',
                    );

                    $related = new WP_Query( $args );

                    while ( $related->have_posts() ): $related->the_post(); ?>

                        <a href="<?php the_permalink(); ?>" class="article">
                            <?php if ( has_post_thumbnail($post->ID) ): ?>
                                <?php the_post_thumbnail( 'blog-thumb' ); ?>
                            <?php else: ?>
                                <img width="370" height="200" src="<?php echo TEMPLATE_URL; ?>/img/thumb-placeholder.png" class="attachment-blog-thumb size-blog-thumb wp-post-image">
                            <?php endif; ?>
                            <h4 class="title"><?php the_title(); ?></h4>
                        </a><!-- .article -->

                    <?php endwhile; ?>
                </div><!-- .related-articles -->
            </div><!-- .content-white -->

        </article><!-- .content -->





        <?php $category = get_the_category(); ?>

        <?php if ( is_active_sidebar( 'sidebar_'. $category[0]->slug ) ) : ?>
            <aside class="sidebar col-sm-4">
                <?php dynamic_sidebar( 'sidebar_'. $category[0]->slug ); ?>
            </aside><!-- .sidebar -->
        <?php endif; ?>


    </div><!-- .row -->
</section><!-- .container -->
<?php endwhile; ?>





<?php get_footer(); ?>
