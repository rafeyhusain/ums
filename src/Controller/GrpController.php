<?php
  namespace App\Controller;

  use App\Entity\Grp;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Symfony\Component\HttpFoundation\JsonResponse;
  
  class GrpController extends Controller {
    /**
     * @Route("/groups", name="group_list")
     * @Method({"GET"})
     */
    public function index() {
      $groups= $this->getDoctrine()->getRepository(Grp::class)->findAll();

      return new JsonResponse($groups);
    }

    /**
     * @Route("/group/new", name="new_group")
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
        $name = $request->request->get('name');
        
        if ($name == NULL) {
          return new JsonResponse([
            'result' => false, 
            'error' => 'Grp name is required'], 
            400);
        }
        else {
          $group = new Grp();
          $group->setName($name);
    
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($group);
          $entityManager->flush();

          return new JsonResponse([
            'result' => true, 
            'error' => '',
            'id' => $group->getId()], 
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
     * @Route("/group/delete", name="delete_group")
     * @Method({"DELETE"})
     */
    public function delete(Request $request) {
      try {
        $id = $request->request->get('id');

        if ($id == NULL) {
          return new JsonResponse([
            'result' => false, 
            'error' => 'id is required to delete group'], 
            400);
        }

        $group = $this->getDoctrine()->getRepository(Grp::class)->find($id);

        if ($group == NULL) {
          return new JsonResponse([
            'result' => false, 
            'error' => 'Grp not found'], 
            400);
        }
        else {
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($group);
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
