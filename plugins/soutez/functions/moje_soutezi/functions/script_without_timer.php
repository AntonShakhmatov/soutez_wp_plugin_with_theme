<?php

require_once('db_functions.php');
require_once('form_functions.php');
require_once('display_functions.php');

//Typ soutěže bez časomíri
if ($competition_types) {
    processForms();
}

?>
<div class="wrap">
    <h1>Se hraje</h1>
    <form method="post" action="">
        <table class="form-table">
            <tr>
                <th scope="row"><label for="competition_type">Typ soutěže</label></th>
                <td>
                    <select name="selected_type" id="selected_type">
                        <option value="denni">denni</option>
                        <option value="hlavni">hlavni</option>
                    </select>
                </td>
            </tr>

            <th scope="row"><label for="competition_type_2">Cislo vyhry</label></th>
            <td>
                <select name="selected_type_2" id="selected_type_2">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </td>

            <tr>
                <th scope="row"><label for="vyhra">Ve souteži se hraje o</label></th>
                <td><input type="text" name="vyhra" id="vyhra" value="" /><input type="number" min="1" placeholder="Počet losování" list="numbList" name="numberof" value=1></td>
            </tr>

            <?php
            $denni_competitions = getDenniCompetitions();
            $hlavni_competitions = getHlavniCompetitions();
            displayCompetitionsTable($denni_competitions, $hlavni_competitions);
            ?>

        </table>
        <div class="flex" style="display: flex; width: 100%; justify-content: center;">
            <!--            --><?php //submit_button("Uložit"); 
                                ?>
            <?php submit_button("Uložit", "primary", "submit", false, array('style' => 'margin: auto;')); ?>
        </div>
    </form>
</div>