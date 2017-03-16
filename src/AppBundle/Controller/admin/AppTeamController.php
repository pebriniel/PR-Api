<?php

namespace AppBundle\Controller\admin;

use AppBundle\Entity\AppTeam;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Appteam controller.
 *
 * @Route("admin/appteam")
 */
class AppTeamController extends Controller
{
    /**
     * Lists all appTeam entities.
     *
     * @Route("/", name="appteam_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appTeams = $em->getRepository('AppBundle:AppTeam')->findAll();

        return $this->render('appteam/index.html.twig', array(
            'appTeams' => $appTeams,
        ));
    }

    /**
     * Creates a new appTeam entity.
     *
     * @Route("/new", name="appteam_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $appTeam = new Appteam();
        $form = $this->createForm('AppBundle\Form\AppTeamType', $appTeam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appTeam);
            $em->flush($appTeam);

            return $this->redirectToRoute('appteam_show', array('id' => $appTeam->getId()));
        }

        return $this->render('appteam/new.html.twig', array(
            'appTeam' => $appTeam,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a appTeam entity.
     *
     * @Route("/{id}", name="appteam_show")
     * @Method("GET")
     */
    public function showAction(AppTeam $appTeam)
    {
        $deleteForm = $this->createDeleteForm($appTeam);

        return $this->render('appteam/show.html.twig', array(
            'appTeam' => $appTeam,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appTeam entity.
     *
     * @Route("/{id}/edit", name="appteam_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AppTeam $appTeam)
    {
        $deleteForm = $this->createDeleteForm($appTeam);
        $editForm = $this->createForm('AppBundle\Form\AppTeamType', $appTeam);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appteam_edit', array('id' => $appTeam->getId()));
        }

        return $this->render('appteam/edit.html.twig', array(
            'appTeam' => $appTeam,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appTeam entity.
     *
     * @Route("/{id}", name="appteam_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AppTeam $appTeam)
    {
        $form = $this->createDeleteForm($appTeam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appTeam);
            $em->flush($appTeam);
        }

        return $this->redirectToRoute('appteam_index');
    }

    /**
     * Creates a form to delete a appTeam entity.
     *
     * @param AppTeam $appTeam The appTeam entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AppTeam $appTeam)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appteam_delete', array('id' => $appTeam->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
