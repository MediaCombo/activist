<?php
    $arg = arg(2);
    $taxonomy = (isset($arg)) ? taxonomy_term_load($arg) : null;
?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 lesson-plans-detail-container">
    <div class="lesson-plans-category-information">
        <div class="name">
            <?php echo ($taxonomy && $arg && !empty($taxonomy->name)) ? $taxonomy->name : $title; ?>
        </div>
        <div class="description">
            <?php echo ($taxonomy && $arg && !empty($taxonomy->description)) ? $taxonomy->description : ''; ?>
            <?php echo (!$taxonomy && !$arg && !empty($node->body['und'][0]['value'])) ? $node->body['und'][0]['value'] : ''; ?>
        </div>
    </div>
    <div class="lesson-plan-posts">
        <?php
        $tid = (!empty($taxonomy->tid)) ? $taxonomy->tid : null;
        foreach(mcny_get_lesson_plans($tid) as $lesson): ?>
        <div class="post">
            <div class="image left">
                <img src="<?php echo image_style_url('lesson_plans_thumbnail', $lesson->field_lesson_plan_image['und'][0]['uri']) ?>"
                     alt="<?php echo $lesson->field_lesson_plan_image['und'][0]['alt'] ?>"
                     title="<?php echo $lesson->field_lesson_plan_image['und'][0]['title'] ?>">
            </div>
            <div class="information left">
                <div class="title"><?php echo $lesson->field_lesson_plan_title['und'][0]['value']; ?></div>
                <div class="caption"><?php echo (!empty($lesson->field_lesson_plan_sub_title['und'][0]['value'])) ? $lesson->field_lesson_plan_sub_title['und'][0]['value'] : ''; ?></div>
                <div class="download">
                    <a href="<?php echo file_create_url($lesson->field_lesson_plan_file['und'][0]['uri']); ?>" title="Download">
                        <img src="<?php echo base_path().drupal_get_path('theme', 'mcny'); ?>/public/images/icon-download.png">
                    </a>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <?php endforeach; ?>
    </div>
</div>