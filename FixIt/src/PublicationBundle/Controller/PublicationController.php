<?php

namespace PublicationBundle\Controller;

use AppBundle\Entity\Demandeur;
use AppBundle\Entity\User;
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
        $publication->setEtat('Waiting');
        $em->persist($publication);
        $em->flush();

        $response = array('code'=>201,'message'=>'publication added successfully');
        return new JsonResponse($response);

        }


    /**
     * Finds and displays a publication entity.
     *
     * @Route("/{id}", name="publication_show")
     * @Method("GET")
     */
    public function showAction(Publication $publication)
    {

        $data = $this->get('jms_serializer')->serialize($publication, 'json');
        $response = new Response($data);
        return $response;
    }

    /**
     * Displays a form to edit an existing publication entity.
     *
     * @Route("/{id}/edit", name="publication_edit")
     * @Method({"GET", "POST"})
     */
//    public function editAction(Request $request, Publication $publication)
//    {
//        $deleteForm = $this->createDeleteForm($publication);
//        $editForm = $this->createForm('PublicationBundle\Form\PublicationType', $publication);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isSubmitted() && $editForm->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('publication_edit', array('id' => $publication->getId()));
//        }
//
//        return $this->render('publication/edit.html.twig', array(
//            'publication' => $publication,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Deletes a publication entity.
     *
     * @Route("/{id}", name="publication_delete")
     * @Method("DELETE")
     */
//    public function deleteAction(Request $request, Publication $publication)
//    {
//        $form = $this->createDeleteForm($publication);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($publication);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('publication_index');
//    }

    /**
     * Creates a form to delete a publication entity.
     *
     * @param Publication $publication The publication entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
//    private function createDeleteForm(Publication $publication)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('publication_delete', array('id' => $publication->getId())))
//            ->setMethod('DELETE')
//            ->getForm();
//    }

    /**
     * @Route("/addPublication/{id_prof}/{id_publication}", name="add_publication")
     * @Method("POST")
     */
    public function postulerAction($id_prof, $id_publication)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $prof = $em->getRepository(User::class)->find($id_prof);
        $pub = $em->getRepository(Publication::class)->find($id_publication);

        $prof->addPublication($pub);

        $em->flush();


        return new Response('Publication added successfully', 201);
    }

    /**
     * Lists des publication selon le metier de professionnel
     *
     * @Route("/pubprof/{id_prof}", name="pub_prof")
     * @Method("GET")
     */
    public function pubParMetierAction($id_prof)
    {

        $em = $this->getDoctrine()->getManager();

        $prof = $em->getRepository(User::class)->find($id_prof);
        $i = 1;
        foreach ($prof->getIdMetier() as $metier) {
            $tab[] =  $metier->getId() ;
        }

        $publications = $em->getRepository(Publication::class)->findBy(array('id_metier' => $tab,'etat' =>'Waiting'));
        //       $publications = $em->getRepository('PublicationBundle:Publication')->findAll();
        $data = $this->get('jms_serializer')->serialize($publications, 'json');
        $response = new Response($data);
        return $response;
    }
    /**
     * @Route("/updatepub/{id_pub}/{id_prof}", name="update_pub")
     * @Method("PUT")
     */
    public function UpdatePublicationAction($id_pub,$id_prof)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $publication = $em->getRepository(Publication::class)->find($id_pub);


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
}
