<div class="row visible-lg visible-md visible-sm visible-xs">
    <div class="container">
        <div class="col-lg-12 no-padding-lr">
            <div class="breadcrumb default-padding no-borders no-border-radius">
                <div class="active active-page-title-margin"><?php print $title; ?></div>
                <div class="breadcrumb-buttons-container class-rooms-breadcrumb">
                    <!-- Class Room Labels -->
                    <?php
                        //print_r(arg());
                        //echo taxonomy_term_load(arg(2))->name;
                        $arrClassrooms = mcny_get_taxonomy_options('class_room_category');
                        foreach($arrClassrooms as $l): $label = $l['data']; ?>
                        <a href="<?php echo base_path().mcny_get_taxonomy_url($label); ?>" class="btn btn-default no-border-radius btn-breadcrumb <?php if(!arg(2)) { echo ''; } elseif($label->tid==arg(2)) { echo 'active'; } ?>">
                            <?php echo $label->name; ?>
                        </a>
                    <?php endforeach; ?>
                    <!-- / Class Room Labels -->
                </div>
            </div>
        </div>
    </div>
</div>