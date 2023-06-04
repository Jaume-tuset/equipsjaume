<?php

namespace App\Controller;
use App\Entity\Usuari;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController {


    #[Route('/usuari', name: 'usuari')]
    public function user(ManagerRegistry $doctrine){
        $repositori = $doctrine->getRepository(Usuari::class);
        $usuaris = $repositori->findAll();
        return $this->render('usuari.html.twig', array('usuaris' => $usuaris));
    }

    #[Route('/usuari/nou', name: 'nou_usuari')]
    public function nuevoUser(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher)
    {

        $usuari = new Usuari();
        $formulari = $this->createFormBuilder($usuari)
            ->add('username', TextType::class, array('required' => true))
            ->add('password', PasswordType::class, array('required' => true))
            ->add('save', SubmitType::class, array('label' => 'Enviar'))
            ->getForm();
        $formulari->handleRequest($request);
        if ($formulari->isSubmitted() && $formulari->isValid()) {
            $usuari->setRoles(["ROLE_USER"]);
            $pass = $formulari->getData()->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($usuari, $pass);
            $usuari->setPassword($hashedPassword);
            $usuari = $formulari->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($usuari);
            $entityManager->flush();
            return $this->redirectToRoute('usuari');

        }
        return $this->render('usuari_nou.html.twig', array('formulari' => $formulari->createView()));
    }
   
    #[Route('/usuari/editar/{codi}' ,name:'editar_usuari', requirements: ['codi' => '\d+'])]
    public function editarUser(Request $request, $codi, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher)
    {
        $repositori = $doctrine->getRepository(Usuari::class);
        $usuari = $repositori->find($codi);
        $passwordOld = $usuari->getPassword();
        $formulari = $this->createFormBuilder($usuari)
            ->add('username', TextType::class, array('required' => true))
            ->add('password', PasswordType::class, array('required' => false, 'empty_data' => ''))
            ->add('save', SubmitType::class, array('label' => 'Enviar'))
            ->getForm();
        $formulari->handleRequest($request);
        if ($formulari->isSubmitted() && $formulari->isValid()) {
            $usuari = $formulari->getData();
            $password = $formulari->get('password')->getData();
            if ($password == '') {
                $usuari->setPassword($passwordOld);
            } else {
                $pass = $formulari->getData()->getPassword();
                $hashedPassword = $passwordHasher->hashPassword($usuari, $pass);
                $usuari->setPassword($hashedPassword);
            }

            $usuari = $formulari->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($usuari);
            $entityManager->flush();
            return $this->redirectToRoute('usuari');
        }
        return $this->render('editar_usuari.html.twig', array('formulari' => $formulari->createView()));
    }


    #[Route('/usuari/eliminar/{codi}' ,name:'eliminar_usuari', requirements: ['codi' => '\d+'])]
    public function eliminarUser(Request $request, $codi, ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $repositori = $doctrine->getRepository(Usuari::class);
        $usuari = $repositori->find($codi);
        try {
            if ($usuari){
                $entityManager->remove($usuari);
                $entityManager->flush();
            }
            return $this->redirectToRoute('usuari');
        } catch (\Exception $e) {
            return $this->redirectToRoute('usuari');
        }

    }


}