<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 categories">
    <div class="heading">LESSON PLAN TOPICS:</div>
    <div class="categories-list">
        <?php $count = 0; foreach(mcny_get_taxonomy_options_lesson_plans('lesson_plans_category') as $arrCategory): $category = $arrCategory['data']; ?>
            <div id="category-<?php echo $count; ?>" class="category <?php echo (arg(2) == $category->tid) ? 'active' : ''; ?>">
                <a href="<?php echo base_path().mcny_get_taxonomy_url($category); ?>">
                    <div class="image">
                        <img src="<?php echo image_style_url('lesson_plans_category', $category->field_lesson_plan_category_image['und'][0]['uri']); ?>">
                    </div>
                    <div class="name">
                        <?php echo $category->name; ?>
                    </div>
                    <div class="clear"></div>
                </a>
            </div>
        <?php $count ++; endforeach; ?>

        <div class="category-list-link">
            <a id="btnShowAllLessonPlans"
               href="<?php echo base_path(); ?>see-all-lesson-plans"
               title="Show All Lesson Plans" class="<?php echo (!empty($node->nid) && drupal_get_path_alias('node/'.$node->nid) == 'see-all-lesson-plans') ? 'active' : ''; ?>">
                See All Lesson Plans
            </a>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".category").each(function(idx, v){
        console.log(idx);
        if(idx > 6){
            $(v).hide();
        }
    });
</script>