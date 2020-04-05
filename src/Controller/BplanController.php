<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Bplan;
use App\Form\BplanType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class BplanController extends AbstractController
{
    
    public function index()
    {
        $plans = $this->getDoctrine()->getRepository(Bplan::class)->findAll();


               return $this->render('bplan/index.html.twig', ['plans' => $plans]);
    }

    public function add(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
    	$bplan = new Bplan();

    	$form = $this->createForm(BplanType::class, $bplan);

        $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {

            $bplan->setUdate(new \DateTime());
            $bplan->setCreatedAt(new \DateTime());

            if ($bplan->getPicture() !== null) {

                $file = $form->get('picture')->getData();
                $fileName =  uniqid(). '.' .$file->guessExtension();

                 try {
                    $file->move(
                        $this->getParameter('images_directory'), // Le dossier dans le quel le fichier va etre charger
                        $fileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }
                 $bplan->setPicture($fileName);

        }
        $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($bplan); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete
            return new Response('Le formulaire a été soumis...');
        }

    	return $this->render('bplan/add.html.twig', [
            'form' => $form->createView()
        ]);
    }


    public function show(BPlan $bplan)
    {
    	return $this->render('bplan/show.html.twig', [
            'bplan' => $bplan
        ]);
    }

     public function edit(Bplan $bplan, Request $request)
    {

         $this->denyAccessUnlessGranted('ROLE_ADMIN'); 
       $oldPicture = $bplan->getPicture();

       $form = $this->createForm(BplanType::class, $bplan);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
            $bplan->setUdate(new \DateTime());

                 if ($bplan->getPicture() !== null && $bplan->getPicture() !== $oldPicture) {
                $files = $form->get('picture')->getData();
                $fileName = uniqid(). '.' .$files->guessExtension();

                try {
                    $files->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );
                }catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $bplan->setPicture($fileName);
               } else {
                $bplan->setPicture($oldPicture);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($bplan);
            $em->flush();

             return new Response('L\'article a bien été modifier.');
        }

    
    	return $this->render('bplan/edit.html.twig', [
            'bplan' => $bplan,
            'form' => $form->createView()
           
        ]);
    }

    public function remove($id)
    {
         $this->denyAccessUnlessGranted('ROLE_ADMIN');
    	return new Response('<h1>Supprimer l\'article ' .$id. '</h1>');
    }

    public function admin()
    {
        $bplans = $this->getDoctrine()->getRepository(Bplan::class)->findBy(
            [],
            ['id' => 'DESC']
        );

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'bplans' => $bplans,
            'users' => $users
        ]);
    }

   
}
