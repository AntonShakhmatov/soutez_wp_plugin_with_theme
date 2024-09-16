<style>
    header.wp-block-template-part {
        display: none;
    }

    footer.wp-block-template-part {
        display: none;
    }
</style>

<form id="featured_upload" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">

    <input type="hidden" name="competition_type" value="<?php echo esc_attr($this->competition_type); ?>">
    <input type="hidden" name="kontakt_id" value="<?php echo esc_attr($this->kontakt_id); ?>">
    <input type="hidden" name="shortToken" value="<?php echo esc_attr($this->shortToken); ?>">

    <label>Your name</label>
    <input type="text" name="your-name" autocomplete="name" value="<?php echo esc_attr($this->name); ?>" required>

    <label>Your surname</label>
    <input type="text" name="your-surname" autocomplete="name" value="<?php echo esc_attr($this->surname); ?>" required>

    <label>Vyhral jste</label>
    <input type="text" name="your-vyhra" autocomplete="prize" value="<?php echo esc_attr($this->vyhra); ?>" required>

    <label>Your address</label>
    <input type="text" name="your-address" autocomplete="address" required>

    <input type="file" name="your-file" id="your-file" multiple="false" />
    <input type="hidden" name="submit_action" value="upload" />
    <input id="submit_action" name="submit_action" type="submit" value="Upload" />

</form>