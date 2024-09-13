<?php

require_once('db_functions.php');
require_once('form_functions.php');

$competition_main_types = getMainCompetitionTypes();
foreach ($competition_main_types as $competition_type) {
    $template = getHlavniTemplate($competition_type->main_competition_id);
    $ecomail_template_id = getHlavniTemplateId($competition_type->main_competition_id);
    processMainMailMaker($competition_type);
?>
    <div id="tab3" class="tab-content" style="display: none;">
        <div class="wrap">
            <h1><?php echo $competition_type->zacatek . " - " . $competition_type->konec; ?></h1>
            <form method="post" action="">
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="template" ?>Vzorek pro hlavni mail</label></th>
                        <td><textarea name="template" id="template"><?php echo $template ?></textarea></td>
                        <td><label for="ecomail_template_id"><b>Please enter template_id</b></label><input type="text" name="ecomail_template_id" id="ecomail_template_id" value="<?php echo $ecomail_template_id ?>" /></td>
                    </tr>
                </table>

                <?php submit_button("Uložit hlavni mail"); ?>
            </form>
        </div>
    </div>
    </div>
<?php
}
