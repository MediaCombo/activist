<?php if($page['banner_slider']): ?>
    <div class="row">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding-lr">
                <?php echo render($page['banner_slider']); ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php endif; ?>