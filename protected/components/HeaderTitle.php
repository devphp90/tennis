<?php
class HeaderTitle extends CWidget{
    public $items;

    public function run(){

        echo "<h3>".$this->items."</h3>";
    }
}
?>
