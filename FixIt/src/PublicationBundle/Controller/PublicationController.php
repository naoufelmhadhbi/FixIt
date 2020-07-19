<?php

namespace PublicationBundle\Controller;

use AppBundle\Entity\User;
use PublicationBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * Creates a new publication entity.
     *
     * @Route("/new", name="publication_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $publication = new Publication();
        $form = $this->createForm('PublicationBundle\Form\PublicationType', $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publication);
            $em->flush();

            return $this->redirectToRoute('publication_show', array('id' => $publication->getId()));
        }

        return $this->render('publication/new.html.twig', array(
            'publication' => $publication,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a publication entity.
     *
     * @Route("/{id}", name="publication_show")
     * @Method("GET")
     */
    public function showAction(Publication $publication)
    {
        $deleteForm = $this->createDeleteForm($publication);

        return $this->render('publication/show.html.twig', array(
            'publication' => $publication,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing publication entity.
     *
     * @Route("/{id}/edit", name="publication_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Publication $publication)
    {
        $deleteForm = $this->createDeleteForm($publication);
        $editForm = $this->createForm('PublicationBundle\Form\PublicationType', $publication);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publication_edit', array('id' => $publication->getId()));
        }

        return $this->render('publication/edit.html.twig', array(
            'publication' => $publication,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a publication entity.
     *
     * @Route("/{id}", name="publication_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Publication $publication)
    {
        $form = $this->createDeleteForm($publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publication);
            $em->flush();
        }

        return $this->redirectToRoute('publication_index');
    }

    /**
     * Creates a form to delete a publication entity.
     *
     * @param Publication $publication The publication entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Publication $publication)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('publication_delete', array('id' => $publication->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

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


}
