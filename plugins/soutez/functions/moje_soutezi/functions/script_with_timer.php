<?php

require_once('db_functions.php');
require_once('form_functions.php');
require_once('display_functions.php');

//Typ soutěže s časomírou
if($competition_types){
    processForm();
}

?>
<div class="wrap">
<h1>Nastavit datu provedeni</h1>
    <form method="post" action="">
        <table class="form-table">
        <tr>
                <th scope="row"><label for="competition_type">Typ soutěže</label></th>
                <td>
                    <select name="selected_type" id="selected_type">
                        <?php
                            $selected_types = getSelectedTypes();
                            foreach ($selected_types as $selected_type) : ?>
                            <option value="<?php echo $selected_type->competition_type; ?>"><?php echo $selected_type->competition_type; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="zahajeni">Zahájení soutěže</label></th>
                <td><input type="datetime-local" name="zahajeni" id="zahajeni" value="" /></td>
                <th scope="row"><label for="konec">Konec soutěže</label></th>
                <td><input type="datetime-local" name="konec" id="konec" value="" /></td>

                <th scope="row"><label for="vyhra">Ve souteži se hraje o</label></th>
                <td><input type="text" name="vyhra" id="vyhra" value="" /><input type="number" min="1" placeholder="Počet losování" list="numbList" name="numberof" value=1></td>
            </tr>

            <?php
            $competitions = getCompetitions();
            displayWeeksCompetitionsTable($competitions)
            ?>
        </table>
        <div class = "flex" style = "display: flex; width: 100%; justify-content: center;">
<!--        --><?php //submit_button("Ulozit"); ?>
            <?php submit_button("Ulozit", "primary", "submit", false, array('style' => 'margin: auto;')); ?>
<!--        --><?php //submit_button("Vymazat"); ?>
            <?php submit_button("Vymazat", "primary", "submit", false, array('style' => 'margin: auto; background: red')); ?>
        </div>
    </form>
</div>
<?php