<?php
$objects = mcny_objects_get_exhibition(arg(1));
$totalSlides = $objects['total_slides'];
?>

<?php if ($totalSlides >= 1): ?>
    <div class="row">
        <div class="case-study-activists">
            <?php
            $classSlider = ($totalSlides > 1) ? '' : '';
            $classSliderContainer = ($totalSlides <= 1) ? 'fixedWidth' : '';
            ?>
            <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 objects-slides">
                <ul id="bxslider-objects" class="bxslider">
                    <?php
                    $i = 0;
                    $count = 0;
                    $previousId = 0;
                    $iNext = $i + 1;
                    $keys = array_keys($objects['nodes']);
                    foreach ($objects['nodes'] as $object): ?>
                        <li class="col-lg-3 col-sm-12 col-md-12 col-xs-12 no-padding-lr">
                            <a href="javascript:;" class="mcny-modal-objects"
                               data-id="<?php echo $object->nid ?>"
                               data-id-next="<?php echo $keys[$iNext]; ?>"
                               data-id-previous="<?php echo $previousId; ?>">
                                <?php
                                    $hasObjectThumbnail = (!empty($object->field_object_thumbnail_image['und'][0]['uri'])) ? true : false;
                                    $objectThumbnail = image_style_url('activist_thumbnail', $object->field_object_image['und'][0]['uri']);
                                    $imageTitle = $object->field_object_image['und'][0]['title'];
                                    $imageAlt = $object->field_object_image['und'][0]['alt'];
                                    if($hasObjectThumbnail){
                                        $objectThumbnail = image_style_url('case_study_object_thumbnail', $object->field_object_thumbnail_image['und'][0]['uri']);
                                        $imageTitle = $object->field_object_thumbnail_image['und'][0]['title'];
                                        $imageAlt = $object->field_object_thumbnail_image['und'][0]['alt'];
                                    }
                                ?>
                                <img src="<?php echo $objectThumbnail; ?>" title="<?php echo $imageTitle; ?>" alt="<?php echo $imageAlt; ?>">
                                <?php
                                    if(isset($object->field_object_audio_file['und'])) {
                                        echo '<span class="fa fa-play fa-3x object-slider-icon"></span>';
                                    } else if(isset($object->field_object_video_file['und'])) {
                                        echo '<span class="fa fa-play-circle fa-3x object-slider-icon"></span>';
                                    }
                                ?>
                            </a>
                        </li>
                        <?php
                        $i++;
                        $iNext++;
                        if ($count >= 0) {
                            $previousId = $object->nid;
                        }
                        $count++;
                    endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php mcny_modal_init_template(); ?>
<?php endif; ?>