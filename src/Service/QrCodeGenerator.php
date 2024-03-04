<?php
 
 namespace App\Service;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;

use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Writer\Result\ResultInterface;
use Endroid\QrCode\Writer\SvgWriter;
use App\Entity\User;


class QrCodeGenerator 
{
 
public function createQrCode( User $user): ResultInterface
{
    // Récupérez les informations du patient
    $id = $user->getId();
    $nom = $user->getNom();
    $prenom = $user->getPrenom();
    $email = $user->getEmail();
   
    $info = "
    $id
    $prenom
    $nom
    $email
   
    ";

    // Générez le code QR avec les informations du patient
    $result = Builder::create()
        ->writer(new SvgWriter())
        ->writerOptions([])
        ->data($info)
        ->encoding(new Encoding('UTF-8'))
        ->size(200)
        ->margin(10)
        ->labelText('Vous trouvez vos informations ici')
        ->labelFont(new NotoSans(20))
        ->validateResult(false)
        ->build();

    return $result;
}}