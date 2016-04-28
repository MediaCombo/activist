<?php
    $categoryId = $row->field_field_banner_case_study[0]['raw']['entity']->field_exhibition_category['und'][0]['tid'];
    $category = taxonomy_term_load($categoryId);

    $caseStudy = $row->field_field_banner_case_study[0]['raw']['entity'];

    $heading = (!empty($row->field_field_banner_heading[0])) ? $row->field_field_banner_heading[0]['raw']['value'] : '';
    if (empty($heading)) {
        $heading = $category->name;
    }

    $title = (!empty($row->field_field_banner_title[0])) ? $row->field_field_banner_title[0]['raw']['value'] : '';
    if (empty($title)) {
        $title = $caseStudy->field_exhibition_title['und'][0]['value'];
    }

    $caption = (!empty($row->field_field_banner_caption[0])) ? $row->field_field_banner_caption[0]['raw']['value'] : '';
    if (empty($caption)) {
        $caption = $caseStudy->field_exhibition_sub_title['und'][0]['value'] . ' ' . $caseStudy->field_exhibition_case_study_date['und'][0]['value'];
    }

    $image = $category->field_exhibition_category_icon['und'][0]['uri'];

    $categoryBackgroundColor = $category->field_exhibition_category_color['und'][0]['rgb'];

    if(empty($categoryBackgroundColor)) {
        $categoryBackgroundColor = '#e4c842';
    }

    $categoryBackgroundOpacity = (!empty($row->field_field_banner_background_opacity)) ? $row->field_field_banner_background_opacity[0]['raw']['value'] : '0.9';

    $autoSetBlockHeight = '';
    if (empty($title) && empty($caption) && empty($image)) {
        $autoSetBlockHeight = 'height: 90px; bottom: 80px;';
    }

    $bannerImage = (isset($row->field_field_banner_image[0])) ? $fields['field_banner_image']->content : '';
    if(empty($bannerImage)){
        $bannerImagePath = image_style_url('banner_image', $row->field_field_banner_case_study[0]['raw']['entity']->field_exhibition_banner['und'][0]['uri']);
        $bannerImage = '<img src="'.$bannerImagePath.'">';
    }

    $bannerLink = (!empty($row->field_field_banner_link[0]['raw']['value'])) ? $row->field_field_banner_link[0]['raw']['value'] : '';
    if(empty($bannerLink)){
        $bannerLink = drupal_lookup_path('alias', 'node/'.$caseStudy->nid);
    }
?>

<div class="image">
    <?php if(!empty($bannerLink)): ?>
        <a href="<?php echo $bannerLink; ?>">
            <?php echo $bannerImage; ?>
        </a>
    <?php else: ?>
        <?php echo $bannerImage; ?>
    <?php endif; ?>
</div>

<?php if(!empty($bannerLink)): ?>
    <a href="<?php echo $bannerLink; ?>" class="banner-box-ink">
<?php endif; ?>

<div class="carousel-information <?php echo (strtolower($row->field_field_banner_text_position[0]['raw']['value']) == 'right') ? 'show-on-right-side' : 'show-on-left-side'; ?>"
     style="<?php echo $autoSetBlockHeight; ?> background-color: <?php echo $categoryBackgroundColor; ?> !important; opacity: <?php echo $categoryBackgroundOpacity; ?> !important;">
    <div class="heading">
        <?php echo (strlen($heading) > 30) ? substr($heading, 0, 30) . '...' : $heading; ?>
    </div>
    <?php
        /*if(!empty($row->_field_data['nid']['entity']->field_show_overlay) && $row->_field_data['nid']['entity']->field_show_overlay['und'][0]['value']) :*/
    ?>
    <?php if((!empty($title) || !empty($caption) || !empty($image)) && ($row->_field_data['nid']['entity']->field_show_overlay['und'][0]['value'])): ?>
    <div class="detail">
        <div class="image left">
            <img src="<?php echo image_style_url('banner_icon', $image); ?>">
        </div>
        <div class="text-container left">
            <div class="title ellipsis ellipsis-banner-title">
                <div class="visible-xs visible-lg visible-md visible-sm"><?php echo $title; ?></div>
            </div>
            <div class="description ellipsis ellipsis-banner-subtitle">
                <?php echo $caption; ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <?php endif; ?>
</div>


<?php if(!empty($bannerLink)): ?>
    </a>
<?php endif; ?>