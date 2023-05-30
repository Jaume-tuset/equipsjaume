<?php 

namespace App\Controller;
use App\Entity\Membre;
use App\Entity\Equip;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class MembresController extends AbstractController{

    #[Route('/membre/inserir' ,name:'inserir_membre', requirements: ['codi' => '\d+'])]
    public function inserirmembre(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $repository=$doctrine->getRepository(Equip::class);
        $equip = $repository->findOneBy(["nom"=>"Simarrets"]);
        $membre = new membre();
        $membre->setNom("Sarah");
        $membre->setCognoms("Connor");
        $membre->setImatgePerfil('/assets/img/stahconor.jpeg');
        $membre->setEmail("sarahconnor@skynet.com");
        $membre->setNota(9.7);
        $fecha=new \DateTime("11/29/1963");
        $membre->setDataNaixement($fecha);
        $membre->setEquip($equip);
        $entityManager->persist($membre);
        try{
            $entityManager->flush();
            return $this->render('inserir_membre.html.twig', array(
                'membre' => $membre, "error"=>null));
        } catch (\Exception $e) {
            $error=$e->getMessage();
            return $this->render('inserir_membre.html.twig', array(
                    'membre' => $membre, "error"=>$error));
        }

}


}


?>