<?php

namespace AppBundle\Controller\admin;

use AppBundle\Entity\AppProject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Appproject controller.
 *
 * @Route("admin/appproject")
 */
class AppProjectController extends Controller
{
    /**
     * Lists all appProject entities.
     *
     * @Route("/", name="appproject_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appProjects = $em->getRepository('AppBundle:AppProject')->findAll();

        return $this->render('appproject/index.html.twig', array(
            'appProjects' => $appProjects,
        ));
    }

    /**
     * Creates a new appProject entity.
     *
     * @Route("/new", name="appproject_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $appProject = new Appproject();
        $form = $this->createForm('AppBundle\Form\AppProjectType', $appProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appProject);
            $em->flush($appProject);

            return $this->redirectToRoute('appproject_show', array('id' => $appProject->getId()));
        }

        return $this->render('appproject/new.html.twig', array(
            'appProject' => $appProject,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a appProject entity.
     *
     * @Route("/{id}", name="appproject_show")
     * @Method("GET")
     */
    public function showAction(AppProject $appProject)
    {
        $deleteForm = $this->createDeleteForm($appProject);

        return $this->render('appproject/show.html.twig', array(
            'appProject' => $appProject,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appProject entity.
     *
     * @Route("/{id}/edit", name="appproject_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AppProject $appProject)
    {
        $deleteForm = $this->createDeleteForm($appProject);
        $editForm = $this->createForm('AppBundle\Form\AppProjectType', $appProject);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appproject_edit', array('id' => $appProject->getId()));
        }

        return $this->render('appproject/edit.html.twig', array(
            'appProject' => $appProject,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appProject entity.
     *
     * @Route("/{id}", name="appproject_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AppProject $appProject)
    {
        $form = $this->createDeleteForm($appProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appProject);
            $em->flush($appProject);
        }

        return $this->redirectToRoute('appproject_index');
    }

    /**
     * Creates a form to delete a appProject entity.
     *
     * @param AppProject $appProject The appProject entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AppProject $appProject)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appproject_delete', array('id' => $appProject->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
