<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



#[Route('/')]
class HomepageController extends BaseController
{
    #[Route('/', name: 'homepage')]

    #[Template()]
    public function index()
    {
        return ['controller_name' => 'HomepageController'];
    }

    #[Route('/save-data', name:'homepage_save_data')]
    public function saveData(Request $request) {
        $params = $request -> request -> all();
        dd($params);
    }

     
    #[Route('/backhome', name: 'backhome')]    
    public function backhome() {
        return $this->redirectToRoute('homepage');
    }



    #[Route(path: [
       'en' => '/contact-us',
       'nl' => '/neem-contact-op'
  ], name: 'contact')]
  public function contact(Request $request)
    {
        $locale = $request->getLocale();
        $msg = "This page is in English";
        if($locale == "nl") {
            $msg = "Deze pagina is in het Nederlands";
        }
        return new Response(
            "<html><body>$msg</body></html>"
        ); 
}

#[Route('/data.{_format}', name: 'api_output', requirements: ['_format' => 'xml|json'])]
public function api($_format) {
    $data = [
        ["id" => 1, "naam" => "Piet"],
        ["id" => 2, "naam" => "Wilma"],
        ["id" => 3, "naam" => "Harrie"]
    ];
    if($_format == "json") {
        return($this ->json($data));
    } else{ $d = "<data>";
        foreach($data as $record) {
                $id = $record["id"];
                $naam = $record["naam"];
                $d .= "<record id='$id'>$naam</record>";
        }   
        $d .= "</data>";
        return(new Response($d));

    }
}


}