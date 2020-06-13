<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserOld;
use AppBundle\UserServices\UserService;
use Services\ServiceManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/api/create", name="createUseri")
     */
    public function createUser(Request $request)
    {
        $user = new UserOld();
        $user->setUsername("aze");
        $user->setPassword("aqw");
        $user->setRoles("admin");
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new JsonResponse("ok");

    }
    
    /**
     * @Route("/show", name="createUser")
     */
    public function showUser(Request $request)
    {
        $response = array('code'=>1,'message'=>'ok' , 'user1'=>md5('azerty'));
        return new JsonResponse($response);
    }


}
