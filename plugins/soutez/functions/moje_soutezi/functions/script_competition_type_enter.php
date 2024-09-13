<?php

require_once('db_functions.php');
require_once('form_functions.php');
require_once('display_functions.php');

$competition_types = getCompetitionsType();
processCompetitionTypeEnter();

?>
<div class="wrap">
    <h1>Doplnit nazev</h1>
    <form method="post" action="">
        <table class="form-table">
            <tr>
                <th scope="row"><label for="type">Doplnit nazev souteze</label></th>
                <td><input type="text" name="type" id="type" value="" /></td>
            </tr>
        </table>

        <?php submit_button("Doplnit"); ?>
    </form>
</div>