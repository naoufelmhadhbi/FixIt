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
//use Symfony\Component\String\Slugger\SluggerInterface;

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
//        $NewImage = $slugger->slug($image);
//        $Final = $NewImage.'-'.uniqid().'.'.$image->guessExtension();
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
        $image->setDescription($data->getDescription());

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
     * @Route("/portfolio/getImageById/{id}", name="listimagById")
     */
    public function getImageById($id)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT c FROM PortfolioBundle:Portfolio c where c.id = ' . $id);
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
     * @Route("/portfolio/getDepById/{id}", name="listDepById")
     */
    public function getDepById($id)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT c FROM PortfolioBundle:Deplacement c where c.id = ' . $id);
        $dep = $query->getArrayResult();
        if (empty($dep)) {
            $response = array(
                'code' => 1,
                'message' => 'deplacement Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($dep);
    }

    /**
     * @Route("/portfolio/getMetById/{id}", name="listMetById")
     */
    public function getMetById($id)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT c FROM PortfolioBundle:Metier c where c.id = ' . $id);
        $metier = $query->getArrayResult();
        if (empty($metier)) {
            $response = array(
                'code' => 1,
                'message' => 'metier Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($metier);
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
     * @Route("/portfolio/Updatemetier/{id_prof}/{id_metier_old}/{id_metier_New}", name="update_metier")
     * @Method("PUT")
     */
    public function UpdateMetierAction($id_prof, $id_metier_old, $id_metier_New)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $prof = $em->getRepository(User::class)->find($id_prof);
        $metierOld = $em->getRepository(Metier::class)->find($id_metier_old);
        $prof->removeProfMetier($metierOld);
        $em->flush();
//        $metier = array();
//
//        foreach (array(2) as $metier_id) {
//            $metier[$metier_id] = $em->getReference('PortfolioBundle\Entity\Metier', $metier_id);
//        }

        $metierNew = $em->getRepository(Metier::class)->find($id_metier_New);

        $prof->addMetiers($metierNew);

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
        $repository = $em->getRepository('PortfolioBundle:Metier');
        $tags = $repository->createQueryBuilder('t')
            ->select('t.nom as nom, t.id as id')
            ->innerJoin('t.idProf', 'c')
            ->where('c.id = :user_id')
            ->setParameter('user_id', $id_prof)
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
     * @Route("/portfolio/UpdateDeplacement/{id_prof}/{id_dep_old}/{id_dep_New}", name="update_deplacement")
     * @Method("PUT")
     */
    public function UpdateDeplacementAction($id_prof, $id_dep_old, $id_dep_New)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $prof = $em->getRepository(User::class)->find($id_prof);
        $deplacementOld = $em->getRepository(Deplacement::class)->find($id_dep_old);

        $prof->removeProfDep($deplacementOld);
        $em->flush();
        $deplacementNew = $em->getRepository(Deplacement::class)->find($id_dep_New);

        $prof->addDeplacement($deplacementNew);

        $em->flush();


        return new Response('deplacement updated successfully', 201);
    }

    /**
     * @Route("/portfolio/getDeplacement/{id_prof}", name="listDeplacement")
     */
    public function getDeplamcementPerProf(Request $request,$id_prof)
    {
//        $categoryId = $request->request->get('cat_id');
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('PortfolioBundle:Deplacement');
        $tags = $repository->createQueryBuilder('t')
            ->select('t.gouvernorat as gouvernorat, t.id as id')
            ->innerJoin('t.idProf', 'c')
            ->where('c.id = :user_id')
            ->setParameter('user_id', $id_prof)
            ->getQuery()
            ->getResult();
//        $this->container->get('logger')->info(
//            sprintf("le contenu de tags est: %s", $tags)
//        );

        return new JsonResponse($tags);
    }

    /**
     * @Route("/portfolio/getDeplacements", name="list_All_Deplacments")
     */
    public function getAllDeplacements()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT c FROM PortfolioBundle:Deplacement c');
        $dep = $query->getArrayResult();
        if (empty($dep)) {
            $response = array(
                'code' => 1,
                'message' => 'deplacement Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($dep);
    }

    /**
     * @Route("/portfolio/getMetiers", name="list_All_Metiers")
     */
    public function getAllMetiers()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT c FROM PortfolioBundle:Metier c');
        $metier = $query->getArrayResult();
        if (empty($metier)) {
            $response = array(
                'code' => 1,
                'message' => 'metier Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($metier);
    }
}
