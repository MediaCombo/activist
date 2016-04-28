
<?php include_once('includes/mainmenu.php'); ?>

<?php include_once('includes/banner-slideshow.php'); ?>

<div class="row">
    <div class="container page-content padding-top-15">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 page-content-sidebar">
            <?php echo render($page['content']); ?>
        </div>
        <?php if(isset($page['sidebar_first'])): ?>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 announcement hidden-xs hidden-sm">
                <?php echo render($page['sidebar_first']); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if($page['homepage_content_bottom']): ?>
    <div class="row">
        <div class="container text-center">
            <div class="col-lg-12">
                <h1 class="heading-larger text-orange margin-bottom-25">
                    <?php echo render($page['homepage_content_bottom']); ?>
                </h1>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="container text-center advertisement-tweet-container">
        <div class="col-lg-6 col-md-6 text-knowledge-container">
            <div class="test-knowledge-overlay-container relative-container">
                <?php if($page['homepage_advertisement']): ?>
                    <?php echo render($page['homepage_advertisement']); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 home-twitter-timeline">
            <div class="twitter-timeline-head">
                <h2>Follow us on twitter</h2>
                <a href="https://twitter.com/hashtag/ActivistNY" class="btn btn-default hash-btn"><i class="fa  fa-twitter fa-2x"></i><span class="btn-txt">#ActivistNY</span></a>
            </div>
            <?php if($page['homepage_twitter_updates']): ?>
                <?php echo render($page['homepage_twitter_updates']); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once('includes/social-bar.php'); ?>

<?php include_once('includes/footer.php'); ?>

<script type="text/javascript">
    jQuery(window).load(
        function(){
            home_image_height = jQuery('.test-knowledge-overlay-container img.img-responsive').height();
            $('#twitter-widget-0').height(home_image_height);
            var head = $('iframe#twitter-widget-0').contents().find('head');
            if (head.length) {
                head.append('<style>.timeline { max-width: 100% !important; width: 100% !important; } .timeline .stream { max-width: none !important; width: 100% !important; }</style>');
            }
            $('#twitter-widget-0').append($('<div class=timeline>'));
        }
    )
</script>