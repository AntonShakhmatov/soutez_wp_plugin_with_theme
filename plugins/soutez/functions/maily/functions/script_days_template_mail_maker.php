<?php

require_once('db_functions.php');
require_once('form_functions.php');

$competition_denni_types = getDayCompetitionTypes();
//foreach($competition_denni_types as $competition_type){
?>
<div id="tab2" class="tab-content" style="display: none;">
    <div class="wrap">

        <!--        <h1>--><?php //echo $competition_type->zacatek . " - " . $competition_type->konec; 
                            ?><!--</h1>-->
        <form method="post" action="">

            <table class="form-table">
                <tr>
                    <th scope="row"><label for="template" ?>Vzorek pro denni mail</label></th>
                    <?php foreach ($competition_denni_types as $competition_type) {
                        $template = getDayTemplate($competition_type->denni_competition_id);
                        $ecomail_template_id = getDayTemplateId($competition_type->denni_competition_id);
                    ?>
                        <input type="hidden" name="invisible[]" value="<?php echo $competition_type->denni_competition_id; ?>">
                    <?php } ?>
                    <td><textarea name="template" id="template"><?php echo $template ?></textarea></td>
                    <td><label for="ecomail_template_id"><b>Please enter template_id</b></label><input type="text" name="ecomail_template_id" id="ecomail_template_id" value="<?php echo $ecomail_template_id ?>" /></td>
                </tr>
            </table>

            <?php submit_button("Uložit denni mail"); ?>
        </form>

    </div>
</div>
<?php
//}
processDaysMailMaker($competition_type);
