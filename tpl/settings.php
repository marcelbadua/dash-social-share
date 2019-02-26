<div class="wrap">
    <h2>Dash Social Share</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('dash_social_share-group'); ?>
        <?php @do_settings_fields('dash_social_share-group'); ?>

        <?php do_settings_sections('dash_social_share'); ?>

        <?php @submit_button(); ?>
    </form>
</div>