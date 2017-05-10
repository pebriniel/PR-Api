<?php

 namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\Annotations as Rest;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;

/**
 * @Route("api/")
 */
class ApiController extends Controller
{
    /**
     * @Route("/p/test/", name="home p test")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Rest\Get("project/", name="api project")
     * @return JsonResponse
     */
     public function projectAction(Request $request)
     {
          $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('BSCoreBundle:AppProject');

            //$l = $em->findById(1);


          $users = $em->createQueryBuilder('q')
             ->leftJoin('q.technology', 't')
             ->leftJoin('q.team', 'm')
             ->leftJoin('q.screenshot', 's')
             ->addSelect('t')
             ->addSelect('m')
             ->addSelect('s')
             ->getQuery()
             ->getArrayResult();

        return new JsonResponse($users);
     }

    /**
     * @Rest\Get("profil/", name="api profil")
     * @return JsonResponse
     */
     public function profilAction(Request $request)
     {
          $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('BSCoreBundle:AppProfil');

          $data = $em->createQueryBuilder('q')
             ->getQuery()
             ->getArrayResult();

        $array = array();

        for($i = 0; $i < sizeof($data); $i ++){
            $array[$data[$i]['keyname']] = $data[$i]['value'];
        }

        return new JsonResponse($array);
     }

    /**
     * @Rest\Get("experience/", name="api works")
     * @return JsonResponse
     */
     public function experienceAction(Request $request)
     {
          $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('BSCoreBundle:AppExperience');

          $users = $em->createQueryBuilder('q')
              ->leftJoin('q.company', 't')
              ->addSelect('t')
             ->getQuery()
             ->getArrayResult();

        return new JsonResponse($users);
     }


    /**
     * @Rest\Get("skills/", name="api skills")
     * @return JsonResponse
     */
     public function skillsAction(Request $request)
     {
          $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('BSCoreBundle:AppTechnology');

          $v['lang'] = $em->createQueryBuilder('q')->where('q.category = :identifiant')->setParameter('identifiant', 0)->getQuery()->getArrayResult();
          $v['fram'] = $em->createQueryBuilder('q')->where('q.category = :identifiant')->setParameter('identifiant', 1)->getQuery()->getArrayResult();
          $v['libs'] = $em->createQueryBuilder('q')->where('q.category = :identifiant')->setParameter('identifiant', 2)->getQuery()->getArrayResult();

        return new JsonResponse($v);
     }

    /**
     * @Rest\Get("company/", name="api company")
     * @return JsonResponse
     */
     public function companyAction(Request $request)
     {
          $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('BSCoreBundle:AppExperience');

          $data = $em->createQueryBuilder('q')
                      ->leftJoin('q.company', 'p')
                      ->addSelect('p')
                      ->getQuery()
                      ->getArrayResult();

        return new JsonResponse($data);
     }

}
