<?php

class PrizeDraw
{
    private $nameof;
    private $table_name;
    private $table_name_2;
    private $table_name_denni;
    private $table_name_hlavni;
    private $draw_id;
    private $existing_denni_records;
    private $existing_quantity_records;
    public function __construct($nameof)
    {
        global $wpdb;
        $this->nameof = $nameof;
        $this->table_name_denni = $wpdb->prefix . 'denni_soutezi';
        $this->table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
    }

    public function addPrizeForDayCompetition()
    {
        global $wpdb;
        $vyhra = $_POST["vyhra"];
        $quantity = $_POST["numberof"];
        $wpdb->update(
            $this->table_name_denni,
            array(
                'vyhra' => $vyhra,
                'quantity' => $quantity
            ),
            array(
                'nameof' => $this->nameof
            )
        );
    }

    public function addPrizeForDayCompetition2()
    {
        global $wpdb;
        $vyhra = $_POST["vyhra"];
        $quantity = $_POST["numberof"];
        $wpdb->update(
            $this->table_name_denni,
            array(
                'vyhra2' => $vyhra,
                'quantity2' => $quantity
            ),
            array(
                'nameof' => $this->nameof
            )
        );
    }

    public function addPrizeForDayCompetition3()
    {
        global $wpdb;
        $vyhra = $_POST["vyhra"];
        $quantity = $_POST["numberof"];
        $wpdb->update(
            $this->table_name_denni,
            array(
                'vyhra3' => $vyhra,
                'quantity3' => $quantity
            ),
            array(
                'nameof' => $this->nameof
            )
        );
    }

    public function addPrizeForDayCompetition4()
    {
        global $wpdb;
        $vyhra = $_POST["vyhra"];
        $quantity = $_POST["numberof"];
        $wpdb->update(
            $this->table_name_denni,
            array(
                'vyhra4' => $vyhra,
                'quantity4' => $quantity
            ),
            array(
                'nameof' => $this->nameof
            )
        );
    }

    public function addPrizeForDayCompetition5()
    {
        global $wpdb;
        $vyhra = $_POST["vyhra"];
        $quantity = $_POST["numberof"];
        $wpdb->update(
            $this->table_name_denni,
            array(
                'vyhra5' => $vyhra,
                'quantity5' => $quantity
            ),
            array(
                'nameof' => $this->nameof
            )
        );
    }

    public function addPrizeForDayCompetition6()
    {
        global $wpdb;
        $vyhra = $_POST["vyhra"];
        $quantity = $_POST["numberof"];
        $wpdb->update(
            $this->table_name_denni,
            array(
                'vyhra6' => $vyhra,
                'quantity6' => $quantity
            ),
            array(
                'nameof' => $this->nameof
            )
        );
    }

    public function addPrizeForDayCompetition7()
    {
        global $wpdb;
        $vyhra = $_POST["vyhra"];
        $quantity = $_POST["numberof"];
        $wpdb->update(
            $this->table_name_denni,
            array(
                'vyhra7' => $vyhra,
                'quantity7' => $quantity
            ),
            array(
                'nameof' => $this->nameof
            )
        );
    }

    public function addPrizeForDayCompetition8()
    {
        global $wpdb;
        $vyhra = $_POST["vyhra"];
        $quantity = $_POST["numberof"];
        $wpdb->update(
            $this->table_name_denni,
            array(
                'vyhra8' => $vyhra,
                'quantity8' => $quantity
            ),
            array(
                'nameof' => $this->nameof
            )
        );
    }

    public function addPrizeForDayCompetition9()
    {
        global $wpdb;
        $vyhra = $_POST["vyhra"];
        $quantity = $_POST["numberof"];
        $wpdb->update(
            $this->table_name_denni,
            array(
                'vyhra9' => $vyhra,
                'quantity9' => $quantity
            ),
            array(
                'nameof' => $this->nameof
            )
        );
    }

    public function addPrizeForDayCompetition10()
    {
        global $wpdb;
        $vyhra = $_POST["vyhra"];
        $quantity = $_POST["numberof"];
        $wpdb->update(
            $this->table_name_denni,
            array(
                'vyhra10' => $vyhra,
                'quantity10' => $quantity
            ),
            array(
                'nameof' => $this->nameof
            )
        );
    }

    public function addTotalQuantity()
    {
        global $wpdb;
        $vyhra = $_POST["vyhra"];
        $totalQuantity = 0;
        $quantity1 = $wpdb->get_var("SELECT quantity FROM {$this->table_name_denni} WHERE nameof = '$this->nameof'");
        $quantity2 = $wpdb->get_var("SELECT quantity2 FROM {$this->table_name_denni} WHERE nameof = '$this->nameof'");
        $quantity3 = $wpdb->get_var("SELECT quantity3 FROM {$this->table_name_denni} WHERE nameof = '$this->nameof'");
        $quantity4 = $wpdb->get_var("SELECT quantity4 FROM {$this->table_name_denni} WHERE nameof = '$this->nameof'");
        $quantity5 = $wpdb->get_var("SELECT quantity5 FROM {$this->table_name_denni} WHERE nameof = '$this->nameof'");
        $quantity6 = $wpdb->get_var("SELECT quantity6 FROM {$this->table_name_denni} WHERE nameof = '$this->nameof'");
        $quantity7 = $wpdb->get_var("SELECT quantity7 FROM {$this->table_name_denni} WHERE nameof = '$this->nameof'");
        $quantity8 = $wpdb->get_var("SELECT quantity8 FROM {$this->table_name_denni} WHERE nameof = '$this->nameof'");
        $quantity9 = $wpdb->get_var("SELECT quantity9 FROM {$this->table_name_denni} WHERE nameof = '$this->nameof'");
        $quantity10 = $wpdb->get_var("SELECT quantity10 FROM {$this->table_name_denni} WHERE nameof = '$this->nameof'");
        $totalQuantity = $quantity1 + $quantity2 + $quantity3 + $quantity4 + $quantity5 + $quantity6 + $quantity7 + $quantity8 + $quantity9 + $quantity10;

        $wpdb->update(
            $this->table_name_denni,
            array(
                'total_quantity' => $totalQuantity
            ),
            array(
                'nameof' => $this->nameof
            )
        );
        update_option('totalQuantity', $totalQuantity);
    }

    //Moje soutěží menu function for prizes
    public function addPrizeForMainCompetition()
    {
        global $wpdb;
        $vyhra = $_POST["vyhra"];
        $quantity = $_POST["numberof"];
        $wpdb->update(
            $this->table_name_hlavni,
            array(
                'vyhra' => $vyhra,
                'quantity' => $quantity
            ),
            array(
                'nameof' => $this->nameof
            )
        );
    }
}
