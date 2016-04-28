
<?php include_once('includes/mainmenu.php'); ?>

<?php include_once('includes/breadcrumb-page.php'); ?>

<?php include_once('includes/banner-slideshow.php'); ?>

<div class="row">
  <div class="container page-content page-not-found-content">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 page-content-sidebar">
      <?php echo render($page['content']); ?>
    </div>
    <?php if($page['sidebar_first']): ?>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 announcement hidden-xs hidden-sm">
        <?php echo render($page['sidebar_first']); ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php include_once('includes/social-bar.php'); ?>

<?php include_once('includes/footer.php'); ?>