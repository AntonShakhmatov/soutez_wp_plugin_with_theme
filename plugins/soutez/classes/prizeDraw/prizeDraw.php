<?php

require_once 'db_functions.php';

class PrizeDraw
{
    private $nameof;
    private $vyhra;
    private $quantity;
    public function __construct($nameof)
    {
        $this->nameof = $nameof;
        $vyhra = $_POST["vyhra"];
        $quantity = $_POST["numberof"];
    }

    public function addPrizeForDayCompetition()
    {
        updateNamofInDenniSoutezi($this->vyhra, $this->quantity, $this->nameof);
    }

    public function addPrizeForDayCompetition2()
    {
        updateNamofInDenniSoutezi2($this->vyhra, $this->quantity, $this->nameof);
    }

    public function addPrizeForDayCompetition3()
    {
        updateNamofInDenniSoutezi3($this->vyhra, $this->quantity, $this->nameof);
    }

    public function addPrizeForDayCompetition4()
    {
        updateNamofInDenniSoutezi4($this->vyhra, $this->quantity, $this->nameof);
    }

    public function addPrizeForDayCompetition5()
    {
        updateNamofInDenniSoutezi5($this->vyhra, $this->quantity, $this->nameof);
    }

    public function addPrizeForDayCompetition6()
    {
        updateNamofInDenniSoutezi6($this->vyhra, $this->quantity, $this->nameof);
    }

    public function addPrizeForDayCompetition7()
    {
        updateNamofInDenniSoutezi7($this->vyhra, $this->quantity, $this->nameof);
    }

    public function addPrizeForDayCompetition8()
    {
        updateNamofInDenniSoutezi8($this->vyhra, $this->quantity, $this->nameof);
    }

    public function addPrizeForDayCompetition9()
    {
        updateNamofInDenniSoutezi9($this->vyhra, $this->quantity, $this->nameof);
    }

    public function addPrizeForDayCompetition10()
    {
        updateNamofInDenniSoutezi10($this->vyhra, $this->quantity, $this->nameof);
    }

    public function addTotalQuantity()
    {
        global $wpdb;
        $totalQuantity = 0;
        $quantity1 = selectQuantityFromDenniSoutezi($this->nameof);
        $quantity2 = selectQuantityFromDenniSoutezi2($this->nameof);
        $quantity3 = selectQuantityFromDenniSoutezi3($this->nameof);
        $quantity4 = selectQuantityFromDenniSoutezi4($this->nameof);
        $quantity5 = selectQuantityFromDenniSoutezi5($this->nameof);
        $quantity6 = selectQuantityFromDenniSoutezi6($this->nameof);
        $quantity7 = selectQuantityFromDenniSoutezi7($this->nameof);
        $quantity8 = selectQuantityFromDenniSoutezi8($this->nameof);
        $quantity9 = selectQuantityFromDenniSoutezi9($this->nameof);
        $quantity10 = selectQuantityFromDenniSoutezi10($this->nameof);
        $totalQuantity = $quantity1 + $quantity2 + $quantity3 + $quantity4 + $quantity5 + $quantity6 + $quantity7 + $quantity8 + $quantity9 + $quantity10;

        updateNameOfInDenniSoutezi($totalQuantity, $this->nameof);

        update_option('totalQuantity', $totalQuantity);
    }

    //Moje soutěží menu function for prizes
    public function addPrizeForMainCompetition()
    {
        updateNameOfInHlavniSoutezi($this->vyhra, $this->quantity, $this->nameof);
    }
}
