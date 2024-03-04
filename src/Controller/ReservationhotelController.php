<?php

namespace App\Controller;

use App\Entity\Reservationhotel;
use App\Form\ReservationhotelType;
use App\Repository\ReservationhotelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

#[Route('/reservationhotel')]
class ReservationhotelController extends AbstractController
{
    #[Route('/afff', name: 'app_reservationhotel_index', methods: ['GET'])]
    public function index(ReservationhotelRepository $reservationhotelRepository): Response
    {
        return $this->render('reservationhotel/index.html.twig', [
            'reservationhotels' => $reservationhotelRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservationhotel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationhotel = new Reservationhotel();
        $form = $this->createForm(ReservationhotelType::class, $reservationhotel);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Calculate reservation price
            $nbPersonne = $reservationhotel->getNbPersonne();
            $nbNuit = $reservationhotel->getNbNuit();
            $prix = $nbPersonne * 50 * $nbNuit;
    
            // Set the calculated price in the Reservationhotel entity
            $reservationhotel->setPrix($prix);
    
            // Persist and flush the entity
            $entityManager->persist($reservationhotel);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_affichefront', [], Response::HTTP_SEE_OTHER);
        }
    
        // Add a textarea to display the reservation price
        $form->add('prix', TextType ::class, [
            'label' => 'Reservation Price',
            'data' => $reservationhotel->getPrix(), // Assuming you have a getprix method in your entity
            'attr' => ['readonly' => true],
        ]);
    
        return $this->renderForm('reservationhotel/new.html.twig', [
            'reservationhotel' => $reservationhotel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservationhotel_show', methods: ['GET'])]
    public function show(Reservationhotel $reservationhotel): Response
    {
        return $this->render('reservationhotel/show.html.twig', [
            'reservationhotel' => $reservationhotel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservationhotel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservationhotel $reservationhotel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationhotelType::class, $reservationhotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservationhotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservationhotel/edit.html.twig', [
            'reservationhotel' => $reservationhotel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservationhotel_delete', methods: ['POST'])]
    public function delete(Request $request, Reservationhotel $reservationhotel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationhotel->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservationhotel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservationhotel_index', [], Response::HTTP_SEE_OTHER);
    }
}
