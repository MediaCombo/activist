<div class="image">
    <img src="<?php echo base_path().path_to_theme(); ?>/public/images/announcement-ico.png"/>
</div>

<?php foreach($rows as $r): ?>
    <div class="text">
        <?php echo $r; ?>
    </div>
<?php endforeach; ?>