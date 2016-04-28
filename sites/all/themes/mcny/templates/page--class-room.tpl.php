<?php include_once('includes/mainmenu.php'); ?>

<?php include_once('includes/breadcrumb-class-room.php'); ?>

<!-- Class Room -->
<div class="row class-room-page">
    <div class="container page-content exhibition-container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page-description">
            <?php echo (!empty($node->body['und'][0]['value'])) ? $node->body['und'][0]['value'] : ''; ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php foreach($arrClassrooms as $l): $label = $l['data']; ?>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding category">
                <div class="category-title">
                    <a href="<?php echo base_path().mcny_get_taxonomy_url($label); ?>"><?php echo (strlen($label->name) > 27) ? substr($label->name, 0, 27).'...' :
                        $label->name; ?></a>
                </div>
                <div class="category-image">
                    <a href="<?php echo base_path().mcny_get_taxonomy_url($label); ?>">
                        <img src="<?php echo image_style_url('class_room_thumbnail', $label->field_class_room_category_image['und'][0]['uri']); ?>"
                             alt="<?php echo $label->field_class_room_category_image['und'][0]['alt']; ?>"
                             title="<?php echo $label->field_class_room_category_image['und'][0]['title']; ?>"
                             class="img-responsive">
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- / Class Room -->

<?php include_once('includes/social-bar.php'); ?>

<?php include_once('includes/footer.php'); ?>