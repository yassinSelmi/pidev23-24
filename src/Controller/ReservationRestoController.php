<?php

namespace App\Controller;

use App\Entity\ReservationResto;
use App\Form\ReservationRestoType;
use App\Repository\ReservationRestoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

#[Route('/reservation/resto')]
class ReservationRestoController extends AbstractController
{
    #[Route('/', name: 'app_reservation_resto_index', methods: ['GET'])]
    public function index(ReservationRestoRepository $reservationRestoRepository): Response
    {
        return $this->render('reservation_resto/index.html.twig', [
            'reservation_restos' => $reservationRestoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservation_resto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationResto = new ReservationResto();
        $form = $this->createForm(ReservationRestoType::class, $reservationResto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationResto);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_resto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_resto/new.html.twig', [
            'reservation_resto' => $reservationResto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_resto_show', methods: ['GET'])]
    public function show(ReservationResto $reservationResto): Response
    {
        return $this->render('reservation_resto/show.html.twig', [
            'reservation_resto' => $reservationResto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_resto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationResto $reservationResto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationRestoType::class, $reservationResto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_resto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_resto/edit.html.twig', [
            'reservation_resto' => $reservationResto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_resto_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationResto $reservationResto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationResto->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservationResto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_resto_index', [], Response::HTTP_SEE_OTHER);
    }



    #[Route('/book/front', name: 'app_reservation_resto_book', methods: ['GET', 'POST'])]
    public function book(Request $request, EntityManagerInterface $entityManager): Response
    {



        $reservationResto = new ReservationResto();
        $form = $this->createForm(ReservationRestoType::class, $reservationResto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($reservationResto);
            $entityManager->flush();

            return $this->redirectToRoute('app_template_front_restaurants', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_resto/book.html.twig', [
            'reservation_resto' => $reservationResto,
            'form' => $form,
        ]);
    }





}
