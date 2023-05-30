<?php

namespace App\Controller;

use App\Entity\Equip;
use App\Entity\Membre;
use App\Service\ServeiDadesEquips;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EquipsController extends AbstractController{
   
    private $equips;
    
    public function __construct(ServeiDadesEquips $dadesEquips){
        $this->equips = $dadesEquips->get();
    }

    #[Route('/equip/{codi<\d+>?1}',name:'dades_equips', requirements: ['codi' => '\d+'])]
    public function dades(ManagerRegistry $doctrine,$id=1){

        //$equip = $repositori->findOneBy(['id'=>$id]);
        
        $repositori = $doctrine->getRepository(Equip::class);
        $repositori2 = $doctrine->getRepository(Membre::class);
        $equip=$repositori->find($id);
        $equips=$repositori->findAll();

        /*
        if(!$equip){
            throw $this->createNotFoundException("L'equip no existeix");
        }else{
            return $this->render('dades_equip.html.twig',['equip'=>$equip]);
        }
        * */

        if($equips!=null){
            return $this->render('dades_equip.html.twig',array('equips'=>$equips,'id'=>$id));
        }else{
            return $this->render('dades_equip.html.twig',array('equips'=>NULL,'id'=>NULL));
        }

 }   


    #[Route('/equip/inserir', name:'inserir_equip')]
    public function inserir(ManagerRegistry $doctrine){
        
        $entityManager = $doctrine->getManager();
        $equip = new Equip();
        $equip->setNom("Simarrets");
        $equip->setCicle("DAW");
        $equip->setCurs("22/23");
        $equip->setNota(9);
        $equip->setImatge("/assets/img/equips/power.jpeg");
        $entityManager->persist($equip);
        try{
            $entityManager->flush();
            return $this->render('inserir_equip.html.twig',array('equip'=>$equip,"error"=>null));
        }catch(\Exception $e){
            $error=$e->getMessage();
            return $this->render('inserir_equip.html.twig',array('equip'=>$equip,"error"=>$error));
        }
    }

    #[Route('/equip/inserirmultiple', name:'inserir_equips')]
    public function inserirMultiple(ManagerRegistry $doctrine){
        
        $entityManager = $doctrine->getManager();
        $equip1 = new Equip();
        $equip1->setNom("Equip Rosa");
        $equip1->setCicle("DAW");
        $equip1->setCurs("22/23");
        $equip1->setNota(5.25);
        $equip1->setImatge('/assets/img/equips/rosa.jpeg');
        $entityManager->persist($equip1);

        $equip2 = new Equip();
        $equip2->setNom("Equip Blau");
        $equip2->setCicle("DAM");
        $equip2->setCurs("12/13");
        $equip2->setNota(6.45);
        $equip2->setImatge('/assets/img/equips/blau.jpeg');
        $entityManager->persist($equip2);

        $equip3 = new Equip();
        $equip3->setNom("Equip Negre");
        $equip3->setCicle("ASIX");
        $equip3->setCurs("42/43");
        $equip3->setNota(2.15);
        $equip3->setImatge('/assets/img/equips/negre.jpeg');
        $entityManager->persist($equip3);

        $equip4 = new Equip();
        $equip4->setNom("Equip Blanc");
        $equip4->setCicle("DAM");
        $equip4->setCurs("10/11");
        $equip4->setNota(9.87);
        $equip4->setImatge('/assets/img/equips/blanco.jpeg');
        $entityManager->persist($equip4);

        $equips=array($equip1,$equip2,$equip3,$equip4);

        try{
            $entityManager->flush();
            return $this->render('inserir_equip_multiple.html.twig',array('equips'=>$equips,"error"=>null));
        }catch(\Exception $e){
            $error=$e->getMessage();
            return $this->render('inserir_equip_multiple.html.twig',array('equips'=>$equips,"error"=>$error));
        }
    }
    

    #[Route('/equip/nota/{nota}', name:'filtro_nota',requirements:['codi'=>'\d+'])]
    public function filtrar(ManagerRegistry $doctrine,$nota=0){
        $repositori=$doctrine->getRepository(Equip::class);
        $equips=$repositori->findByNote($nota);
        $equipssort=rsort($equips);

        if($equips!=null){
            return $this->render('filtrar_notes_equip.html.twig',array('equips'=>$equips));
        }else{
            return $this->render('filtrar_notes_equip.html.twig',array('equips'=>NULL));
        }
    }
}


?>