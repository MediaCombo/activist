<?php
    $timeline_type = trim($fields['field_timeline_type']->content);
    $limit = 12078;
?>

<div class="timeline-item item-a">
    <?php if($timeline_type == "Left Side" || $timeline_type == "Global Event"): ?>
        <p>
            <?php echo $fields['field_timeline_year']->content; ?>
            <span class="description">
                <?php
                    $content = $fields['field_timeline_title']->content;
                    echo (strlen($content) > $limit) ? substr($content, 0, $limit).'...' : $content;
                ?>
            </span>
        </p>
    <?php endif; ?>
</div>

<div class="sep-item">
    <span></span>
</div>

<div class="timeline-item item-b">
    <?php if($timeline_type == "Right Side" || $timeline_type == "Local Event"): ?>
        <p>
            <?php echo $fields['field_timeline_year']->content; ?>
            <span class="description">
                <?php
                    $content = $fields['field_timeline_title']->content;
                    echo (strlen($content) > $limit) ? substr($content, 0, $limit).'...' : $content;
                ?>
            </span>
        </p>
    <?php endif; ?>
</div>