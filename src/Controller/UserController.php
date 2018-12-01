<?php
  namespace App\Controller;

  use App\Entity\User;
  use App\Auth\UserAuth;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Symfony\Component\HttpFoundation\JsonResponse;
  
  class UserController extends Controller {
    /**
     * @Route("/users", name="user_list")
     * @Method({"GET"})
     */
    public function index() {
      $users= $this->getDoctrine()->getRepository(User::class)->findAll();

      return new JsonResponse($users);
    }

    /**
     * @Route("/user/new", name="new_user")
     * Method({"POST"})
    *   statusCodes = 
    *     200 = "Returned when successful"
    *     400 = "Returned when the form has errors"
    *     401 = "Returned when not authenticated"
    *     403 = "Returned when not having permissions"
    *     500 = "Returned when exception occured"
    */
    public function new(Request $request) {
      try {
        $result = true; //isAuthenticated();
        if (!$result) {
          return new JsonResponse([
            'result' => false, 
            'error' => 'Not authenticated'], 
            401);
        }

        $result = true; //isInRole('Admin');
        if (!$result) {
          return new JsonResponse([
            'result' => false, 
            'error' => 'Unauthorized'], 
            403);
        }

        $name = $request->request->get('name');
        if ($name == '') {
          return new JsonResponse([
            'result' => false, 
            'error' => 'User name is required'], 
            400);
        }
        else {
          $user = new User();
          $user->setName($name);
    
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($user);
          $entityManager->flush();

          return new JsonResponse([
            'result' => true, 
            'error' => '',
            'id' => $user->getId()], 
            200);
        }
      } catch(\Exception $e) {
        return new JsonResponse([
          'result' => false, 
          'error' => 'Internal Server Error'], 
          500);
      }
    }

    /**
     * @Route("/user/delete", name="delete_user")
     * @Method({"DELETE"})
     */
    public function delete(Request $request) {
      try {
        $id = $request->request->get('id');

        if ($id == '') {
          return new JsonResponse([
            'result' => false, 
            'error' => 'id is required to delete user'], 
            400);
        }

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        if ($user == NULL) {
          return new JsonResponse([
            'result' => false, 
            'error' => 'User not found'], 
            400);
        }
        else {
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($user);
          $entityManager->flush();

          return new JsonResponse([
            'result' => true, 
            'error' => ''], 
            200);
        }
      } catch(\Exception $e) {
        return new JsonResponse([
          'result' => false, 
          'error' => 'Internal Server Error'], 
          500);
      }
    }
    
    /**
     * @Route("/user/groups", name="user_groups")
     * @Method({"POST"})
     */
    public function groups(Request $request) {
      try {
        $id = $request->request->get('id');

        if ($id == NULL) {
          return new JsonResponse([
            'result' => false, 
            'error' => 'id is required to update user groups'], 
            400);
        }

        $groups = $request->request->get('groups');

        if ($groups == NULL) {
          return new JsonResponse([
            'result' => false, 
            'error' => 'groups are required to update user groups'], 
            400);
        }

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        if ($user == NULL) {
          return new JsonResponse([
            'result' => false, 
            'error' => 'User not found'], 
            400);
        }
        else {
          $grps = $this->getDoctrine()->getRepository(UserGrp::class)->findBy(['userId' => $id]);

          // TODO: Add a logic to insert or delete groups

          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();

          return new JsonResponse([
            'result' => true, 
            'error' => ''], 
            200);
        }
      } catch(\Exception $e) {
        return new JsonResponse([
          'result' => false, 
          'error' => 'Internal Server Error'], 
          500);
      }
    }
  }
