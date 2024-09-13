<?php

require_once('db_functions.php');
require_once('form_functions.php');

$competition_types = getCompetitionTypes();
foreach ($competition_types as $competition_type) {
    $template = getWeekTemplate($competition_type->draw_id);
    $ecomail_template_id = getWeekTemplateId($competition_type->draw_id);
    processMailMaker($competition_type);
?>
    <div id="tab1" class="tab-content">
        <div class="wrap">
            <h1><?php echo $competition_type->zacatek . " - " . $competition_type->konec; ?></h1>
            <form method="post" action="">
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="template" ?>Vzorek pro <?php echo $competition_type->competition_type; ?> mail</label></th>
                        <td><textarea name="template" id="template"><?php echo $template ?></textarea></td>
                        <td><label for="ecomail_template_id"><b>Please enter template_id</b></label><input type="text" name="ecomail_template_id" id="ecomail_template_id" value="<?php echo $ecomail_template_id ?>" /></td>
                    </tr>
                </table>

                <?php submit_button("Uložit {$competition_type->competition_type} mail"); ?>
            </form>
        </div>
    </div>
<?php
}
