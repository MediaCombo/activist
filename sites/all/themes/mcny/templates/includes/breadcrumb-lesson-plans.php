<?php
    $taxonomyLessonPlans = taxonomy_get_term_by_name('lesson plans');
    $taxonomyLessonPlans = reset($taxonomyLessonPlans);
?>
<div class="row visible-lg visible-md visible-sm visible-xs">
    <div class="container">
        <div class="col-lg-12 no-padding-lr">
            <div class="breadcrumb default-padding no-borders no-border-radius">
                <div class="active active-page-title-margin"><?php //print $title; ?>CLASSROOM</div>
                <div class="breadcrumb-buttons-container class-rooms-breadcrumb">
                    <!-- Class Room Labels -->
                    <?php
                        $arrClassrooms = mcny_get_taxonomy_options('class_room_category');
                        foreach($arrClassrooms as $l): $label = $l['data']; ?>
                            <a href="<?php echo base_path().mcny_get_taxonomy_url($label); ?>"
                               class="btn btn-default no-border-radius btn-breadcrumb <?php if(!arg(2) && $label->tid==arg(2)) { echo 'active 1'; } elseif(!arg(3) && $taxonomyLessonPlans->tid == $label->tid) { echo 'active 2'; } elseif($taxonomyLessonPlans->tid == $label->tid && drupal_get_path_alias('node/'.arg(1)) == 'see-all-lesson-plans') { echo 'active'; } ?>">
                                <?php echo $label->name; ?>
                            </a>
                        <?php endforeach; ?>
                    <!-- / Class Room Labels -->
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .btn-share { margin-left: 0; }
    .footer { margin: 0; }
    @media only screen and (max-width: 480px) {
        .breadcrumb .btn-breadcrumb {
            width: 220px !important;
        }
    }
</style>