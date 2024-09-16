<?php

function updateNamofInDenniSoutezi($vyhra, $quantity, $nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $wpdb->update(
        $table_name_denni,
        array(
            'vyhra' => $vyhra,
            'quantity' => $quantity
        ),
        array(
            'nameof' => $nameof
        )
    );
}

function updateNamofInDenniSoutezi2($vyhra, $quantity, $nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $wpdb->update(
        $table_name_denni,
        array(
            'vyhra2' => $vyhra,
            'quantity2' => $quantity
        ),
        array(
            'nameof' => $nameof
        )
    );
}

function updateNamofInDenniSoutezi3($vyhra, $quantity, $nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $wpdb->update(
        $table_name_denni,
        array(
            'vyhra3' => $vyhra,
            'quantity3' => $quantity
        ),
        array(
            'nameof' => $nameof
        )
    );
}

function updateNamofInDenniSoutezi4($vyhra, $quantity, $nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $wpdb->update(
        $table_name_denni,
        array(
            'vyhra4' => $vyhra,
            'quantity4' => $quantity
        ),
        array(
            'nameof' => $nameof
        )
    );
}

function updateNamofInDenniSoutezi5($vyhra, $quantity, $nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $wpdb->update(
        $table_name_denni,
        array(
            'vyhra5' => $vyhra,
            'quantity5' => $quantity
        ),
        array(
            'nameof' => $nameof
        )
    );
}

function updateNamofInDenniSoutezi6($vyhra, $quantity, $nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $wpdb->update(
        $table_name_denni,
        array(
            'vyhra6' => $vyhra,
            'quantity6' => $quantity
        ),
        array(
            'nameof' => $nameof
        )
    );
}

function updateNamofInDenniSoutezi7($vyhra, $quantity, $nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $wpdb->update(
        $table_name_denni,
        array(
            'vyhra7' => $vyhra,
            'quantity7' => $quantity
        ),
        array(
            'nameof' => $nameof
        )
    );
}

function updateNamofInDenniSoutezi8($vyhra, $quantity, $nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $wpdb->update(
        $table_name_denni,
        array(
            'vyhra8' => $vyhra,
            'quantity8' => $quantity
        ),
        array(
            'nameof' => $nameof
        )
    );
}

function updateNamofInDenniSoutezi9($vyhra, $quantity, $nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $wpdb->update(
        $table_name_denni,
        array(
            'vyhra9' => $vyhra,
            'quantity9' => $quantity
        ),
        array(
            'nameof' => $nameof
        )
    );
}

function updateNamofInDenniSoutezi10($vyhra, $quantity, $nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $wpdb->update(
        $table_name_denni,
        array(
            'vyhra10' => $vyhra,
            'quantity10' => $quantity
        ),
        array(
            'nameof' => $nameof
        )
    );
}

function selectQuantityFromDenniSoutezi($nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $quantity1 = $wpdb->get_var("SELECT quantity FROM {$table_name_denni} WHERE nameof = '$nameof'");
    return $quantity1;
}

function selectQuantityFromDenniSoutezi2($nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $quantity2 = $wpdb->get_var("SELECT quantity2 FROM {$table_name_denni} WHERE nameof = '$nameof'");
    return $quantity2;
}

function selectQuantityFromDenniSoutezi3($nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $quantity3 = $wpdb->get_var("SELECT quantity3 FROM {$table_name_denni} WHERE nameof = '$nameof'");
    return $quantity3;
}

function selectQuantityFromDenniSoutezi4($nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $quantity4 = $wpdb->get_var("SELECT quantity4 FROM {$table_name_denni} WHERE nameof = '$nameof'");
    return $quantity4;
}

function selectQuantityFromDenniSoutezi5($nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $quantity5 = $wpdb->get_var("SELECT quantity5 FROM {$table_name_denni} WHERE nameof = '$nameof'");
    return $quantity5;
}

function selectQuantityFromDenniSoutezi6($nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $quantity6 = $wpdb->get_var("SELECT quantity6 FROM {$table_name_denni} WHERE nameof = '$nameof'");
    return $quantity6;
}

function selectQuantityFromDenniSoutezi7($nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $quantity7 = $wpdb->get_var("SELECT quantity7 FROM {$table_name_denni} WHERE nameof = '$nameof'");
    return $quantity7;
}

function selectQuantityFromDenniSoutezi8($nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $quantity8 = $wpdb->get_var("SELECT quantity8 FROM {$table_name_denni} WHERE nameof = '$nameof'");
    return $quantity8;
}

function selectQuantityFromDenniSoutezi9($nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $quantity9 = $wpdb->get_var("SELECT quantity9 FROM {$table_name_denni} WHERE nameof = '$nameof'");
    return $quantity9;
}

function selectQuantityFromDenniSoutezi10($nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $quantity10 = $wpdb->get_var("SELECT quantity10 FROM {$table_name_denni} WHERE nameof = '$nameof'");
    return $quantity10;
}


function updateNameOfInDenniSoutezi($totalQuantity, $nameof)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $wpdb->update(
        $table_name_denni,
        array(
            'total_quantity' => $totalQuantity
        ),
        array(
            'nameof' => $nameof
        )
    );
}

function updateNameOfInHlavniSoutezi($vyhra, $quantity, $nameof)
{
    global $wpdb;
    $table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
    $wpdb->update(
        $table_name_hlavni,
        array(
            'vyhra' => $vyhra,
            'quantity' => $quantity
        ),
        array(
            'nameof' => $nameof
        )
    );
}
