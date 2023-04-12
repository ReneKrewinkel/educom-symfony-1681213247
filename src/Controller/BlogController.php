<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



#[Route('/blog')]
class BlogController extends BaseController
{
  
    #[Template()]
    public function index()
    {
        return ['controller_name' => 'BlogController'];
    }


    #[Route('/{page}', name: 'blog_list', requirements: ['page' => '\d+'])]
    public function list($page){
        dump($page);
        $this->log("info Message from extended BaseController");       
        dd('page');
        
    }

    #[Route('/{slug}', name: 'blog_show')]
    public function slug($slug) {
        dump($slug);
        $this->log("info Message from extended BaseController");       
        dd('slug');
        
    }




    // #[Template()]
    // public function index()
    // {
    //     return ['controller_name' => 'BlogController'];
    // }

    // #[Route('/show/{id}', name: "blog_show")]
    // public function show(LoggerInterface $logger, $id = 17) {
        
    //     $logger -> info ('info Message');
    //     $logger -> warning('warning Message');
    //     $logger -> error('De waarde van id is: {$id}');

    //     dd($id);
    // }


}