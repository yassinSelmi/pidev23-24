<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EvenementRepository;

class CalendarController12Controller extends AbstractController
{
    #[Route('/calendar/controller12', name: 'app_calendar_controller12')]
    public function index(EvenementRepository $evenement)
    {
        $events = $evenement->findAll();
//dd($events);
        $rdvs = [];

        foreach($events as $event){
            $rdvs[] = [
                'id' => $event->getId(),
                'nom' => $event->getNom(),
                'date' => $event->getDate()->format('Y-m-d H:i:s'),
                'heure' => $event->getHeure()->format('Y-m-d H:i:s'),
                'nbreparticipants' => $event->getNbreparticipants(),
                'lieu' => $event->getLieu(),
                'type' => $event->getType(),
                'organisateur' => $event->getOrganisateur(),
                'prix' => $event->getPrix(),
            ];
        }
       

        $data = json_encode($rdvs);

        return $this->render('calendar_controller12/index.html.twig', compact('data'));
    }
}
