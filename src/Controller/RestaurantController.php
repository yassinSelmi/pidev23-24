<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Form\RestaurantType;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use MercurySeries\FlashyBundle\FlashyNotifier;


#[Route('/restaurant')]
class RestaurantController extends AbstractController
{



    
    #[Route('/pdf', name: 'app_pdf')]
    public function pdf(Request $request)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
    
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
    
        $repository = $this->getDoctrine()->getRepository(Restaurant::class);
        $restaurants = $repository->findAll();
    
        foreach ($restaurants as $restaurant) {
            $pathToImage = 'C:/Users/Nader/Desktop/integrzation n +y+w/integration/public/'. $restaurant->getImage();
            $imageData = base64_encode(file_get_contents($pathToImage));
            $restaurant->setImage($imageData); // Set the image data back to the restaurant object
        }
    
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('restaurant/pdf.html.twig', [
            'title' => "Welcome to our PDF Test",
            'restaurants' => $restaurants,
            'imageData' => $imageData, // Pass imageData to the view
        ]);
    
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
    
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A3', 'portrait');
    
        // Render the HTML as PDF
        $dompdf->render();
    
        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }
    





    #[Route('/', name: 'app_restaurant_index', methods: ['GET'])]
    public function index(RestaurantRepository $restaurantRepository, PaginatorInterface $paginator, Request $request,FlashyNotifier $flashy): Response
    {

        $flashy->primaryDark('Liste des restaurants', 'http://your-awesome-link.com');

        $donnees = $this->getDoctrine()
            ->getRepository(Restaurant::class)
            ->findBy([],['id' => 'desc']);

        $restaurants = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            2 // Nombre de résultats par page
        );




        return $this->render('restaurant/index.html.twig', [
            'restaurants' => $restaurants,
        ]);
    }




    #[Route('/new', name: 'app_restaurant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $restaurant = new Restaurant();
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        // controle de sasie
        if ($form->isSubmitted() && $form->isValid()) {


            //  im 
            $file = $form->get('image')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e){
            }
            $restaurant->setImage('uploads/images/'.$fileName);
            // upload image

            $entityManager->persist($restaurant);
            $entityManager->flush();

            return $this->redirectToRoute('app_restaurant_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->renderForm('restaurant/new.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form,
        ]);
    }








    #[Route('/{id}', name: 'app_restaurant_show', methods: ['GET'])]
    public function show(Restaurant $restaurant): Response
    {
        return $this->render('restaurant/show.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }





    #[Route('/{id}/edit', name: 'app_restaurant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Restaurant $restaurant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $file = $form->get('image')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e){
            }
            $restaurant->setImage('uploads/images/'.$fileName);



            $entityManager->flush();

            return $this->redirectToRoute('app_restaurant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('restaurant/edit.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_restaurant_delete', methods: ['POST'])]
    public function delete(Request $request, Restaurant $restaurant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$restaurant->getId(), $request->request->get('_token'))) {
            $entityManager->remove($restaurant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_restaurant_index', [], Response::HTTP_SEE_OTHER);
    }



    
    #[Route('/restofront/{id}', name: 'app_resto_front', methods: ['GET'])]
    public function showfront(Restaurant $restaurant): Response
    {
        return $this->render('restaurant/showrestofront.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }




        /**
     * @Route("/e/search_restaurant", name="search_restaurant", methods={"GET"})
     */
    public function search_restaurant(Request $request,NormalizerInterface $Normalizer,RestaurantRepository $RestaurantRepository ): Response
    {

        $requestString=$request->get('searchValue');
        $requestString2=$request->get('searchValue2');


        //   dump($requestString);
        //  dump($requestString2);
        $restaurants = $RestaurantRepository->findProduitsBySujet($requestString,$requestString2);
        //   dump($reclamations);
        $jsoncontentc =$Normalizer->normalize($restaurants,'json',['groups'=>'restaurants']);
        //  dump($jsoncontentc);
        $jsonc=json_encode($jsoncontentc);
        //   dump($jsonc);
        if(  $jsonc == "[]" )
        {
            return new Response(null);
        }
        else{        return new Response($jsonc);
        }

    }








    /**
     * @Route("/e/statyassin", name="statyassin", methods={"GET"})
     */
    public function reclamation_stat(RestaurantRepository $RestaurantRepository,FlashyNotifier $flashy): Response
    {

        $flashy->primaryDark('Statistique des nombre des restaurant selon specialité', 'http://your-awesome-link.com');

        $nbrs[]=Array();

        $e1=$RestaurantRepository->find_Nb_Rec_Par_Status("Francaise");
        dump($e1);
        $nbrs[]=$e1[0][1];
        $e2=$RestaurantRepository->find_Nb_Rec_Par_Status("Tunisienne");
        dump($e2);
        $nbrs[]=$e2[0][1];


        $e3=$RestaurantRepository->find_Nb_Rec_Par_Status("Italienne");
        dump($e3);
        $nbrs[]=$e3[0][1];


        
        $e4=$RestaurantRepository->find_Nb_Rec_Par_Status("Americaine");
        dump($e4);
        $nbrs[]=$e4[0][1];


        $e5=$RestaurantRepository->find_Nb_Rec_Par_Status("Syrien");
        dump($e5);
        $nbrs[]=$e5[0][1];


        dump($nbrs);
        reset($nbrs);
        dump(reset($nbrs));
        $key = key($nbrs);
        dump($key);
        dump($nbrs[$key]);

        unset($nbrs[$key]);

        $nbrss=array_values($nbrs);
        dump(json_encode($nbrss));

        return $this->render('restaurant/stat.html.twig', [
            'nbr' => json_encode($nbrss),
        ]);
    }




 
 







}
