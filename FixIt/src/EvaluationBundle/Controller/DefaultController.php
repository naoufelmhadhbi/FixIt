<?php

namespace EvaluationBundle\Controller;

use AppBundle\Entity\Professionnel;
use AppBundle\Entity\User;
use EvaluationBundle\Entity\FeedBack;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/add/{idprof}")
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
//    /**
//     * @Route("/update/{idprof}")
//     */
//    public function updateAction(Request $request, $idprof)
//    {
//
//        $doctrine = $this->getDoctrine();
//        $manager = $doctrine->getManager();
//        $evaluation = $doctrine->getRepository(FeedBack::class)
//            ->find($idprof);
//        $data = $request->getContent();
//        $feedback = $this->get('jms_serializer')->deserialize($data, 'EvaluationBundle\Entity\FeedBack', 'json');
//
//        $evaluation->setRecommandation($feedback->getRecommandation());
//        $evaluation->setAvis($feedback->getAvis());
//        $evaluation->setIdProf($feedback->getIdProf());
//        $evaluation->setContent($feedback->getContent());
//
//        $manager->persist($evaluation);
//        $manager->flush();
//
//        return new JsonResponse(['msg' => 'succes!'], 200);
//    }
//
//    /**
//     * @Route("/delete/{idprof}")
//     */
//    public function deleteEvaluationAction(Request $request)
//    {
//        $idprof = $request->get('id');
//        $em = $this->getDoctrine()->getManager();
//        $feedback = $em->getRepository(FeedBack::class)->find($idprof);
//        $em->remove($feedback);
//        $em->flush();
//
//        return new JsonResponse(['msg' => 'deleted with succes!'], 200);
//    }

    /**
     * @Route("/getfeedback/{idprof}")
     */
    public function getFeedback($idprof){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT c FROM EvaluationBundle:FeedBack c where c.idProf = '.$idprof);
        $feedback = $query->getArrayResult();
        if (empty($feedback)) {
            $response = array(
                'code' => 1,
                'message' => 'Professionnel Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($feedback);
    }

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

    /**
     * @Route("/getFeedBachByUserId/{idprof}", name="getFeedBachByUserId")
     */
    public function getFeedBachByUserId($idprof){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT m FROM EvaluationBundle:FeedBack m where m.idProf = '.$idprof);
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
