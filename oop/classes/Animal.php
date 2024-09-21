<?php 

class Animal {

    private $name;

    private $favcolor;


    public function eat(){}


    public function move(){

        echo $this->favcolor . "is liked by " . $this->name;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getFavColor(){
        return $this->favcolor;
    }

    public function setFavColor($favcolor){
        $this->favcolor = $favcolor;
    }
}




