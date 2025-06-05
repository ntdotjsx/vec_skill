<?php 

$DATABASE = new class {
    public $test = "sss";
    public function test() {
        echo "TEST ". $this->test;
    }
};


?>