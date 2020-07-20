<?php

namespace EvaluationBundle\Controller;

use AppBundle\Entity\Professionnel;
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

    //SELECT round(AVG(recommandation)) , id_prof FROM `feed_back` WHERE 1 GROUP by id_prof

    /**
     * @Route("/getMoyenneProf")
     */
    public function getMoyProf(Request $request){
        $em = $this->getDoctrine()->getManager();
        //$query = $em->createQuery("SELECT AVG(c.recommandation) c FROM EvaluationBundle:FeedBack group by c.id_prof");
        $repository = $em->getRepository('EvaluationBundle:FeedBack');
        $query = $repository->createQueryBuilder('c')
            ->select('avg(c.recommandation) as recommandation, IDENTITY(c.idProf) as idprofessionnel ,
            t.username as username, t.description as description,
            t.nom as nom , t.prenom as prenom')
            ->innerJoin('c.idProf','t')
            ->groupby('c.idProf')
            ->orderBy('recommandation','DESC')
            ->getQuery()
            ->getResult();

        $result = $query ; //->getArrayResult();

        if (empty($result)) {
            $response = array(
                'code' => 1,
                'message' => 'User Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($result);
    }
}
