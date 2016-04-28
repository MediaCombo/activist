
<?php include_once('includes/mainmenu.php'); ?>

<!-- Page Header -->
<div class="row visible-lg visible-md visible-sm visible-xs">
    <div class="container">
        <div class="col-lg-12 no-padding-lr">
            <?php
                $taxonomyPageCategory = taxonomy_term_load($node->field_exhibition_category['und'][0]['tid']);

                $arrTaxonomyPageCategory = explode('/', mcny_get_taxonomy_url($taxonomyPageCategory));
                $taxonomyPageCategoryUrl = $arrTaxonomyPageCategory[1];

                $taxonomyPageLabel = taxonomy_term_load($node->field_exhibition_label['und'][0]['tid']);
                $hasLabel = (strtolower($taxonomyPageLabel->name) == 'from the archive' || strtolower($taxonomyPageLabel->name) == 'coming soon') ? true : false;
            ?>
            <div class="breadcrumb exhibition-breadcrumb bg-green-tree no-borders no-border-radius ribbon-container case-study-breadcrumb" style="background-color: <?php echo $taxonomyPageCategory->field_exhibition_category_color['und'][0]['rgb']; ?> !important;">
                <!-- Taxonomy Page Category -->
                <div class="page-category">
                    <div class="icon left">
                        <img id="case-study-category-icon" src="<?php echo image_style_url('case_study_category_icon', $taxonomyPageCategory->field_exhibition_category_icon['und'][0]['uri']); ?>">
                    </div>
                    <div id="case-study-category-name" class="title left">
                        <h3>
                            <a href="<?php echo base_path(); ?>exhibitions">
                                <?php echo $taxonomyPageCategory->name; ?>
                            </a>
                        </h3>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- /Taxonomy Page Category -->

                <div id="case-study-page-title" class="<?php echo ($hasLabel) ? 'active-page-title-with-label' : ''; ?>">
                    <span class="active">
                        <?php echo (!empty($node->field_exhibition_title['und'][0]['value'])) ? $node->field_exhibition_title['und'][0]['value'] : ''; ?>
                    </span>
                    <span class="exhibition-title">
                        <?php echo (!empty($node->field_exhibition_sub_title['und'][0]['value'])) ? $node->field_exhibition_sub_title['und'][0]['value'] : ''; ?>
                        <?php echo (!empty($node->field_exhibition_case_study_date['und'][0]['value'])) ? $node->field_exhibition_case_study_date['und'][0]['value'] : ''; ?>
                    </span>
                </div>


                <!-- / Case Study Categories -->

                <!-- Case Study Ribbon (Header) -->
                <?php if(strtolower($taxonomyPageLabel->name) == 'from the archive' || strtolower($taxonomyPageLabel->name) == 'coming soon'): ?>
                <div id="ribbon-1" class="ribbon bg-green-tree-light visible-lg visible-md"
                     style="background-color: <?php echo (!empty($taxonomyPageCategory->field_exhibition_category_bg['und'][0]['rgb'])) ? $taxonomyPageCategory->field_exhibition_category_bg['und'][0]['rgb'] : '#ccc'; ?> !important;">
                    <div class="node-label">
                       <?php echo $taxonomyPageLabel->name; ?>
                    </div>
                    <div class="node-date">
                        <?php echo (!empty($node->field_exhibition_ribbon_caption['und'][0]['value'])) ? $node->field_exhibition_ribbon_caption['und'][0]['value'] : ''; ?>
                    </div>
                </div>
                <?php endif; ?>
                <!-- /Case Study Ribbon (Header) -->

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Header -->

<!-- Case Study Banner -->
<div class="row">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding-lr overflow-hidden">
            <img class="img-responsive" src="<?php echo image_style_url('banner_image', $node->field_exhibition_banner['und'][0]['uri']); ?>" title="<?php echo $node->field_exhibition_banner['und'][0]['title']; ?>" alt="<?php echo $node->field_exhibition_banner['und'][0]['alt']; ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="container">
    <!-- Case Study Ribbon (For Small Screens) -->

        <div id="ribbon-2" class="ribbon-mobile visible-xs visible-sm"
             style="background-color: <?php echo (!empty($taxonomyPageCategory->field_exhibition_category_bg['und'][0]['rgb'])) ? $taxonomyPageCategory->field_exhibition_category_bg['und'][0]['rgb'] : '#ccc'; ?> !important;">
            <?php $taxonomyPageLabel = taxonomy_term_load($node->field_exhibition_label['und'][0]['tid']); ?>
            <?php if(strtolower($taxonomyPageLabel->name) == 'from the archive' || strtolower($taxonomyPageLabel->name) == 'coming soon'): ?>
            <div class="ribbon-data">
                <div class="node-label">
                    <?php echo $taxonomyPageLabel->name; ?>
                </div>
                <div class="node-date">
                    <?php echo (!empty($node->field_exhibition_ribbon_caption['und'][0]['value'])) ? $node->field_exhibition_ribbon_caption['und'][0]['value'] : ''; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="pull-right">
                <a href="<?php echo base_path(); ?>class-room/lesson-plans/<?php echo $taxonomyPageCategoryUrl; ?>" class="btn btn-default no-border-radius btn-breadcrumb btn-lessons transparent visible-sm visible-xs">
                    Lessons Plans
                </a>
            </div>
        </div>

    <!-- /Case Study Ribbon -->
    </div>
