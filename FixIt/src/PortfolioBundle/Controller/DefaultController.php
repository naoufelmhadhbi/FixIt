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
     * @Route("/getAlldeplacementByUser/{id}", name="createUserDepla")
     */
    public function showByUsernameByDep(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $userId = $id ;
        $repository = $em->getRepository('PortfolioBundle:Deplacement');
        $tags = $repository->createQueryBuilder('t')
            ->select('c.id as profId, t.id as depId , t.gouvernorat as gouvernorat')
            ->innerJoin('t.idProf', 'c')
            ->where('c.id = :user_id')
            ->setParameter('user_id', $userId)
            ->getQuery()
            ->getResult();

        return new JsonResponse($tags);
    }

    /**
     * @Route("/getAllDeplacement", name="getAllDeplacement")
     */
    public function getAllDeplacement(){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT c FROM PortfolioBundle:Deplacement c');
        $users = $query->getArrayResult();
        if (empty($users)) {
            $response = array(
                'code' => 1,
                'message' => 'User Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($users);
    }
}
