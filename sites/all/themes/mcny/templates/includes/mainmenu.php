<?php if($page['search']): ?>
<div class="row">
    <div class="container">
        <div class="col-lg-12" id="search_container">
            <?php echo render($page['search']); ?>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <div class="container">
        <div class="main-menu-container">
            <!-- Logo -->
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-8 pull-left no-padding logo-section">
                <div class="left logo-margin">
                    <a href="http://mcny.org/">
                        <img src="<?php echo $logo; ?>" class="logo">
                    </a>
                </div>
                <div class="left logo-text">
                    <a href="<?php echo base_path(); ?>"><img src="<?php echo base_path().path_to_theme(); ?>/public/images/logo-text.png" class="New York Activist" /></a>
                </div>
                <div class="clear"></div>
            </div>
            <!-- /Logo -->

            <!-- Toggle Button -->
            <div class="col-sm-1 col-md-1 col-xs-4 pull-right no-padding visible-xs">
                <div class="navbar-header">
                    <button id="navbar-toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
                        <span class="fa fa-navicon fa-3x"></span>
                    </button>
                    <div class="search-button">
                        <a href="javascript:void(0);" class="search_icon"><img class="" src="<?php echo base_path().path_to_theme(); ?>/public/images/search-ico.png" /></a>
                        <div id="mobile_search_form">
                            <a id="search_close" href="javascript:void(0);">X</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- /Toggle Button -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 no-padding text-center navigation">

                <!-- Social Icons (For Large Screen) -->
                <div id="social-links-container" class="social-links hidden-xs text-right no-padding pull-right">
                    <div class="social-items">
                        <ul>
                            <li><a href="javascript:void(0);"><img class="search_icon" src="<?php echo base_path().path_to_theme(); ?>/public/images/search-ico.png" /></a></li>
                            <li class="hidden-xs"><a href="https://twitter.com/museumofcityny" target="_blank"><span class="fa fa-twitter"></span></a></li>
                            <li class="hidden-xs"><a href="https://www.facebook.com/museumofcityny" target="_blank"><span class="fa fa-facebook"></span></a></li>
                        </ul>

                        <div class="clearfix"></div>
                    </div>

                </div>
                <!-- /Social Icons -->

                <div id="main-menu" class="collapse navbar-collapse">
                    <?php
                    echo theme('links__system_main_menu', array(
                        'links' => $main_menu_expanded,
                        'attributes' => array(
                            'id' => 'main-menu',
                            'class' => array('nav', 'navbar-nav'),
                        ),
                        'heading' => array(
                            'text' => t('Main menu'),
                            'level' => 'h2',
                            'class' => array('element-invisible'),
                        ),
                    ));
                    ?>
                    <div id="social-links-container" class="hidden-md hidden-lg hidden-sm">
                        <div class="heading text-left ">
                            <h2>Follow Us On:</h2>
                        </div>
                        <div class="text-center">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <a href="https://twitter.com/museumofcityny" class="" target="_blank">
                                    <span class="fa fa-twitter fa-2x text-black"></span>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <a href="https://www.facebook.com/museumofcityny" class="" target="_blank">
                                    <span class="fa fa-facebook fa-2x text-black"></span>
                                </a>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>

                </div>
            </div>
            <!-- /.navbar-collapse -->

            <div class="clearfix"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.search_icon').click(
        function(){
            //$('#search_container').animate({height: "toggle"}, 1000);
            $('#search_container').slideToggle();
        }
    );
</script>