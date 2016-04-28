<?php include_once('includes/mainmenu.php'); ?>

<?php include_once('includes/breadcrumb-class-room.php'); ?>

<style type="text/css">
    .btn-share { margin-left: 0; }
    .footer { margin: 0; }
    @media only screen and (max-width : 480px){
        .breadcrumb .btn-breadcrumb {
            width: 220px !important;
        }
    }
</style>

<!-- Student Programs -->
<div class="row student-program-page">
    <div class="container page-content-text exhibition-container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding page-description">
            <?php
                $arg = arg(2);
                $taxonomy = (isset($arg)) ? taxonomy_term_load($arg) : null;
                echo ($taxonomy && $arg && !empty($taxonomy->description)) ? $taxonomy->description : '';
            ?>
        </div>
        <div class="programs-container col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">

            <?php foreach(mcny_get_student_programs() as $program): ?>
                <div class="program">
                    <div class="image col-lg-4 col-md-4 col-sm-4 col-xs-12 no-padding">
                        <img src="<?php echo image_style_url('student_programs', $program->field_program_image['und'][0]['uri']); ?>"
                             class="img-responsive"
                             alt="<?php echo (!empty($program->field_program_image['und'][0]['alt'])) ? $program->field_program_image['und'][0]['alt'] : ''; ?>"
                             title="<?php echo (!empty($program->field_program_image['und'][0]['title'])) ? $program->field_program_image['und'][0]['title'] : ''; ?>">
                    </div>
                    <div class="information text-left col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="heading"><?php echo (!empty($program->field_program_title['und'][0]['value'])) ? $program->field_program_title['und'][0]['value'] : ''; ?></div>
                        <div class="caption"><?php echo (!empty($program->field_program_caption['und'][0]['value'])) ? $program->field_program_caption['und'][0]['value'] : ''; ?></div>
                        <div class="description">
                            <?php echo (!empty($program->body['und'][0]['value'])) ? $program->body['und'][0]['value'] : ''; ?>
                        </div>
                        <div class="details-link">
                            <a href="<?php echo $program->field_program_link['und'][0]['value']; ?>" title="Details" class="btn btn-submit-transparent btn-reserve-now no-border-radius" <?php if($program->field_program_link['und'][0]['value'] != '#'): ?> target="_blank" <?php endif; ?>>
                                Reserve Now
                            </a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<!-- /Student Programs -->

<?php include_once('includes/social-bar.php'); ?>

<?php include_once('includes/footer.php'); ?>