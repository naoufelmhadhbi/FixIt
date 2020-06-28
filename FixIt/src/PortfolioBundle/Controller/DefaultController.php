<?php

namespace PortfolioBundle\Controller;

use AppBundle\Entity\Professionnel;
use AppBundle\Entity\User;
use AppBundle\Service\Validate;
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
    public function addImageAction(Request $request, $id) {
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
     * @Route("/portfolio/addmetier/{id_prof}/{id_metier}", name="add_metier")
     * @Method("POST")
     */
    public function addMetierAction ($id_prof, $id_metier) {

        $em = $this->getDoctrine()->getEntityManager();

        $prof = $em->getRepository(User::class)->find($id_prof);
        $metier = $em->getRepository(Metier::class)->find($id_metier);

        $prof->addMetiers($metier);

        $em->flush();



        return new Response('metier added successfully', 201);
    }

    /**
     * @Route("/portfolio/deleteMetier/{id_prof}/{id_metier}",name="delete_metier")
     * @Method({"DELETE"})
     */
    public function deleteMetier(Request $request,$id_prof, $id_metier)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $prof = $em->getRepository(User::class)->find($id_prof);
        $metier = $em->getRepository(Metier::class)->find($id_metier);

        $prof->removeScientistGenus($metier);
        $em->flush();



        return new Response('metier deleted successfully', 201);
    }

    /**
     * @Route("/portfolio/deleteImage/{id_image}",name="delete_image")
     * @Method({"DELETE"})
     */
    public function deleteIamge(Request $request, $id_image)
    {
        $image = $this->getDoctrine()->getRepository('PortfolioBundle:Portfolio')->find($id_image);
        if (empty($image)) {
            $response=array(
                'code'=>1,
                'message'=>'image Not found !',
                'errors'=>null,
                'result'=>null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
//        $this->container->get('logger')->info(
//            sprintf("New user idddddddd: %s", $user->getId())
//        );
        $em=$this->getDoctrine()->getManager();
        $em->remove($image);
        $em->flush();
        $response=array(
            'code'=>0,
            'message'=>'image deleted !'.$image,
            'errors'=>null,
            'result'=>null
        );

        return new JsonResponse($response,200);
    }

    /**
     * @param Request $request
     * @param $id
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
                'message' => $image->getType().' Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        $body = $request->getContent();

        $data = $this->get('jms_serializer')->deserialize($body, 'PortfolioBundle\Entity\Portfolio', 'json');
//        $parametersAsArray = [];
//        if ($content = $request->getContent()) {
//            $parametersAsArray = json_decode($content, true);
//        }
//        $type_user = $parametersAsArray['type'];

        $reponse = $validate->validateRequest($data);
        if (!empty($reponse)) {
            return new JsonResponse($reponse, Response::HTTP_BAD_REQUEST);
        }
//        if ($type_user == 'demandeur') {
//            $user->setAdresse($data->getAdresse());
//            $user->setCodePostal($data->getCodePostal());
//            $user->setVille($data->getVille());
//        } else {
//            $user->setDescription($data->getDiscription());
//        }
        $image->setIdProf($data->getIdProf());
        $image->setImage($data->getImage());
//        $user->setTel($data->getTel());
//        $user->setImage($data->getImage());
//        $user->setDateNaissance($data->getDatenaissance());
//        $user->setSexe($data->getSexe());
        $em=$this->getDoctrine()->getManager();
        $em->persist($image);
        $em->flush();
        $response=array(
            'code'=>0,
//            'message'=> $image->getUsername().' updated!',
            'errors'=>null,
            'result'=>null
        );
        return new JsonResponse($response,200);
    }
}
