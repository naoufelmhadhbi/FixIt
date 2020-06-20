<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Demandeur;
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
        $id = $request->query->get('id');
        $n = $request->query->get('nom');
        $response = array('code'=>1,'message'=>'ok' , 'user1'=>md5('azerty') , 'idFromParam'=> $id , 'nom'=> $n);
        return new JsonResponse($response);
    }
    /**
     * @Route("/subscribe", name="createUserby")
     */
    public function showUserby(Request $request)
    {
        $usermane = $request->query->get('username');
        $password = $request->query->get('password');
        $email = $request->query->get('email');

        $userManager = $this->get('fos_user.user_manager');
        $entityManager = $this->get('doctrine')->getManager();
        $data = $request->request->all();
        // Do a check for existing user with userManager->findByUsername
        $user = $userManager->createUser();
        $user->setUsername($usermane);
        // ...
        $user->setPlainPassword($password);
        $user->setEmail($email);
        //$user->setEnabled(true);
        $userManager->updateUser($user);
        $response = array('code'=>1,'message'=>'user '.$usermane.' created');
        return new JsonResponse($response);
    }

    /**
     * @Route("/createDemandeur", name="createDemandeur")
     */
    public function createUserDemandeur(Request $request)
    {
        $user = new Demandeur();
        $user->setUsername("aze");
        $user->setPassword("aqw");
        $user->addRole("admin");
        $user->setUsername('$usermane');
        $user->setPlainPassword('12345678');
        $user->setEmail('skande@ep.com');
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new JsonResponse("ok");

    }


}
