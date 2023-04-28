<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipsController{
    private $equips = array( 
        array("codi" => "1", "nom" => "Equip Roig", "cicle" => "DAW", "curs" => "22/23", "membres" => array("David","Alejandro","Jose","Marta")),  
        array("codi" => "2", "nom" => "Equip Groc", "cicle" => "DAM", "curs" => "21/22", "membres" => array("Alvaro","Ivan","Marcos","Samuel")),
        array("codi" => "3", "nom" => "Equip Taronja", "cicle" => "ASIX", "curs" => "19/20", "membres" => array("Sergio","Laura","Maria","Sue")),
        array("codi" => "4", "nom" => "Equip Verd", "cicle" => "REDES", "curs" => "18/19","membres" => array("Yasmine","Valentino","Mario","Samantha")),  
    );

    #[Route('/equip/{codi}' ,name:'dades_equip')]
    public function dades($codi){
        $resultat = array_filter($this->equips,
        function($dades) use ($codi){
            return $dades["codi"]==$codi;
        });
        if(count($resultat)>0){
            $resposta = "";
            $resultat = array_shift($resultat);
            $mb = implode(" ",$resultat["membres"]);
            $resposta .= "<ul><li>" . $resultat["nom"] . "</li>" . 
            "<li>" . $resultat["cicle"] . "</li>" .
            "<li>" . $resultat["curs"] . "</li>" .
            "<li>" . $mb ."</li></ul>";

            return new Response("<html><body>$resposta</body></html>");
        }else{
            return new Response("No s'ha trobatl'equip : ". $codi);
        }
    }
}


?>