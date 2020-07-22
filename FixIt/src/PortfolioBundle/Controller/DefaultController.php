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
     * @Route("/getAlldeplacementByUser", name="createUserDepla")
     */
    public function showByUsernameByDep(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $userId = 3;
        $repository = $em->getRepository('PortfolioBundle:Deplacement');
        $tags = $repository->createQueryBuilder('t')
            ->select('c.id as profId, t.id as depId')
            ->innerJoin('t.idProf', 'c')
            ->where('c.id = :user_id')
            ->setParameter('user_id', $userId)
            ->getQuery()
            ->getResult();

    }

    /**
     * @Route("/portfolio/addMetier/{id_prof}/{id_metier}", name="add_metier")
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
     * @Route("/portfolio/getMetier/{id_prof}", name="listMetier")
     */
    public function getMetierPerProf($id_prof)
    {


        $em = $this->getDoctrine()->getManager();

//        $prof = $em->getRepository(User::class)->find($id_prof)->getMetier();
        $prof = $em->getRepository(User::class)->find($id_prof);
        $i = 1;
        foreach ($prof->getIdMetier() as $metier) {
               $tab[] =  $metier->getNom() ;
                // $array[$metier] = $metier->getNom() [$i++];

        }

//        $table = $images->getArrayResult();
        $data = $this->get('jms_serializer')->serialize($tab, 'json');
            $response = new Response($data);
            return $response;


//        return new JsonResponse($prof->getIdMetier());
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
     * @Route("/portfolio/getDeplacement/{id_prof}", name="listDeplacement")
     */
    public function getDeplamcementPerProf(Request $request,$id_prof)
    {
//        $categoryId = $request->request->get('cat_id');
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('AppBundle:Professionnel');
        $tags = $repository->createQueryBuilder('t')
            ->innerJoin('t.id_deplacement', 'c')
            ->where('c.id = :category_id')
            ->setParameter('category_id', 1)
            ->getQuery()->getResult()->getArrayResult();
        $this->container->get('logger')->info(
            sprintf("le contenu de tags est: %s", $tags)
        );


//        $em = $this->getDoctrine()->getManager();
//
////        $prof = $em->getRepository(User::class)->find($id_prof)->getMetier();
//        $prof = $em->getRepository(User::class)->find($id_prof);
//
//        $dep = null;
//
//        foreach ($prof->getIdDeplacement() as $deplacement) {
//            $dep = $deplacement;
//
//            echo $deplacement->getId() . '<br>';
//        }
//        $this->container->get('logger')->info(
//            sprintf("le contenu de dep est: %s", $dep)
//        );
//        $table = $images->getArrayResult();
//        $data = $this->get('jms_serializer')->serialize($prof->getIdDeplacement(), 'json');
//            $response = new Response($data);
//            return $response;
        return new JsonResponse($tags);
    }
}
