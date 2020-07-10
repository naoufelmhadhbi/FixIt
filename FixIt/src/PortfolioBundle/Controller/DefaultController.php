<?php

namespace PortfolioBundle\Controller;


use AppBundle\Entity\Professionnel;
use AppBundle\Entity\User;
use AppBundle\Service\Validate;
use PortfolioBundle\Entity\Deplacement;
use PortfolioBundle\Entity\Metier;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @Route("/portfolio/addImage/{id}", name="add_image")
     * @Method("POST")
     */
    public function addImageAction(Request $request, $id)
    {
        $data = $request->getContent();
        $image = $this->get('jms_serializer')->deserialize($data, 'PortfolioBundle\Entity\Portfolio', 'json');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find(intval($id));
        $image->setIdProf($user);
        $em->persist($image);
        $em->flush();


        return new Response('image added successfully', 201);


    }

    /**
     * @Route("/portfolio/deleteImage/{id_image}",name="delete_image")
     * @Method({"DELETE"})
     */
    public function deleteIamge(Request $request, $id_image)
    {
        $image = $this->getDoctrine()->getRepository('PortfolioBundle:Portfolio')->find($id_image);
        if (empty($image)) {
            $response = array(
                'code' => 1,
                'message' => 'image Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
//        $this->container->get('logger')->info(
//            sprintf("New user idddddddd: %s", $user->getId())
//        );
        $em = $this->getDoctrine()->getManager();
        $em->remove($image);
        $em->flush();
        $response = array(
            'code' => 0,
            'message' => 'image deleted !' . $image,
            'errors' => null,
            'result' => null
        );

        return new JsonResponse($response, 200);
    }

    /**
     * @param Request $request
     * @param $id_image
     * @Route("/portfolio/editImage/{id_image}",name="update_image")
     * @Method({"PUT"})
     * @return JsonResponse
     */
    public function updateImage(Request $request, $id_image, Validate $validate)
    {
        $image = $this->getDoctrine()->getRepository('PortfolioBundle:Portfolio')->find($id_image);
        if (empty($image)) {
            $response = array(
                'code' => 1,
                'message' => $image->getImage() . ' Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        $body = $request->getContent();

        $data = $this->get('jms_serializer')->deserialize($body, 'PortfolioBundle\Entity\Portfolio', 'json');

        $reponse = $validate->validateRequest($data);
        if (!empty($reponse)) {
            return new JsonResponse($reponse, Response::HTTP_BAD_REQUEST);
        }

        $image->setImage($data->getImage());

        $em = $this->getDoctrine()->getManager();
        $em->persist($image);
        $em->flush();
        $response = array(
            'code' => 0,
            'message' => $image->getImage() . ' updated!',
            'errors' => null,
            'result' => null
        );
        return new JsonResponse($response, 200);
    }

    /**
     * @Route("/portfolio/getImages/{id_prof}", name="listimages")
     */
    public function getImagesPerProf($id_prof)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT c FROM PortfolioBundle:Portfolio c where c.idProf = ' . $id_prof);
        $images = $query->getArrayResult();
        if (empty($images)) {
            $response = array(
                'code' => 1,
                'message' => 'image Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($images);
    }


    /**
     * @Route("/portfolio/addMetier/{id_prof}/{id_dep}", name="add_metier")
     * @Method("POST")
     */

    public function addMetierAction($id_prof, $id_metier)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $prof = $em->getRepository(User::class)->find($id_prof);
        $metier = $em->getRepository(Metier::class)->find($id_metier);

        $prof->addMetiers($metier);

        $em->flush();


        return new Response('metier added successfully', 201);
    }

    /**
     * @Route("/portfolio/Updatemetier/{id_prof}", name="update_metier")
     * @Method("PUT")
     */
    public function UpdateMetierAction($id_prof)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $prof = $em->getRepository(User::class)->find($id_prof);
        $metier = array();

        foreach (array(2) as $metier_id) {
            $metier[$metier_id] = $em->getReference('PortfolioBundle\Entity\Metier', $metier_id);
        }

        $prof->setMetier($metier);
        $em->persist($prof);
        $em->flush();


        return new Response('metier updated successfully', 201);
    }

    /**
     * @Route("/portfolio/deleteMetier/{id_prof}/{id_metier}",name="delete_metier")
     * @Method({"DELETE"})
     */
    public function deleteMetier($id_prof, $id_metier)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $prof = $em->getRepository(User::class)->find($id_prof);
        $metier = $em->getRepository(Metier::class)->find($id_metier);

        $prof->removeProfMetier($metier);
        $em->flush();


        return new Response('metier deleted successfully', 201);
    }

    /**
     * @Route("/portfolio/getAllMetierByUser/{id}", name="createUserMetla")
     */
    public function showByUsernameByMet(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $userId = $id ;
        $repository = $em->getRepository('PortfolioBundle:Metier');
        $tags = $repository->createQueryBuilder('t')
            ->select('c.id as profId, t.id as metId , t.nom as metier')
            ->innerJoin('t.idProf', 'c')
            ->where('c.id = :user_id')
            ->setParameter('user_id', $userId)
            ->getQuery()
            ->getResult();
        return new JsonResponse($tags);
    }


    /**
     * @Route("/portfolio/addDeplacement/{id_prof}/{id_dep}", name="add_deplacement")
     * @Method("POST")
     */
    public function addDeplacementAction($id_prof, $id_dep)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $prof = $em->getRepository(User::class)->find($id_prof);
        $deplacement = $em->getRepository(Deplacement::class)->find($id_dep);

        $prof->addDeplacement($deplacement);

        $em->flush();


        return new Response('deplacement added successfully', 201);
    }

    /**
     * @Route("/portfolio/deleteDeplacement/{id_prof}/{id_dep}",name="delete_deplacement")
     * @Method({"DELETE"})
     */
    public function deleteDeplacement($id_prof, $id_dep)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $prof = $em->getRepository(User::class)->find($id_prof);
        $deplacement = $em->getRepository(Deplacement::class)->find($id_dep);

        $prof->removeProfDep($deplacement);
        $em->flush();


        return new Response('deplacement deleted successfully', 201);
    }

    /**
     * @Route("/portfolio/UpdateDeplacement/{id_prof}", name="update_deplacement")
     * @Method("PUT")
     */
    public function UpdateDeplacementAction($id_prof)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $prof = $em->getRepository(User::class)->find($id_prof);
        $deplacement = array();

        foreach (array(2, 3) as $deplacement_id) {
            $deplacement[$deplacement_id] = $em->getReference('PortfolioBundle\Entity\Deplacement', $deplacement_id);
        }

        $prof->setDeplacement($deplacement);
        $em->persist($prof);
        $em->flush();


        return new Response('deplacement updated successfully', 201);
    }

    /**
     * @Route("/portfolio/getAlldeplacementByUser/{id}", name="createUserDepla")
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


}
