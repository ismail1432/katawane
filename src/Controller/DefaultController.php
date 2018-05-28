<?php


namespace App\Controller;


use App\Loader\DomLoader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(DomLoader $domLoader)
    {
        dump($domLoader->loader('https://fr.wikipedia.org/wiki/Wikip%C3%A9dia:Image_du_jour/mai_2018'));die;
        return $this->render('index.html.twig');
    }
}