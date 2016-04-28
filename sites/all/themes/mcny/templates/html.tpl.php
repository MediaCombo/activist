<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="<?php print $language->language; ?>"
      version="XHTML+RDFa 1.0"
      dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>

<head profile="<?php print $grddl_profile; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php print $head; ?>
    <title><?php echo $head_title; ?></title>

    <?php print $styles; ?>
    <?php print $scripts; ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="<?php print $classes; ?>" <?php print $attributes; ?>>

<?php print $page_top; ?>
<?php print $page; ?>
<?php print $page_bottom; ?>

<script type="text/javascript">
    //$('.dropdown-toggle').on('click', function() {
    //    $(".caret").toggleClass('glyphicon-caret-down glyphicon-caret-up');
    //});

    /*
     function priventScroll(){
     if( navigator.userAgent.match(/iPhone|iPad|iPod/i) ) {
     var scrollNo=$(window).scrollTop();
     $('#mcny-modal').on('show.bs.modal', function() {
     $('body').css({ position: 'fixed' });
     });
     $('#mcny-modal').on('hide.bs.modal', function() {
     $('body').css('position', '');
     $(window).scrollTop(scrollNo);
     });
     }
     //        $('#mcny-modal').on('shown.bs.modal', function () {
     //            $('body').css({
     //                position: 'fixed'
     //            });
     //        });
     //        $('#mcny-modal').on('hidden.bs.modal', function () {
     //            $('body').css({
     //                position: ''
     //            });
     //        });
     }
     */

    // Enable dropdown effect for medium or larger screens
    var screenWidth = $(document).width();
    if (screenWidth >= 1024) {
        $(".dropdown").hover(
            function () {
                $('.dropdown-menu', this).stop(true, true).fadeIn("slow");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            },
            function () {
                $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            });
        $(".dropdown a").removeAttr('data-toggle');
    }

    var hasNavBarToggled = false;
    $("#navbar-toggle").on('click', function () {
        if (!hasNavBarToggled) {
            $(this).addClass('active');
            $("#social-links-container").removeClass('hidden');
            hasNavBarToggled = true;
        }
        else {
            $(this).removeClass('active');
            $("#social-links-container").addClass('hidden');
            hasNavBarToggled = false;
        }
    });
</script>

</body>
</html>