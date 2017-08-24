




(function ($)
{





    // Equal title heights
    
    $(function()
    {
        $('.latest-news .post-link:lt(3)').adjustTitleHeight();
    });

    $(window).on('resize', function()
    {
        $('.latest-news .post-link:lt(3)').adjustTitleHeight();
    });





    // More tags
    
    $(function()
    {
        $('.more-tags').hide();
        $('.show-more-tags').on('click', function(event)
        {
            event.preventDefault();

            $('.more-tags').slideToggle();
        });
    });





    // Align large image

    $(window).load(function()
    {
        $('.fixed-grid .posts').alignLargeImage();
    });

    $(window).on('resize', function()
    {
        $('.fixed-grid .posts').alignLargeImage();
    });





    // Back button
    
    $(function()
    {
        $('.back-button').backButton();
    });





    // Fixed navigation
    
    /*
    $(window).load(function()
    {
        $('.nav').fixedNav();
    });

    $(window).on('resize', function()
    {
        $('.nav').fixedNav();
    });
    */





}) (jQuery);





/* ------------------------------ *\
 * adjustTitleHeight
\* ------------------------------ */

(function ($)
{
    $.fn.adjustTitleHeight = function ()
    {
        var largestHeight = 0;
        var $titles = $(this).find('.title');
        var $title_links = $titles.find('a');

        if ( $(window).innerWidth() >= 768 )
        {
            $title_links.each( function()
            {
                if ( $(this).height() > largestHeight )
                {
                    largestHeight = $(this).height();
                }
            });
            
            $titles.height( largestHeight );
        }
        else
        {
            $titles.height( 'auto' );
        }

        return this;
    }
}) (jQuery);





/* ------------------------------ *\
 * alignLargeImage
\* ------------------------------ */

(function ($)
{
    $.fn.alignLargeImage = function ()
    {
        $(this).each(function()
        {
            var $this = $(this);
            var $postLink = $this.find('.post-link');

            var totalHeight;
            var largestTopHeight = 0;
            var largestBottomHeight = 0;
            

            // Top two links height
            
            $postLink.slice(1,3).each(function()
            {
                var currentHeight = $(this).outerHeight();

                if ( largestTopHeight <= currentHeight )
                {
                    largestTopHeight = currentHeight;
                }
            });


            // Bottom two images height

            $postLink.slice(-2).each(function()
            {
                var currentHeight = $(this).find('.wp-post-image').outerHeight();

                if ( largestBottomHeight <= currentHeight )
                {
                    largestBottomHeight = currentHeight;
                }
            });


            // Apply total height
            
            totalHeight = largestTopHeight + largestBottomHeight;

            $this.find('.post-link').first().find('.thumb-link').height( totalHeight );
        });
    }
}) (jQuery);





/* ------------------------------ *\
 * Back button
\* ------------------------------ */

(function ($)
{
    $.fn.backButton = function ()
    {
        $(this).on('click', function(event)
        {
            event.preventDefault();

            window.history.back();
        });
    }
}) (jQuery);





/* ------------------------------ *\
 * Fixed nav
\* ------------------------------ */

(function ($)
{
    $.fn.fixedNav = function ()
    {
        var $this = $(this);
        var height = $this.height() - 1;

        $this.addClass('fixed');

        $this.next().css( 'margin-top', height );
    }
}) (jQuery);
