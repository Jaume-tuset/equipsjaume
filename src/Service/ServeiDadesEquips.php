<?php 

namespace App\Service;

class ServeiDadesEquips{

    private $equips = array( 
        array("codi" => "1", "nom" => "Equip Roig", "cicle" => "DAW", "curs" => "22/23", "membres" => array("David","Alejandro","Jose","Marta"),"img"=>"/assets/img/equips/rojo.jpeg"),
        array("codi" => "2", "nom" => "Equip Groc", "cicle" => "DAM", "curs" => "21/22", "membres" => array("Alvaro","Ivan","Marcos","Samuel"),"img"=>"/assets/img/equips/amarillo.png"),
        array("codi" => "3", "nom" => "Equip Taronja", "cicle" => "ASIX", "curs" => "19/20", "membres" => array("Sergio","Laura","Maria","Sue"),"img"=>"/assets/img/equips/naranja.jpeg"),
        array("codi" => "4", "nom" => "Equip Verd", "cicle" => "REDES", "curs" => "18/19","membres" => array("Yasmine","Valentino","Mario","Samantha"),"img"=>"/assets/img/equips/verde.jpeg"),  
    );

    
    public function get(){
        return $this->equips;
    }

}



?>