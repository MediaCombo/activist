<!-- Exhibition -->
<div class="row">
    <div class="container page-content exhibition-container">
        <div class="col-lg-12 exhibition-categories-container">
            <!-- Exhibition Categories -->
            <?php
                $imageDir = base_path().'sites/default/files/exhibition-category/';
                foreach(mcny_get_taxonomy_options('exhibition_category', arg(2)) as $term): $t = $term['data'];
                    if($term['total'] < 1)
                        continue;
                ?>

                <div class="col-lg-6 col-md-6 exhibition no-padding">

                    <!-- Exhibition Category Information -->
                    <div class="col-lg-12">
                        <div class="category-icon text-left left">
                            <img src="<?php echo image_style_url('exhibition_category_icon', $t->field_exhibition_category_icon['und'][0]['uri']); ?>">
                        </div>
                        <div class="category-name text-left" style="color: <?php echo $t->field_exhibition_category_color['und'][0]['rgb']; ?> !important;">
                            <?php echo $t->name; ?>
                        </div>
                        <a name="<?php echo htmlentities($t->name); ?>"></a>
                        <div class="clear"></div>
                    </div>
                    <div class="col-lg-12 category-description">
                        <?php echo (strlen($t->description) > 575) ? substr($t->description, 0, 575).'...' : strip_tags($t->description); ?>
                    </div>
                    <!-- / Exhibition Category Information -->

                    <div class="col-lg-12">
                        <div class="col-lg-12 no-padding">
                            <!-- Exhibition Posts -->
                            <?php
                            foreach(mcny_get_exhibition_nodes_by_term_organized($t, arg(2)) as $currentNode):?>
                                <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12 exhibition-post no-padding">
                                    <a href="<?php echo base_path() . drupal_lookup_path('alias', "node/" . $currentNode['node']->nid); ?>"
                                       title="<?php
                                           echo $currentNode['node']->field_exhibition_title['und'][0]['value']; ?>">
                                    <div id="node-<?php echo $currentNode['node']->nid; ?>"
                                         class="image margin-bottom-10 ribbon-container">

                                        <?php if(strtolower($currentNode['label']->name) == 'from the archive' || strtolower($currentNode['label']->name) == 'coming soon'): ?>
                                            <div id="ribbon-<?php echo $currentNode['node']->nid; ?>"
                                                 style="background-color: <?php echo (!empty($currentNode['label']->field_exhibition_label_bg_color['und'][0]['rgb'])) ? $currentNode['label']->field_exhibition_label_bg_color['und'][0]['rgb'] : '#fff'; ?> " class="ribbon no-link-background">
                                                <span>
                                                    <?php echo $currentNode['label']->name; ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                            <img class="cursor"
                                                 src="<?php echo image_style_url('exhibition_thumbnail', $currentNode['node']->field_exhibition_banner['und'][0]['uri']); ?>"
                                                 title="<?php echo $currentNode['node']->field_exhibition_banner['und'][0]['title']; ?>"
                                                 alt="<?php echo $currentNode['node']->field_exhibition_banner['und'][0]['alt']; ?>">
                                    </div>
                                    <div class="title block-ellipsis ellipsis-exhibition-title">

                                            <?php echo (strlen($currentNode['node']->field_exhibition_title['und'][0]['value']) > 45) ? substr($currentNode['node']->field_exhibition_title['und'][0]['value'], 0, 45).'...' : trim($currentNode['node']->field_exhibition_title['und'][0]['value']); ?>

                                    </div>
                                    <div class="description">
                                        <div class="ellipsis ellipsis-exhibition-description">
                                            <?php
                                                $description = trim(strip_tags($currentNode['node']->field_exhibition_sub_title['und'][0]['value']));
                                                //echo (strlen($description) > 25) ? substr($description, 0, 25) . '..' : $description;
                                                echo $description;
                                            ?>
                                        </div>
                                        <div class="ellipsis ellipsis-exhibition-date">
                                            <?php
                                                $caseStudyDate = trim(strip_tags($currentNode['node']->field_exhibition_case_study_date['und'][0]['value']));
                                                //echo (strlen($caseStudyDate) > 25) ? substr($caseStudyDate, 0, 25) . '..' : $caseStudyDate;
                                                echo $caseStudyDate;
                                            ?>
                                        </div>
                                    </div>
                                        </a>
                                    <div class="clear"></div>
                                </div>
                            <?php endforeach; ?>
                            <!-- / Exhibition Posts -->
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            <?php endforeach; ?>
            <!-- / Exhibition Posts -->
        </div>
    </div>
</div>
<!-- / Exhibition -->

<script type="text/javascript">
    $(document).ready(function(){
       /*
        // Disable grayscale to show with colors on post mouse hover
        $(".exhibition-post>.image").mouseover(function(){
            var id = $(this).attr('id');
            $("#"+id+">a>img").addClass("grayscale-disable");
            $("#"+id+">.ribbon").addClass("grayscale-disable");
        });
        // Enable grayscale when user mouseout from the post
        $(".exhibition-post>.image").mouseout(function(){
            var id = $(this).attr('id');
            $("#"+id+">a>img").removeClass("grayscale-disable");
            $("#"+id+">.ribbon").removeClass("grayscale-disable");
        });
        */
    });
</script>