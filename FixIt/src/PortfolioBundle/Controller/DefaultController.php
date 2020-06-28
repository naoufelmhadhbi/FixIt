<?php

namespace PortfolioBundle\Controller;

use AppBundle\Entity\Professionnel;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
        return $this->render('PortfolioBundle:Default:index.html.twig');
    }


    /**
     * @Route("api/portfolio/addImage/{id}", name="add_image")
     * @Method("POST")
     */
    public function addImageAction(Request $request, $id) {
        $data = $request->getContent();
        $image = $this->get('jms_serializer')->deserialize($data, 'PortfolioBundle\Entity\Portfolio', 'json');
        $em = $this->getDoctrine()->getManager();
//        $parametersAsArray = [];
//        if ($content = $request->getContent()) {
//            $parametersAsArray = json_decode($content, true);
//        }
//        $professionnel = new Professionnel();
//        $id_prof = $parametersAsArray['id_prof'];
//        $idProf = $request->query->get('id_prof') ;
//        $this->container->get('logger')->info(
//            sprintf("id prof est : %s", $id_prof)
//        );

        $user = $em->getRepository(User::class)->find(intval($id));
        $image->setIdProf($user);
        $em->persist($image);
        $em->flush();



        return new Response('image added successfully', 201);



    }
}
