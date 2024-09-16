<style>
    header.wp-block-template-part {
        display: none;
    }

    footer.wp-block-template-part {
        display: none;
    }
</style>

<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" enctype="multipart/form-data">

    <input type="hidden" name="kontakt_id" value="<?php echo esc_attr($this->kontakt_id); ?>">
    <input type="checkbox" name="checkbox_confirm" value="1"> Klikněte a potvrďte pokud jste dostali dárek <br>
    <input id="confirm_action" name="confirm_action" type="submit" value="Poslat potvrzeni">

</form>