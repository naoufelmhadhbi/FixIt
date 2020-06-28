<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Demandeur;
use AppBundle\Entity\Professionnel;
use AppBundle\Entity\UserOld;
use AppBundle\Service\Validate;
use AppBundle\UserServices\UserService;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Services\ServiceManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @package AppBundle\Controller
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/api/create", name="createUseri")
     */
    public function createUser(Request $request)
    {
        $user = new UserOld();
        $user->setUsername("aze");
        $user->setPassword("aqw");
        $user->setRoles("admin");
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new JsonResponse("ok");

    }
    
    /**
     * @Route("/show", name="createUser")
     */
    public function showUser(Request $request)
    {   
        $id = $request->query->get('id');
        $n = $request->query->get('nom');
        $response = array('code'=>1,'message'=>'ok' , 'user1'=>md5('azerty') , 'idFromParam'=> $id , 'nom'=> $n);
        return new JsonResponse($response);
    }
    /**
     * @Route("/add", name="add_user")
     * @Method("POST")
     */
    public function addUserAction(Request $request)
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
        $user = $this->get('jms_serializer')->deserialize($data, 'AppBundle\Entity\User', 'json');
        $user->setPassword(md5($user->getPassword()));

        /*  $user->setEnabled(false);*/
        $form = $formFactory->createForm();
        $form->setData($user);
        $form->handleRequest($request);
        $event = new FormEvent($form, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

        $userManager->updateUser($user);
        if (null === $response = $event->getResponse()) {
            $url = $this->generateUrl('fos_user_registration_confirmed');
            return new Response('failed to add user', 404);
        }

        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

        return new Response('user added successfully', 201);

    }

    /**
     * @param Request $request
     * @param $id
     * @Route("/edit/{id}",name="update_user")
     * @Method({"PUT"})
     * @return JsonResponse
     */
    public function updatePost(Request $request,$id,Validate $validate)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        if (empty($user)) {
            $response = array(
                'code' => 1,
                'message' => $user->getType().' Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        $body = $request->getContent();

        $data = $this->get('jms_serializer')->deserialize($body, 'AppBundle\Entity\User', 'json');
        $parametersAsArray = [];
        if ($content = $request->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        $type_user = $parametersAsArray['type'];

        $reponse = $validate->validateRequest($data);
        if (!empty($reponse)) {
            return new JsonResponse($reponse, Response::HTTP_BAD_REQUEST);
        }
        if ($type_user == 'demandeur') {
        $user->setAdresse($data->getAdresse());
        $user->setCodePostal($data->getCodePostal());
        $user->setVille($data->getVille());
    } else {
            $user->setDescription($data->getDiscription());
        }
        $user->setNom($data->getNom());
        $user->setPrenom($data->getPrenom());
        $user->setTel($data->getTel());
        $user->setImage($data->getImage());
        $user->setDateNaissance($data->getDatenaissance());
        $user->setSexe($data->getSexe());
        $em=$this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $response=array(
            'code'=>0,
            'message'=> $user->getUsername().' updated!',
            'errors'=>null,
            'result'=>null
        );
        return new JsonResponse($response,200);
    }


    /**
     * @Route("/delete/{id}",name="delete_post")
     * @Method({"DELETE"})
     */
    public function deletePost(Request $request,$id)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        if (empty($user)) {
            $response=array(
                'code'=>1,
                'message'=>'user Not found !',
                'errors'=>null,
                'result'=>null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        $this->container->get('logger')->info(
            sprintf("New user idddddddd: %s", $user->getId())
        );
        $em=$this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        $response=array(
            'code'=>0,
            'message'=>'user deleted !'.$user,
            'errors'=>null,
            'result'=>null
        );

        return new JsonResponse($response,200);
    }

    /**
     * @Route("/getAllUsr/{id}", name="listAllUSR")
     */
    public function getAllUserOrById($id){
        $em = $this->getDoctrine()->getManager();
        if($id == null)
            $query = $em->createQuery('SELECT c FROM AppBundle:User c');
        else
            $query = $em->createQuery('SELECT c FROM AppBundle:User c where c.id = '.$id);
        $users = $query->getArrayResult();
        if (empty($users)) {
            $response = array(
                'code' => 1,
                'message' => 'User Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($users);
    }

    /**
     * @Route("/getByUsername/{username}", name="createUser")
     */
    public function showByUsername(Request $request,$username)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT c FROM AppBundle:User c where c.username = '".$username."'");
        $users = $query->getArrayResult();
        if (empty($users)) {
            $response = array(
                'code' => 1,
                'message' => 'User Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($users);
    }



}
