<?php if($page['footer_copyright'] || $page['footer_information']): ?>
    <div class="row">
        <div class="container">
            <div class="col-lg-12 margin-bottom-10">
                <div class="footer">
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 links">
                        <?php echo render($page['footer_copyright']); ?>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12 description">
                        <?php echo render($page['footer_information']); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>