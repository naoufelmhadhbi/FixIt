<?php

namespace PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('PortfolioBundle:Default:index.html.twig');
    }

    /**
     * @Route("/getAlldeplacementByUser", name="createUserDepla")
     */
    public function showByUsernameByDep(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $userId = 3 ;
        $repository = $em->getRepository('PortfolioBundle:Deplacement');
        $tags = $repository->createQueryBuilder('t')
            ->select('c.id as profId, t.id as depId')
            ->innerJoin('t.idProf', 'c')
            ->where('c.id = :user_id')
            ->setParameter('user_id', $userId)
            ->getQuery()
            ->getResult();

        
        return new JsonResponse($tags);
    }
}
