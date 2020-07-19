<?php

namespace EvaluationBundle\Controller;

use AppBundle\Entity\Professionnel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('EvaluationBundle:Default:index.html.twig');
    }

    /**
     * @Route("/addFeedback/{idprof}")
     */
    public function addAction(Request $request,$idprof)

    {
        $em = $this->getDoctrine()->getManager();
        $prof=$em->getRepository(Professionnel::class)->find($idprof);
        //get content of data sent by ARC(or postman) tools
        $data = $request->getContent();
        //deserialize the data
        $feedback = $this->get('jms_serializer')->deserialize($data, 'EvaluationBundle\Entity\FeedBack', 'json');
        // added my data in data base
        $feedback->setIdProf($prof);
        // $feedback->setAvis("machabek");
        //$feedback->setRecommandation(8);
        $em->persist($feedback);
        $em->flush();
        return new Response('evaluation added successfully', 201);
        //you can use line number 37 or  line number 39
        // return new Response('product added successfully', Response::HTTP_CREATED);
    }
}
