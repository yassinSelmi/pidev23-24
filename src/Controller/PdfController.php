<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EvenementRepository;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends AbstractController
{
    #[Route('/pdf/{id}', name: 'app_pdf')]
    public function generatePdf(Request $request, EvenementRepository $evenementRepository, int $id): Response
    {
        // Récupérer l'événement depuis la base de données
        $evenement = $evenementRepository->find($id);

        // Vérifier si l'événement existe
        if (!$evenement) {
            throw $this->createNotFoundException('Aucun événement trouvé pour cet ID');
        }

        // Créer le contenu HTML pour le PDF
        $html = $this->renderView('pdf/index.html.twig', [
            'evenement' => $evenement,
        ]);

        // Options pour Dompdf (facultatif)
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        // Créer une instance de Dompdf
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        // Rendre le PDF
        $dompdf->render();

        // Envoyer le PDF en réponse
        $response = new Response($dompdf->output());
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment; filename="details_evenement.pdf"');

        return $response;
    }
}
