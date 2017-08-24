




<footer class="page-footer container">

    <nav class="socials">
        <?php if ( $url = get_option('social_facebook')): ?>
        <a href="<?php echo $url; ?>">
            <span class="fa fa-facebook-square"></span>
            <span class="hidden"><?php _e('Facebook', 'ylt-dev'); ?></span>
        </a>
        <?php endif; ?>
        <?php if ( $url = get_option('social_twitter')): ?>
        <a href="<?php echo $url; ?>">
            <span class="fa fa-twitter-square"></span>
            <span class="hidden"><?php _e('Twitter', 'ylt-dev'); ?></span>
        </a>
        <?php endif; ?>
        <?php if ( $url = get_option('social_google')): ?>
        <a href="<?php echo $url; ?>">
            <span class="fa fa-google-plus-square"></span>
            <span class="hidden"><?php _e('Google+', 'ylt-dev'); ?></span>
        </a>
        <?php endif; ?>
        <?php if ( $url = get_option('social_pinterest')): ?>
        <a href="<?php echo $url; ?>">
            <span class="fa fa-pinterest-square"></span>
            <span class="hidden"><?php _e('Pinterest', 'ylt-dev'); ?></span>
        </a>
        <?php endif; ?>
        <?php if ( $url = get_option('social_linkedin')): ?>
        <a href="<?php echo $url; ?>">
            <span class="fa fa-linkedin-square"></span>
            <span class="hidden"><?php _e('LinkedIn', 'ylt-dev'); ?></span>
        </a>
        <?php endif; ?>
        <?php if ( $url = get_option('social_instagram')): ?>
        <a href="<?php echo $url; ?>">
            <span class="fa fa-instagram"></span>
            <span class="hidden"><?php _e('Instagram', 'ylt-dev'); ?></span>
        </a>
        <?php endif; ?>
    </nav><!-- .social -->

    <?php
    $args = array
    (
        'theme_location'    => 'footer-nav',
        'menu_class'        => 'footer-nav',
        'container'         => 'nav',
        'container_class'   => 'menu-container',
    );

    wp_nav_menu( $args );

    $args = array
    (
        'theme_location'    => 'bottom-nav',
        'menu_class'        => 'bottom-nav',
        'container'         => 'nav',
        'container_class'   => 'menu-container',
    );

    wp_nav_menu( $args );
    ?>

</footer><!-- .page-footer -->





<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>/js/script.js"></script>
<?php wp_footer(); ?>

<script type='text/javascript' src='https://stats.wp.com/e-201649.js' async defer></script>
<script type='text/javascript'>
	_stq = window._stq || [];
	_stq.push([ 'view', {v:'ext',j:'1:4.4.1',blog:'109542598',post:'0',tz:'1',srv:'blog.sketchfab.com'} ]);
	_stq.push([ 'clickTrackerInit', '109542598', '0' ]);
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-22680456-10', 'auto');
  ga('send', 'pageview');

</script>

</body>

</html>
