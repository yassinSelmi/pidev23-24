<?php
namespace App\Controller;
use App\Entity\Hotel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{
    #[Route('/chat', name: 'app_chat')]
    public function index(Request $request): Response
    {
        $userMessage = $request->request->get('user_message');
        $botResponse = $this->getBotResponse($userMessage);
    
        // Effacer les messages précédents de la session
        $request->getSession()->set('chat_history', []);
    
        // Ajouter les nouveaux messages en haut de la conversation
        $chatHistory = [];
        array_unshift($chatHistory, ['author' => 'User', 'message' => $userMessage]);
        array_unshift($chatHistory, ['author' => 'Bot', 'message' => $botResponse]);
    
        // Enregistrer l'historique dans la session
        $request->getSession()->set('chat_history', $chatHistory);
    
        return $this->render('chat/index.html.twig', [
            'chat_history' => $chatHistory,
        ]);
    }
    

    private function getBotResponse($userMessage)
    {
        // Définir les réponses prédéfinies
        $responses = [
            "Comment puis-je vous aider aujourd'hui ?",
            "Je suis un chatbot, que puis-je faire pour vous ?",
            "Posez-moi une question et je ferai de mon mieux pour vous aider.",
        ];
    
        // Vérifier si le message de l'utilisateur concerne les hôtels
        if (strpos($userMessage, "hôtel") !== false || 
            strpos($userMessage, "hotel") !== false || 
            strpos($userMessage, "hoel") !== false || 
            strpos($userMessage, "autel") !== false || 
            strpos($userMessage, "eautel") !== false || 
            strpos($userMessage, "wetla") !== false) {
            
            // Connexion à la base de données (ex: MySQL)
            $pdo = new \PDO('mysql:host=localhost;dbname=tourisme', 'root', '');
            
            // Préparation et exécution de la requête SQL
            $stmt = $pdo->query('SELECT nom FROM hotel');
            $hotels = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
            // Construire la réponse des hôtels
            $response = "Voici une liste des hôtels disponibles :";
            foreach ($hotels as $hotel) {
                $response .= $hotel['nom'] . ", ";
            }
        }
        // Vérifier si le message de l'utilisateur concerne les événements
        else if(strpos(strtolower($userMessage), "event") !== false ||               
                strpos(strtolower($userMessage), "evenement") !== false || 
                strpos(strtolower($userMessage), "évenement") !== false || 
                strpos(strtolower($userMessage), "evenment") !== false || 
                strpos(strtolower($userMessage), "evnmt") !== false ){
    
            $pdo = new \PDO('mysql:host=localhost;dbname=tourisme', 'root', '');
            
            // Préparation et exécution de la requête SQL
            $stmt = $pdo->query('SELECT nom FROM evenement');
            $events = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
            // Construire la réponse des événements
            $response = "Voici une liste des événements disponibles :";
            foreach ($events as $event) {
                $response .= $event['nom'] . ", ";
            }
        }
        // Vérifier si le message de l'utilisateur contient des termes liés aux restaurants
        else if (strpos($userMessage, "restaurant") !== false || 
strpos($userMessage, "resto") !== false || 
strpos($userMessage, "restauration") !== false || 
strpos($userMessage, "dîner") !== false || 
strpos($userMessage, "repas") !== false) {

// Connexion à la base de données (ex: MySQL)
$pdo = new \PDO('mysql:host=localhost;dbname=tourisme', 'root', '');

// Préparation et exécution de la requête SQL pour récupérer les noms des restaurants
$stmt = $pdo->query('SELECT nom_resto FROM restaurant');
$restaurants = $stmt->fetchAll(\PDO::FETCH_ASSOC);

// Construire la réponse des restaurants
$response = "Voici une liste des restaurants disponibles :";
foreach ($restaurants as $restaurant) {
    $response .= $restaurant['nom_resto'] . ", ";
}
}

        // Vérifier si le message de l'utilisateur contient des salutations
        else if(strpos(strtolower($userMessage), "bonjour") !== false || 
                strpos(strtolower($userMessage), "hello") !== false || 
                strpos(strtolower($userMessage), "bonsoir") !== false || 
                strpos(strtolower($userMessage), "shalom") !== false || 
                strpos(strtolower($userMessage), "salut") !== false){
                    
            // Choix aléatoire d'une réponse parmi les réponses prédéfinies
            $response = $responses[array_rand($responses)];
        }
    
        else {
            // Utiliser une réponse prédéfinie si le message ne concerne ni les hôtels ni les événements
            $response = "Désolé, je ne comprends pas votre question.";
        }
    
        // Rechercher l'hôtel ou l'événement correspondant au message de l'utilisateur
       // Connexion à la base de données
$pdo = new \PDO('mysql:host=localhost;dbname=tourisme', 'root', '');

// Vérifier si le message de l'utilisateur contient un nom d'hôtel connu
$stmt = $pdo->prepare('SELECT * FROM hotel');
$stmt->execute();
$hotels = $stmt->fetchAll(\PDO::FETCH_ASSOC);

foreach ($hotels as $hotel) {
    // Vérifier si le nom de l'hôtel est présent dans la phrase de l'utilisateur
    if (stripos($userMessage, $hotel['nom']) !== false) {
        // Construction de la réponse pour l'hôtel trouvé
        $response = "Voici les détails de l'hôtel " . $hotel['nom'] . ":\n"
            . "Adresse: " . $hotel['addresse'] . "\n"
            . "Ville: " . $hotel['ville'] . "\n"
            . "Étoiles: " . $hotel['etoile'] . "\n"
            . "Équipements: " . $hotel['equipement'] . "\n"
            . "Disponibilité: " . $hotel['disponibliter'];
             

        return $response;
    }
}


// Préparation et exécution de la requête SQL pour récupérer les restaurants
$stmt = $pdo->prepare('SELECT * FROM restaurant');
$stmt->execute();
$restaurants = $stmt->fetchAll(\PDO::FETCH_ASSOC);

foreach ($restaurants as $restaurant) {
    // Vérifier si le nom du restaurant est présent dans la phrase de l'utilisateur
    if (stripos($userMessage, $restaurant['nom_resto']) !== false) {
        // Construction de la réponse pour le restaurant trouvé
        $response = "Voici les détails du restaurant " . $restaurant['nom_resto'] . ":\n"
            . "Adresse: " . $restaurant['adresse_resto'] . "\n"
            . "Numéro de téléphone: " . $restaurant['numero_resto'] . "\n"
            . "Spécialité: " . $restaurant['specialtie'] . "\n"
            . "Nombre de fourchettes: " . $restaurant['nombre_fourchette'] . "\n"
            . "Fourchette de prix: " . $restaurant['fourchette_de_prix'] . "\n"
            . "Heure d'ouverture: " . $restaurant['heure_ouverture'] . "\n"
            . "Heure de fermeture: " . $restaurant['heure_fermeture'];

        return $response;
    }
}

// Si aucun restaurant correspondant n'est trouvé, vous pouvez retourner un message approprié ou poursuivre avec d'autres actions.
     // Vérifier si le message de l'utilisateur contient un nom d'événement connu
$stmt = $pdo->prepare('SELECT * FROM evenement');
$stmt->execute();
$evenements = $stmt->fetchAll(\PDO::FETCH_ASSOC);

foreach ($evenements as $evenement) {
    // Vérifier si le nom de l'événement est présent dans la phrase de l'utilisateur
    if (stripos($userMessage, $evenement['nom']) !== false) {
        // Construction de la réponse pour l'événement trouvé
        $response = "Voici les détails de l'événement " . $evenement['nom'] . ":\n"
            . "Date: " . $evenement['date'] . "\n"
            . "Heure: " . $evenement['heure'] . "\n"
            . "Durée: " . $evenement['dure'] . "\n"
            . "Nombre de participants: " . $evenement['nbreparticipants'] . "\n"
            . "Lieu: " . $evenement['lieu'] . "\n"
            . "Type: " . $evenement['type'] . "\n"
            . "Organisateur: " . $evenement['organisateur'] . "\n"
            . "Prix de ticket: " . $evenement['prix'];

        return $response;
    }
}
if (strpos($userMessage, "yacine") !== false) {
    $response="c'est un ostoura";
}
    

return $response;

    }
    
    #[Route('/clear-messages', name: 'clear_messages')]
    public function clearMessages(Request $request): RedirectResponse
    {
        // Effacer les messages précédents en supprimant l'historique de la session
        $request->getSession()->set('chat_history', []);
    
        // Rediriger vers la page d'accueil du chat
        return $this->redirectToRoute('app_chat');
    }
}
