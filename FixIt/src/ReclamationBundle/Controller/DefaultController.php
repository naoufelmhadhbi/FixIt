<?php

namespace ReclamationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use ReclamationBundle\Entity\Reclamation;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('ReclamationBundle:Default:index.html.twig');
    }

    /**
     * @Route("reclamation/add", name="add_reclamation")
     * @Method("POST")
     */

    public function addReclamationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find(7);

        //get content of data sent by ARC(or postman) tools
        $data = $request->getContent();
        //deserialize the data
        $Reclamation = $this->get('jms_serializer')->deserialize($data, 'ReclamationBundle\Entity\Reclamation', 'json');
        // added my data in data base
        $Reclamation->setIdUser($user);
        $em->persist($Reclamation);

        $em->flush();
        return new Response('Reclamation added successfully', 201);

    }

    /**
     * @Route("reclamation/findAll", name="find_all_reclamation")
     * @Method("GET")
     */

    public function findAll()
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository(Reclamation::class)->findAll();
        $json_object = $this->get('jms_serializer')->serialize($reclamations, 'json');

        return new Response($json_object, 201);

    }

    /**
     * @Route("reclamation/findByUser/{user_id}", name="find_by_user_reclamation")
     * @Method("GET")
     */

    public function findReclamationByUser($user_id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($user_id);
        $reclamations = $em->getRepository(Reclamation::class)->findBy(["idUser"=>$user]);
        $json_object = $this->get('jms_serializer')->serialize($reclamations, 'json');

        return new Response($json_object, 201);

    }

    /**
     * @Route("reclamation/deleteByRecId/{id}", name="delete_by_user_reclamation")
     * @Method("GET")
     */
    public function deleteReclamationAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository(Reclamation::class)->find($id);
        $em->remove($reclamation);
        $em->flush();

        return new JsonResponse(['msg' => 'deleted with succes!'], 200);
    }



}
