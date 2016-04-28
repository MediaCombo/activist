<?php
$activists = mcny_modal_get_activists_by_exhibition(arg(1));
$totalSlides = $activists['total_slides'];
?>

<?php if ($totalSlides >= 1): ?>
    <div class="row">
        <div class="case-study-activists">
            <?php $classSliderContainer = ($totalSlides <= 1) ? 'fixedWidth' : ''; ?>
            <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 activist-slides">
                <ul id="bxslider-activists" class="bxslider">
                    <?php
                    $i = 0;
                    $count = 0;
                    $previousId = 0;
                    $iNext = $i + 1;
                    $keys = array_keys($activists['nodes']);
                    foreach ($activists['nodes'] as $activist): ?>
                        <li class="col-lg-3 col-sm-12 col-md-12 col-xs-12 no-padding-lr">
                            <a href="javascript:;" class="mcny-modal"
                               data-id="<?php echo $activist->nid ?>"
                               data-id-next="<?php echo $keys[$iNext]; ?>"
                               data-id-previous="<?php echo $previousId; ?>">
                                <?php
                                    $hasActivistThumbnail = (!empty($activist->field_activist_thumbnail_image['und'][0]['uri'])) ? true : false;
                                    $activistThumbnail = image_style_url('activist_thumbnail', $activist->field_activist_image['und'][0]['uri']);
                                    //$imageTitle = $activist->field_activist_image['und'][0]['title'];
                                    $imageTitle = '';
                                    $imageAlt = $activist->field_activist_image['und'][0]['alt'];
                                    if($hasActivistThumbnail){
                                        $activistThumbnail = image_style_url('case_study_activist_thumbnail',
                                            $activist->field_activist_thumbnail_image['und'][0]['uri']);
                                        //$imageTitle = $activist->field_activist_thumbnail_image['und'][0]['title'];
                                        $imageAlt = $activist->field_activist_thumbnail_image['und'][0]['alt'];
                                    }
                                ?>
                                <img src="<?php echo $activistThumbnail; ?>" title="<?php echo $imageTitle; ?>"
                                     alt="<?php echo $imageAlt; ?>" />
<!--                                <img-->
<!--                                    src="--><?php //echo image_style_url("activist_thumbnail", $activist->field_activist_image['und'][0]['uri']) ?><!--"-->
<!--                                    title="--><?php //echo $activist->field_activist_image['und'][0]['title']; ?><!--"-->
<!--                                    alt="--><?php //echo $activist->field_activist_image['und'][0]['alt']; ?><!--">-->
                            </a>
                            <div class="slider-activist-name">
                                <?php
                                    if(!empty($imageTitle)){
                                        echo $imageTitle;
                                    } else {
                                        echo $activist->field_activist_name['und'][0]['value'];
                                    }
                                ?>
                            </div>
                        </li>
                        <?php
                        $i++;
                        $iNext++;
                        if ($count >= 0) {
                            $previousId = $activist->nid;
                        }
                        $count++;
                    endforeach; ?>
                </ul>
            </div>

        </div>
    </div>
    <?php mcny_modal_init_template(); ?>
<?php endif; ?>