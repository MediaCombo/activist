<?php
$timeline_type = $fields['field_timeline_type']->content;
?>

<div class="timeline-item item-a">
    <?php if($timeline_type == "Left Side"): ?>
    <p><?php echo $fields['title']->content.$fields['field_timeline_year']->content; ?></p>
    <?php endif; ?>
</div>
<div class="sep-item">
    <span></span>
</div>
<div class="timeline-item item-b">
    <?php if($timeline_type == "Right Side"): ?>
    <p><?php echo $fields['title']->content.$fields['field_timeline_year']->content; ?></p>
    <?php endif; ?>
</div>