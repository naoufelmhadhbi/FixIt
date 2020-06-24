<?php

namespace AppBundle\Controller;
use AppBundle\Service\Validate;
use AppBundle\Entity\Demandeur;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Demandeur controller.
 *
 * @Route("/demandeur")
 */
class DemandeurController extends Controller
{
    /**
     * Lists all demandeur entities.
     *
     * @Route("/byId", name="demandeur_by_id")
     * @Method("GET")
     */
    public function getArticleByidAction(Demandeur $article)
    {
        $data = $this->get('jms_serializer')->serialize($article, 'json');
        $response = new Response($data);

        return $response;
    }

    /**
     * @Route("/add", name="add_demandeur")
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
        $demandeur = $this->get('jms_serializer')->deserialize($data, 'AppBundle\Entity\Demandeur', 'json');

      /*  $demandeur->setEnabled(false);*/
        $form = $formFactory->createForm();
        $form->setData($demandeur);
        $form->handleRequest($request);
        $event = new FormEvent($form, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

        $userManager->updateUser($demandeur);
        if (null === $response = $event->getResponse()) {
            $url = $this->generateUrl('fos_user_registration_confirmed');
            return new Response('failed to add user', 404);
        }

        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($demandeur, $request, $response));

        return new Response('product added successfully', 201);

    }
    /**
     * @Route("/warri")
     */
    public function warriAction(Request $request) {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('AppBundle/Entity/Demandeur');
        $personnes = $repository->findAll();
        $data = $this->get('jms_serializer')->serialize($personnes, 'json');
        $response = new Response($data);
        return $response;
    }
    /**
     * @param Request $request
     * @param $id
     * @Route("/edit/{id}",name="update_demandeur")
     * @Method({"PUT"})
     * @return JsonResponse
     */
    public function updatePost(Request $request,$id,Validate $validate)
    {
        $demandeur =$this->getDoctrine()->getRepository('AppBundle:Demandeur')->find($id);
        if (empty($demandeur))
        {
            $response=array(
                'code'=>1,
                'message'=>'Demandeur Not found !',
                'errors'=>null,
                'result'=>null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        $body=$request->getContent();

        $data=$this->get('jms_serializer')->deserialize($body,'AppBundle\Entity\Demandeur','json');

        $reponse= $validate->validateRequest($data);
        if (!empty($reponse))
        {
            return new JsonResponse($reponse, Response::HTTP_BAD_REQUEST);
        }
        $demandeur->setNom($data->getNom());
        $demandeur->setPrenom($data->getPrenom());
        $demandeur->setTel($data->getTel());
        $demandeur->setImage($data->getImage());
        $demandeur->setDateNaissance($data->getDatenaissance());
        $demandeur->setSexe($data->getSexe());
        $demandeur->setAdresse($data->getAdresse());
        $demandeur->setCodePostal($data->getCodePostal());
        $demandeur->setVille($data->getVille());
        $em=$this->getDoctrine()->getManager();
        $em->persist($demandeur);
        $em->flush();
        $response=array(
            'code'=>0,
            'message'=>'Demandeur updated!',
            'errors'=>null,
            'result'=>null
        );
        return new JsonResponse($response,200);
    }

}
