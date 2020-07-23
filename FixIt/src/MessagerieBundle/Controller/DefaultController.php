<?php

namespace MessagerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        $data = $request->getContent();
        $message = $this->get('jms_serializer')->deserialize($data, 'MessagerieBundle\Entity\Messagerie', 'json');
        $message->setDateEnvoi(new \DateTime);

        $em->persist($message);
        $em->flush();

        $response = array('Code'=>1,'Success'=>'True' , 'Message'=>'message '.$message->getMessage().' a été envoyé');
        return new JsonResponse($response);
    }

    /**
     * @Route("/getMessagesByUser", name="listMessageByUser")
     */
    public function getMessagesByUser(Request $request){
        $idDemandeur = $request->query->get('id_demandeur') ;
        $idProfessionnel = $request->query->get('id_professionnel') ;
        $em = $this->getDoctrine()->getManager();

//        $query = $em->createQuery('SELECT c FROM MessagerieBundle:Messagerie c');
//        if($idDemandeur != null)
//            $query = $em->createQuery('SELECT c FROM MessagerieBundle:Messagerie c where c.idDemandeur = '.$idDemandeur);
//        if($idProfessionnel != null)
//            $query = $em->createQuery('SELECT c FROM MessagerieBundle:Messagerie c where c.idProfessionnel = '.$idProfessionnel);
//        if($idProfessionnel != null && $idDemandeur != null)
            $query = $em->createQuery("SELECT c FROM MessagerieBundle:Messagerie c where c.idProfessionnel = '".$idProfessionnel."' and c.idDemandeur = '".$idDemandeur."'");

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
        //$response = new Response();
        //$response->setContent(json_encode($users));
        //$response->headers->set('Content-Type', 'application/json');
    // Allow all websites
        //$response->headers->set('Access-Control-Allow-Origin', '*');
        //$users->header->set('Access-Control-Allow-Origin', '*');
        return new JsonResponse($users); // $response
    }

    /**
     * @Route("/getAllUseri", name="listAllUSERi")
     */
    public function getAllUseri(){
        $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery('SELECT m FROM AppBundle:Professionnel c , MessagerieBundle:Messagerie m 
            where m.idProfessionnel = c.id');
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

    /**
     * @Route("/countNbrVuByUser", name="countNbrVuByUser")
     */
    public function countNbrVuByUser(Request $request){
        $idDemandeur = $request->query->get('id_demandeur') ;
        $idProfessionnel = $request->query->get('id_professionnel') ;
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT count(m) as nbrvu FROM MessagerieBundle:Messagerie m where m.vu = 0 
                    and m.idProfessionnel = '".$idProfessionnel."' and m.idDemandeur = '".$idDemandeur."'");

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

    /**
     * @Route("/updateVuByUser", name="updateVuByUser")
     */
    public function updateVuByUser(Request $request){
        $idDemandeur = $request->query->get('id_demandeur') ;
        $idProfessionnel = $request->query->get('id_professionnel') ;
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT c FROM MessagerieBundle:Messagerie c where c.idProfessionnel = '".$idProfessionnel."' and c.idDemandeur = '".$idDemandeur."'");

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
        foreach($query->getResult() as $msg){
            $msg->setVu(true);
            $em->flush();
        }
        return new JsonResponse($users);
    }


}
