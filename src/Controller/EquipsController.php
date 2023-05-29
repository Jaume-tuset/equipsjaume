<?php

namespace App\Controller;

use App\Service\ServeiDadesEquips;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipsController extends AbstractController{
   
    private $equips;

    public function __construct(ServeiDadesEquips $dadesEquips){
        $this->equips = $dadesEquips->get();
    }

    #[Route('/equip/{codi<\d+>?1}',name:'dades_equips', requirements: ['codi' => '\d+'])]
    public function dades($codi){
        
        $resultat=array_filter($this->equips, 
        function($equip) use ($codi){
            return $equip["codi"] == $codi;
        });
        if(count($resultat)>0){
            return $this->render('dades_equip.html.twig',array('equip'=>array_shift($resultat)));
        }else{
            return $this->render('dades_equip.html.twig',array('equip'=> NULL));
        }
    }
}


?>