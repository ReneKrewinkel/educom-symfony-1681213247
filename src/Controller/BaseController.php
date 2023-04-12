<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;



class BaseController extends AbstractController
{
    private $logger;
    
    protected function log($msg, $type = 'info') {
        switch ($type) {
            case 'info': {
                $this->logger->info($msg);
                break;
            }

            case 'warning': {
                $this ->logger->warning($msg);
                break;
            }

            case 'error': {
                $this -> logger -> error($msg);
                break;
            }
        } 
    }
    
    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    } 
}
