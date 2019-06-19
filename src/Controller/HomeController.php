<?php


namespace App\Controller;

use App\Entity\Pizza;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; // Objet inclus dans symfony, va gérer les requetes
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{

    /**
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index() : Response
    {

        $pizzas = $this->getDoctrine()
            ->getManager()
            ->getRepository(Pizza::class)
            ->findBy([],['id'=>'DESC'],5,0);

        if (!$pizzas) {
            throw $this->createNotFoundException(
                "Il n'y a pas de boutique encore."
            );
        }

        return $this->render('index.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }
}