<?php

namespace MessagerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use MessagerieBundle\Entity\Messagerie;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('MessagerieBundle:Default:index.html.twig');
    }

    /**
     * @Route("/msg/show", name="msg")
     */
    public function showUsera(Request $request)
    {
        $response = array('code'=>1,'message'=>'msg');
        return new JsonResponse($response);
    }

    /**
     * @Route("/msg/sendMessage", name="msg")
     */
    public function sendMessage(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $message = new Messagerie();
        $message->setMessage($request->query->get('message'));
        $message->setIdDemandeur($request->query->get('idDemandeur'));
        $message->setIdProfessionnel($request->query->get('idProfessionnel'));
        $message->setVu($request->query->get('vu'));

        $em->persist($message);
        $em->flush();

        $response = array('Code'=>1,'Success'=>'True' , 'Message'=>'message '.$message->getMessage().' a été envoyé');
        return new JsonResponse($response);
    }
}
