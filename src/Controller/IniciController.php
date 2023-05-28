<?php 

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IniciController extends AbstractController{

    /**
     * @Route("/", name="inici")
     */
    public function inici(){
        return $this->render('inici.html.twig');
    }
}


?>