</div>
<!-- /Case Study Banner -->

<!-- Content with Right SideBar -->
<div class="row">
    <div class="container page-content case-study-content">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <?php
                $summary = $node->body['und'][0]['summary'];
                $body = $node->body['und'][0]['value'];

                $linkReadMore = '<a href="javascript:;" title="Read More" class="case-study-content-readmore" onclick="showFullContent();">Read More <span class="icon fa fa-chevron-right text-gray"></span></a>';
                $linkReadLess = '<a href="javascript:;" title="Read Less" class="case-study-content-readmore" onclick="showLessContent();">Read Less <span class="icon fa fa-chevron-up text-gray"></span></a>';
                $shortContent = $summary . '... '.$linkReadMore;
            ?>
            <div id="case-study-content-short">
                <p>
                    <?php echo $shortContent; ?>
                </p>
            </div>

            <div id="case-study-content-long" class="hidden">
                <?php echo $body.$linkReadLess;; ?>
            </div>
        </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 announcement hidden-xs hidden-sm">
                <div class="pull-right">
                    <a href="<?php echo base_path(); ?>class-room/lesson-plans/<?php echo $taxonomyPageCategoryUrl; ?>" class="btn btn-default no-border-radius btn-breadcrumb btn-lessons transparent visible-lg visible-md visible-sm" style="background-color: <?php echo $taxonomyPageCategory->field_exhibition_category_color['und'][0]['rgb']; ?> !important;">
                        Lessons
                    </a>
                </div>
                <?php if($page['sidebar_first']): ?>
                    <?php echo render($page['sidebar_first']); ?>
                <?php endif; ?>
            </div>

    </div>
</div>
<!-- /Content with Right SideBar -->

<?php if($page['exhibition_activists']): ?>
    <!-- Meet the Activists Slider -->
        <div class="row">
            <div class="container">
                <div class="col-lg-12 custom-alignment no-padding-lr">
                    <!-- Meet the Activists -->
                    <a name="activists" id="activists"></a>
                    <div class="visible-lg activist-shadow"></div>
                    <?php echo render($page['exhibition_activists']); ?>
                </div>
            </div>
        </div>
    <!-- /Meet the Activists Slider -->
<?php endif; ?>

<?php if($page['exhibition_objects']): ?>
    <a name="objects_and_images" id="objects_and_images"></a>
    <!-- Objects & Images Slider -->
    <div class="row">
        <div class="container padding-bottom-40">
            <div class="col-lg-12 custom-alignment no-padding-lr">
                <!-- Objects and images -->
                <?php echo render($page['exhibition_objects']); ?>
            </div>
        </div>
    </div>
    <!-- /Objects & Images Slider -->
<?php endif; ?>

