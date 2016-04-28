<?php
    $c = 0;
    $total_rows = count($rows);
    foreach($rows as $r):
        $c++;
        if($c == 9):
    ?>
        <div class="more-timeline-items">
    <?php
        endif;
    ?>
    <div class="item-row">
        <?php echo $r; ?>
    </div>
    <?php
        if($c == $total_rows):
    ?>
        </div>
        <?php
        endif;
    endforeach;
?>

<?php
    if($total_rows >= 9):
?>
        <a href="javascript:void(0);" id="more_timeline" class="timeline-more"></a>
<?php
    endif;
?>