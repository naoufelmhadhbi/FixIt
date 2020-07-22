<?php

namespace PublicationBundle\Controller;

use AppBundle\Entity\Demandeur;
use AppBundle\Entity\Professionnel;
use AppBundle\Entity\User;
use PortfolioBundle\Entity\Metier;
use PublicationBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Publication controller.
 *
 * @Route("/publication")
 */
class PublicationController extends Controller
{
    /**
     * Lists all publication entities.
     *
     * @Route("/", name="publication_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publications = $em->getRepository('PublicationBundle:Publication')->findAll();
        $data = $this->get('jms_serializer')->serialize($publications, 'json');
        $response = new Response($data);
        return $response;


    }

    /**
     * Les publication faite par demandeur
     *
     * @Route("/pub/{id}", name="pub_demandeur")
     * @Method("GET")
     */
    public function pubParDemandeurAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $publications = $em->getRepository(Publication::class)->findBy(array('id_demandeur' => $id));
 //       $publications = $em->getRepository('PublicationBundle:Publication')->findAll();
        $data = $this->get('jms_serializer')->serialize($publications, 'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Creates a new publication entity.
     *
     * @Route("/new", name="publication_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $data = $request->getContent();

        //deserialize the data
        $publication = $this->get('jms_serializer')->deserialize($data, 'PublicationBundle\Entity\Publication', 'json');
        $em = $this->getDoctrine()->getManager();
//        $demandeur = $em->getRepository(Demandeur::class)->find($id);

//        $publication->setIdDemandeur($demandeur);
        $publication->setEtat('New');
        $publication->setDatePub(new \DateTime('now'));
        $em->persist($publication);
        $em->flush();

        $response = array('code'=>201,'message'=>'publication added successfully');
        return new JsonResponse($response);

        }


    /**
     * Finds and displays a publication entity.
     *
     * @Route("/get/{id}", name="publication_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(Publication $publication)
    {

        $data = $this->get('jms_serializer')->serialize($publication, 'json');
        $response = new Response($data);
        return $response;
    }


    /**
     * @Route("/addPublication/{id_prof}/{id_publication}", name="add_publication")
     * @Method({"GET", "POST"})
     */
    public function postulerAction($id_prof, $id_publication)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $prof = $em->getRepository(User::class)->find($id_prof);
        $pub = $em->getRepository(Publication::class)->find($id_publication);
        $pub->setEtat('Still waiting for acceptation');

        $pub->setIdProfessionnel($id_prof);


        $prof->addPublication($pub);

        $em->flush();


        return new Response('Publication added successfully', 201);
    }

    /**
     * Lists des publication selon le metier de professionnel
     *
     * @Route("/pubprof/{id_prof}", name="pub_prof")
     * @Method("POST")
     */
    public function pubParMetierAction($id_prof)
    {

        $em = $this->getDoctrine()->getManager();

        $prof = $em->getRepository(User::class)->find($id_prof);
        $i = 1;
        foreach ($prof->getIdMetier() as $metier) {
            $tab[] =  $metier->getId() ;
        }
        $tab_etat=['New','Still waiting for acceptation'];

        $publications = $em->getRepository(Publication::class)->findBy(array('id_metier' => $tab,'etat' =>$tab_etat));
        //       $publications = $em->getRepository('PublicationBundle:Publication')->findAll();
        $data = $this->get('jms_serializer')->serialize($publications, 'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Lists des demandes de professionnel en cours
     *
     * @Route("/mesdemandes/{id_dem}/{etat}", name="pub_dem")
     * @Method("GET")
     */
    public function mesDemandeEncoursAction($id_dem,$etat)
    {

        $em = $this->getDoctrine()->getManager();

//        $prof = $em->getRepository(User::class)->find($id_dem);
        if($etat == 'All')
            $publications = $em->getRepository(Publication::class)->findBy(array('id_demandeur' => $id_dem));
        else
            $publications = $em->getRepository(Publication::class)->findBy(array('id_demandeur' => $id_dem,'etat'=>$etat));

        $data = $this->get('jms_serializer')->serialize($publications, 'json');
        $response = new Response($data);
        return $response;
    }



    /**
     * Lorsque le demandeur accept une publication on affecte l id de prof sélectionné au publication adéquate
     *
     * @Route("/updatepub/{id_pub}/{id_prof}", name="update_pub")
     * @Method("PUT")
     */
    public function acceptedPublicationAction($id_pub,$id_prof)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $publication = $em->getRepository(Publication::class)->find($id_pub);
//        $publication->get

        $publication->setIdProfessionnel($id_prof);
        $publication->setEtat('In progress');
        $em->persist($publication);
        $em->flush();


        return new Response('Publication updated successfully', 201);
    }

    /**
     * @Route("/cloturer/{id_pub}", name="cloturer_pub")
     * @Method("PUT")
     */
    public function cloturerAction($id_pub)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $publication = $em->getRepository(Publication::class)->find($id_pub);

        $publication->setEtat('Closed');
        $em->persist($publication);
        $em->flush();

        return new Response('Publication updated successfully', 201);
    }


    /**
     * Lists des postule
     *
     * @Route("/postul/{id_dem}", name="publication_postul")
     * @Method("GET")
     */
    public function listPostulAction($id_dem)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $tags = $em->getRepository('PublicationBundle:Publication')->getPub($id_dem);
        $data = $this->get('jms_serializer')->serialize($tags, 'json');
        $response = new Response($data);
        return $response;

    }

    /**
     * Lists des demandes de professionnel en cours
     *
     * @Route("/mesreponses/{id_prof}", name="mes_rep")
     * @Method("GET")
     */
    public function mesReponseAction($id_prof)
    {
        $em = $this->getDoctrine()->getManager();

            //$prof = $em->getRepository(Publication::class)->find($id_prof);
            $publications = $em->getRepository(Publication::class)->findAccepted($id_prof);

        $data = $this->get('jms_serializer')->serialize($publications, 'json');
        $response = new Response($data);
        return $response;
    }
    /**
     * Lists des demandes de professionnel en cours
     *
     * @Route("/metier/all", name="get_metier")
     * @Method("GET")
     */
    public function getMetierAction()
    {
        $em = $this->getDoctrine()->getManager();
        $metiers = $em->getRepository(Publication::class)->getMetier();
        $data = $this->get('jms_serializer')->serialize($metiers, 'json');
        $response = new Response($data);
        return $response;
    }
}
