<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Demandeur;
use AppBundle\Entity\Professionnel;
use AppBundle\Entity\UserOld;
use AppBundle\Service\Validate;
use AppBundle\UserServices\UserService;
use DateInterval;
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


        $parametersAsArray = [];
        if ($content = $request->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        $email_user = $parametersAsArray['email'];
        $user_username = $parametersAsArray['username'];
        $date_naissance_user = $parametersAsArray['date_naissance_user'];
        $date = new \DateTime($date_naissance_user);
        $interval = new DateInterval('P1D');
        $user->setDatenaissance($date->add($interval));
        //$this->checkIfExistEmailUsername($email_user);
        if($this->checkIfExistEmailUsername($email_user) == false){
            $response = array('code'=>401,'message'=>'email already exist');
            return new JsonResponse($response);
        }

        if($this->checkIfExistUsername($user_username) == false){
            $response = array('code'=>402,'message'=>'username already exist');
            return new JsonResponse($response);
        }

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

        $response = array('code'=>201,'message'=>'user added successfully');
        return new JsonResponse($response);

    }

    public function checkIfExistEmailUsername($email){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT c FROM AppBundle:User c where c.email = '".$email."'");
        $users = $query->getArrayResult();
        if (!empty($users)) {
            $response = array(
                'code' => 1,
                'message' => 'User Not found !',
                'errors' => null,
                'result' => null
            );
            $this->container->get('logger')->info(
                sprintf("this is mail exiiiiiiiiiiiiist mail: %s", $email)
            );
            return false ;
        }
        return true ;
    }

    public function checkIfExistUsername($username){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT c FROM AppBundle:User c where c.username = '".$username."'");
        $users = $query->getArrayResult();
        if (!empty($users)) {
            $response = array(
                'code' => 1,
                'message' => 'User Not found !',
                'errors' => null,
                'result' => null
            );
            $this->container->get('logger')->info(
                sprintf("this is mail exiiiiiiiiiiiiist username: %s", $username)
            );
            return false ;
        }
        return true ;
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
            $user->setDescription($data->getDescription());
        }
        $user->setNom($data->getNom());
        $user->setPrenom($data->getPrenom());
        $user->setTel($data->getTel());
        $user->setImage($data->getImage());
        //$user->setDateNaissance($data->getDatenaissance());
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
     * @Route("/getAllUsr", name="listAllUSER")
     */
    public function getAllUser(){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT c FROM AppBundle:User c');
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


    /**
    * @Route("/getAllUsrByDep/{id}", name="listUserDept")
    */
    public function getAllUserBydeplacemeny(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $deplacementId = $id;
        $this->container->get('logger')->info(
        sprintf("le contenu de dep est: %s", $deplacementId)
        );

        $repository = $em->getRepository('AppBundle:Professionnel');
        $tags = $repository->createQueryBuilder('t')
            ->select('c.id as depId, t.id as profId')
            ->innerJoin('t.id_deplacement', 'c')
            ->where('c.id = :prof_id')
            ->setParameter('prof_id', $deplacementId)
            ->getQuery()
            ->getResult();

        if (empty($tags)) {
            $response = array(
            'code' => 1,
            'message' => 'Deplacement Not found !',
            'errors' => null,
            'result' => null
        );
        return new JsonResponse($response, Response::HTTP_NOT_FOUND);
    }
        return new JsonResponse($tags);
}

    /**
     * @Route("/getAllProfessionnel", name="listAllProf")
     */
    public function getAllProfessionnel(){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT c FROM AppBundle:Professionnel c');
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
     * @Route("/getAllDemandeur", name="listAllDemand")
     */
    public function getAllDemandeur(){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT c FROM AppBundle:Demandeur c');
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
     * @Route("/getUserById/{idprof}", name="userbyId")
     */
    public function  getUserById($idprof){

        $em = $this->getDoctrine()->getManager();
        $prof = $em->getRepository(Professionnel::class)->find($idprof);

        if (empty($prof)) {
            $response = array(
                'code' => 1,
                'message' => 'User Not found !',
                'errors' => null,
                'result' => null
            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }

        $data = $this->get('jms_serializer')->serialize($prof, 'json');
        $response = new Response($data);
        return $response;
       // return  new JsonResponse(json_encode( (array)$prof ));
    }



}
