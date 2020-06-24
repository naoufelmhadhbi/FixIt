<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Demandeur;
use AppBundle\Entity\Professionnel;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
    * @Route("/professionnel")
    */
class ProfessionnelController extends Controller
{
    /**
     * @Route("/add", name="add_professionnel")
     * @Method("POST")
     */
    public function addArticleAction(Request $request)
    {

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');
        //get content of data sent by ARC(or postman) tools
        $data = $request->getContent();
        //deserialize the data
        $professionnel = $this->get('jms_serializer')->deserialize($data, 'AppBundle\Entity\Demandeur', 'json');

        /*  $demandeur->setEnabled(false);*/
        $form = $formFactory->createForm();
        $form->setData($professionnel);
        $form->handleRequest($request);
        $event = new FormEvent($form, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

        $userManager->updateUser($professionnel);
        if (null === $response = $event->getResponse()) {
            $url = $this->generateUrl('fos_user_registration_confirmed');
            return new Response('failed to add user', 404);
        }

        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($professionnel, $request, $response));

        return new Response('product added successfully', 201);

    }

}
