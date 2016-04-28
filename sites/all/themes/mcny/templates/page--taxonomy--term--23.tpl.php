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

<!-- Professional Development -->
<div class="row professional-program-page">
    <div class="container page-content-text exhibition-container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding page-description">
            <?php
                $arg = arg(2);
                $taxonomy = (isset($arg)) ? taxonomy_term_load($arg) : null;
                echo ($taxonomy && $arg && !empty($taxonomy->description)) ? $taxonomy->description : '';
            ?>
        </div>
        <div class="programs-container col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">

            <?php $count=0; foreach(mcny_get_taxonomy_options_professional_development('professional_development_category') as  $arrProgram): $program = $arrProgram['data'] ?>
                <?php if($arrProgram['total'] >= 1): ?>
                <div class="program">
                    <div class="image col-lg-4 col-md-4 col-sm-4 col-xs-12 no-padding">
                        <img src="<?php echo image_style_url('professional_development', $program->field_professional_dev_image['und'][0]['uri']); ?>"
                             class="img-responsive"
                             alt="<?php echo (!empty($program->field_professional_dev_image['und'][0]['alt'])) ? $program->field_professional_dev_image['und'][0]['alt'] : ''; ?>"
                             title="<?php echo (!empty($program->field_professional_dev_image['und'][0]['title'])) ? $program->field_professional_dev_image['und'][0]['title'] : ''; ?>">
                    </div>
                    <div class="information text-left col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="heading"><?php echo (!empty($program->name)) ? $program->name : ''; ?></div>
                        <div class="description">
                            <?php echo (!empty($program->description)) ? $program->description : ''; ?>
                        </div>
                        <div id="list-<?php echo $count; ?>" class="list" data-expended="false">
                            <?php foreach($arrProgram['nodes'] as $entry): ?>
                                <div class="entry">
                                    <div class="heading"><?php echo $entry->field_professional_program_title['und'][0]['value']; ?></div>
                                    <div class="caption">
                                        <div><?php echo $entry->field_professional_participants['und'][0]['value']; ?></div>
                                        <div><?php echo date('D, M d, Y', $entry->field_professional_program_date['und'][0]['value']); ?></div>
                                        <div>
                                            <?php
                                                $startTimeReplaced = str_replace('AM',' AM', $entry->field_professional_time_start['und'][0]['value']);
                                                $startTimeReplaced = str_replace('PM',' PM', $startTimeReplaced);
                                                echo $startTimeReplaced;
                                            ?> -
                                            <?php
                                                $endTimeReplaced = str_replace('AM',' AM', $entry->field_professional_time_end['und'][0]['value']);
                                                $endTimeReplaced = str_replace('PM',' PM', $endTimeReplaced);
                                                echo $endTimeReplaced;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="description">
                                        <?php echo (!empty($entry->body['und'][0]['value'])) ? $entry->body['und'][0]['value'] : ''; ?>
                                    </div>
                                    <div class="details-link">
                                        <a href="<?php echo $entry->field_professional_program_link['und'][0]['value']; ?>" title="Details" class="btn btn-submit-transparent btn-reserve-now no-border-radius" <?php if($entry->field_professional_program_link['und'][0]['value'] != '#'): ?> target="_blank" <?php endif; ?>>
                                            Reserve Now
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="details-link">
                            <a id="details-link-<?php echo $count; ?>" href="javascript:;" title="Details" onclick="toggleProfessionalPrograms('<?php echo $count; ?>');">
                                Details <span class="icon fa fa-chevron-right text-gray"></span>
                            </a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php endif; ?>
            <?php $count++; endforeach; ?>

        </div>
    </div>
</div>
<!-- /Professional Development -->

<script type="text/javascript">

    $(document).ready(function(){
        $(".list").hide();
    });

    function toggleProfessionalPrograms(id){
        var list = $("#list-"+id);
        var hasExpended = list.attr('data-expended');
        if(hasExpended == 'false') {
            list.slideDown();
            list.attr('data-expended', true);
            $("#details-link-" + id + " span.icon").removeClass('fa-chevron-right');
            $("#details-link-" + id + " span.icon").addClass('fa-chevron-up');
        }
        if(hasExpended == 'true') {
            list.slideUp();
            list.attr('data-expended', false);
            $("#details-link-" + id + " span.icon").removeClass('fa-chevron-up');
            $("#details-link-" + id + " span.icon").addClass('fa-chevron-right');
        }
    }
</script>

<?php include_once('includes/social-bar.php'); ?>

<?php include_once('includes/footer.php'); ?>