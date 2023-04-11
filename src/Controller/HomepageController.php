<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/')]
class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    #[Template()]
    public function index()
    {
        return ['controller_name' => 'HomepageController'];
    }

     
    #[Route('/backhome', name: 'backhome')]    
    public function backhome() {
        return $this->redirectToRoute('homepage');
    }



    #[Route('/blog', name: 'blog_list')]
 

    #[Route('/show/{id}', name: "blog_show")]
    public function show($id = 17) {
        dd($id);
    }

}