<?php

//Nastavení menu
function my_contest_subpage_nastaveni()
{
    if (isset($_POST['submit']) && $_POST['submit'] == 'Doplnit') {
        update_option('ecomail_api_key', $_POST['ecomail_api_key']);
        $shortcode = stripslashes(sanitize_text_field($_POST['cf7_shortcode'])); //декодирование шорткода
        update_option('cf7_shortcode', $shortcode);
    }
    $api_key = esc_attr(get_option('ecomail_api_key'));
    // $shortcode = esc_attr(get_option('cf7_shortcode'));
?>
    <div class="wrap">
        <h1>Ecomail API</h1>
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="ecomail">Doplň sem svoje ecomail API</label></th>
                    <td><input name="ecomail_api_key" id="ecomail" value="<?php echo $api_key; ?>" /></td>

                    <!-- <th scope="row"><label for="ecomail">Doplň sem shortcode z contact form 7</label></th>
                    <td><input name="cf7_shortcode" id="cf7_shortcode" value="<?php echo $shortcode; ?>" /></td> -->
                </tr>
            </table>

            <?php submit_button('Doplnit'); ?>
        </form>
    </div>
<?php
}
