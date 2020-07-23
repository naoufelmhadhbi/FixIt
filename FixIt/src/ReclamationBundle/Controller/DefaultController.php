<?php

namespace ReclamationBundle\Controller;

use AppBundle\Service\Validate;
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
     * @Route("reclamation/add/{id_user}", name="add_reclamation")
     * @Method("POST")
     */
    public function addReclamationAction(Request $request, $id_user)
    {
        /*echo "<pre>";
        //print_r($_SESSION);
        echo "</pre>";
        die();*/
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find(intval($id_user));

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

//        $reclamations = $em->getRepository(Reclamation::class)->findAll();
//        $json_object = $this->get('jms_serializer')->serialize($reclamations, 'json');
//
//        return new Response($json_object, 201);
        $rec = $em->createQuery('SELECT s FROM ReclamationBundle:Reclamation s');
        $res = $rec->getArrayResult();
        if (empty($res)) {
            $response = array(
                'code' => 1,
                'message' => 'image Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
            return new JsonResponse($res);
        }

        /**
         * @Route("reclamation/findByUser/{id_User}", name="find_by_user_reclamation")
         * @Method("GET")
         */

        public
        function findReclamationByUser($id_User)
        {
//        $em = $this->getDoctrine()->getManager();
//        $user = $em->getRepository(User::class)->find($user_id);
//        $reclamations = $em->getRepository(Reclamation::class)->findBy(["idUser" => $user]);
//        $json_object = $this->get('jms_serializer')->serialize($reclamations, 'json');
//
//        return new Response($json_object, 201);
            $em = $this->getDoctrine()->getManager();
            $rec = $em->createQuery('SELECT c FROM ReclamationBundle:Reclamation c where c.idUser = ' . $id_User);
            $res = $rec->getArrayResult();
            if (empty($res)) {
                $response = array(
                    'code' => 1,
                    'message' => 'image Not found !',
                    'errors' => null,
                    'result' => null
                );
                return new JsonResponse($response, Response::HTTP_NOT_FOUND);
            }
            return new JsonResponse($res);

        }

        /**
         * @Route("reclamation/findById/{id}", name="find_by_id_reclamation")
         * @Method("GET")
         */

        public function findReclamationById($id)
        {
            $em = $this->getDoctrine()->getManager();
            $rec = $em->getRepository(Reclamation::class)->find($id);
            $json_object = $this->get('jms_serializer')->serialize($rec, 'json');

            return new Response($json_object, 201);

        }

        /**
         * @Route("reclamation/deleteByRecId/{id}", name="delete_by_user_reclamation")
         * @Method("GET")
         */
        public
        function deleteReclamationAction(Request $request)
        {
            $id = $request->get('id');
            $em = $this->getDoctrine()->getManager();
            $reclamation = $em->getRepository(Reclamation::class)->find($id);
            $em->remove($reclamation);
            $em->flush();

            return new JsonResponse(['msg' => 'deleted with succes!'], 200);
        }

        /**
         * @Route("reclamation/rep/{id}", name="rep_reclamation")
         * @Method("PUT")
         */
        public
        function repReclamationAction(Request $request, $id)

        {
            $rec = $this->getDoctrine()->getRepository('ReclamationBundle:Reclamation')->find($id);
            if (empty($rec)) {
                $response = array(
                    'code' => 1,
                    'message' => 'Reclamation Not found !',
                    'errors' => null,
                    'result' => null
                );
                return new JsonResponse($response, Response::HTTP_NOT_FOUND);
            }
            $body = $request->getContent();
            $parametersAsArray = [];
            if ($body) {
                $parametersAsArray = json_decode($body, true);
            }
            $reprec = $parametersAsArray['RepRec'];
            $rec->setRepRec($reprec);
            $em = $this->getDoctrine()->getManager();
            $em->persist($rec);
            $em->flush();
            $response = array(
                'code' => 0,
                'message' => ' Reponse ajputée avec succes!',
                'errors' => $reprec,
                'result' => null
            );
            return new JsonResponse($response, 200);
        }

    /**
     * @Route("/getreclama/{id_User}")
     */
    public function getReclama($id_User){
        $em = $this->getDoctrine()->getManager();
        //$query = $em->createQuery("SELECT AVG(c.recommandation) c FROM EvaluationBundle:FeedBack group by c.id_prof");
        $repository = $em->getRepository('ReclamationBundle:Reclamation');
        $query = $repository->createQueryBuilder('c')
            ->select('IDENTITY(c.idUser) as iduser ,
            t.username as username, t.email, c.sujet , c.message , c.RepRec, c.id ,
            t.nom as nom , t.prenom as prenom')
            ->innerJoin('c.idUser','t')
            ->where('c.idUser = ' . $id_User)
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
     * @Route("/getallreclama/")
     */
    public function getallReclama(){
        $em = $this->getDoctrine()->getEntityManager();
        $tags = $em->getRepository('ReclamationBundle:Reclamation')->getRec();
        $data = $this->get('jms_serializer')->serialize($tags, 'json');
        $response = new Response($data);
        return $response;
    }


}
