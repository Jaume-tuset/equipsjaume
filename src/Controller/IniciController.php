<?php 

namespace App\Controller;

use App\Entity\Equip;
use App\Service\ServeiDadesEquips;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IniciController extends AbstractController{

    /*private $equips;

    public function __construct(ServeiDadesEquips $dadesEquips){
        $this->equips=$dadesEquips->get();
    }
    
    #[Route("/", name:'inici')]

    public function inici(){
        return $this->render('inici.html.twig',array('equips'=>$this->equips));
    }
    */

    #[Route("/", name:'inici')]
    public function inici(ManagerRegistry $doctrine){
        $repositori = $doctrine->getRepository(Equip::class);
        $equips=$repositori->findAll();
        return $this->render('inici.html.twig',array('equips'=>$equips));
    }

}


?>