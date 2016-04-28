<?php include_once('includes/mainmenu.php'); ?>

<?php include_once('includes/breadcrumb-class-room.php'); ?>

    <style type="text/css">
        .btn-share { margin-left: 0; }
        .footer { margin: 0; }
        @media only screen and (max-width: 480px) {
            .breadcrumb .btn-breadcrumb {
                width: 220px !important;
            }
        }
    </style>

    <!-- Lesson Plans -->
    <div class="row student-program-page">
        <div class="container page-content-text exhibition-container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding page-description">
                <?php
                $arg = arg(2);
                $taxonomy = (isset($arg)) ? taxonomy_term_load($arg) : null;
                echo ($taxonomy && $arg && !empty($taxonomy->description)) ? $taxonomy->description : '';

                // Redirect to first lesson plan category automatically
                mcny_redirect_to_first_lesson_plan_category();
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