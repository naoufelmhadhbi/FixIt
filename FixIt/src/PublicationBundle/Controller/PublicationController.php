<?php

namespace PublicationBundle\Controller;

use PublicationBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Publication controller.
 *
 * @Route("publication")
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
}
