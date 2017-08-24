



<?php get_header(); ?>





<?php while ( have_posts() ): the_post(); ?>
<section class="container">
    <div class="row">

        <article class="content col-xs-12">

                <?php the_content(); ?>

        </article><!-- .content -->


    </div><!-- .row -->
</section><!-- .container -->
<?php endwhile; ?>





<?php get_footer(); ?>
