<?php include_once('includes/mainmenu.php'); ?>

<?php include_once('includes/breadcrumb-lesson-plans.php'); ?>

    <!-- Lesson Plans -->
    <div class="row student-program-page">
        <div class="container page-content-text exhibition-container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding page-description">
                <?php
                $taxonomy = taxonomy_get_term_by_name('lesson plans');
                $taxonomy = reset($taxonomy);
                echo ($taxonomy && !empty($taxonomy->description)) ? $taxonomy->description : '';
                ?>
            </div>

            <div class="programs-container lesson-plans col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">

                <div class="col-lg-12 no-padding">
                    <?php include_once("includes/lesson-plans-categories.tpl.php"); ?>
                    <?php include_once("includes/lesson-plans-detail.tpl.php"); ?>
                </div>

            </div>
        </div>
    </div>
    <!-- /Lesson Plans -->

<?php include_once('includes/social-bar.php'); ?>

<?php include_once('includes/footer.php'); ?>