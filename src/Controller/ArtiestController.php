<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Artiest;

class ArtiestController extends AbstractController
{
  
    #[Route('/artiest', name: 'artiest')]
    public function index(): Response
    {
       /// We simuleren hier even een $_POST van een formulier
       $artiest = [
        "naam" => "AniMe",
        "genre" => "Hardcore",
        "omschrijving" => "1017PH",
        "afbeelding_url" => "Amsterdam",
        "website" => "example.com",
       ];

       $rep = $this->getDoctrine()->getRepository(Artiest::class);
       $result = $rep->saveArtiest($artiest);

       dd($result);

    }
}