<!-- Time line -->
<?php if($page['exhibition_timeline']): ?>
    <a name="timeline"></a>
    <div class="row visible-lg">
        <?php echo render($page['exhibition_timeline']); ?>
    </div>

    <!-- For Small Screens -->
    <?php $timelineData = mcny_get_timeline_casestudy(arg(1)); ?>
    <div class="row visible-md visible-sm visible-xs">
        <div class="container exhibition-timeline timeline-small">

            <!-- For Small Screens -->
            <div class="timeline-container col-xs-12 col-md-12 col-sm-12">

                <div class="timeline-data padding-top-15">
                    <div class="row text-left">
                        <h1>Key Events</h1>
                    </div>
                    <div class="seprator">
                        <span class="sep-top"></span>
                        <span class="sep-bottom"></span>
                    </div>
                    <div class="row">
                        <?php
                        $timeline_items = 0;
                        $timeline_date = '';
                        $timeline_side = '';
                        $timeline_date_class = '';
                        foreach($timelineData as $timeline):
                            $timeline_items++;
                            if (empty($timeline_date)) {
                                $timeline_date = $timeline->field_timeline_year['und'][0]['value'];
                                $timeline_side = $timeline->field_timeline_type['und'][0]['value'];
                            } else if ($timeline_date == $timeline->field_timeline_year['und'][0]['value'] && $timeline_side == $timeline->field_timeline_type['und'][0]['value']) {
                                $timeline_date_class = 'not-visible';
                            } else {
                                $timeline_date = $timeline->field_timeline_year['und'][0]['value'];
                                $timeline_side = $timeline->field_timeline_type['und'][0]['value'];
                                $timeline_date_class = '';
                            }

                            if($timeline_items == 9){
                                echo '
                                    <div class="more-timeline-items-resp">
                                ';
                            }
                            ?>
                            <div class="timeline-row">
                                <div class="item-a">
                                    <?php
                                    if($timeline->field_timeline_type['und'][0]['value'] == 'Left Side') {
                                        ?>
                                        <span class="year date-display-single <?php echo $timeline_date_class; ?>">
                                        <?php
                                            $year = explode('-', $timeline->field_timeline_year['und'][0]['value']);
                                            echo $year[0];
                                        ?>
                                    </span>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="item-b">
                                    <?php
                                    if($timeline->field_timeline_type['und'][0]['value'] == 'Right Side') {
                                        ?>
                                        <span class="year date-display-single <?php echo $timeline_date_class; ?>">
                                        <?php
                                            $timeline_year = explode('-',
                                                $timeline->field_timeline_year['und'][0]['value']);
                                            echo $timeline_year[0];
                                        ?>
                                    </span>
                                        <?php
                                    }
                                    ?>
                                    <span class="description">
                                        <?php echo $timeline->field_timeline_title['und'][0]['value']; ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php
                        if($timeline_items >= 9){
                            echo '
                                </div>
                                <a href="javascript:void(0);" id="more_timeline_responsive" class="timeline-more"></a>
                            ';
                        }
                        ?>
                    </div>
                </div>

                <div class="clear"></div>
            </div>
            <!-- /For Small Screens -->
        </div>
    </div>
    <!-- /For Small Screens -->

<?php endif; ?>
<!-- /Time line -->

<?php include_once('includes/social-bar.php'); ?>

<?php include_once('includes/footer.php'); ?>

<style type="text/css">
    .timeline-wrapper,.exhibition-timeline,.exhibition-breadcrumb select {
        background-color: <?php echo (!empty($taxonomyPageCategory->field_exhibition_category_bg['und'][0]['rgb'])) ? $taxonomyPageCategory->field_exhibition_category_bg['und'][0]['rgb'] : '#ccc'; ?> !important;
    }
    .modal-header.default {
        background-color: <?php echo (!empty($taxonomyPageCategory->field_exhibition_category_color['und'][0]['rgb'])) ? $taxonomyPageCategory->field_exhibition_category_color['und'][0]['rgb'] : '#ccc'; ?> !important;
    }
    .icon-audio-series-overlap, .icon-audio-series-overlap a {
        color: <?php echo (!empty($taxonomyPageCategory->field_exhibition_category_bg['und'][0]['rgb'])) ? $taxonomyPageCategory->field_exhibition_category_bg['und'][0]['rgb'] : '#ccc'; ?> !important;
    }
    .icon-audio-series-overlap:hover, .icon-audio-series-overlap a:hover {
        color: <?php echo (!empty($taxonomyPageCategory->field_exhibition_category_color['und'][0]['rgb'])) ? $taxonomyPageCategory->field_exhibition_category_color['und'][0]['rgb'] : '#ccc'; ?> !important;
    }
    #mcny-modal-wrapper-video-back a {
        color: <?php echo (!empty($taxonomyPageCategory->field_exhibition_category_color['und'][0]['rgb'])) ? $taxonomyPageCategory->field_exhibition_category_color['und'][0]['rgb'] : '#ccc'; ?> !important;
        text-decoration: none;
    }
    #mcny-modal-wrapper-video-back a:hover {
        color: <?php echo (!empty($taxonomyPageCategory->field_exhibition_category_bg['und'][0]['rgb'])) ? $taxonomyPageCategory->field_exhibition_category_bg['und'][0]['rgb'] : '#ccc'; ?> !important;
    }
</style>

<script type="text/javascript">
    function showFullContent(){
        $("#case-study-content-short").addClass('hidden');
        $("#case-study-content-long").removeClass('hidden');
        $("#case-study-content-long").slideDown();
    }

    function showLessContent(){
        $("#case-study-content-long").addClass('hidden');
        $("#case-study-content-short").removeClass('hidden');
        $("#case-study-content-short").slideDown();
        $("html, body").animate({ scrollTop: "300px" });
    }

    $('#more_timeline_responsive').click(
        function(){
             $('.more-timeline-items-resp').slideToggle('fast', function()
             {
                 if($('#more_timeline_responsive').hasClass('timeline-more')) {
                     $('#more_timeline_responsive').removeClass('timeline-more').addClass('timeline-less');
                 } else {
                     $('#more_timeline_responsive').removeClass('timeline-less').addClass('timeline-more');
                 }
             });
        }
    );
    $(".case-study-breadcrumb .dropdown-menu li a").click(function(){
        var selText = $(this).text();
        $('#selected').text(selText);
    });
    $('.timeline-wrapper .view-content > .item-row').last().addClass('timeline-padding-last');
    $('.timeline-wrapper .item-row').last().addClass('timeline-padding-last');
</script>