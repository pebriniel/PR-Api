<?php

namespace AppBundle\Controller\admin;

use AppBundle\Entity\AppExperience;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Appexperience controller.
 *
 * @Route("admin/appexperience")
 */
class AppExperienceController extends Controller
{
    /**
     * Lists all appExperience entities.
     *
     * @Route("/", name="appexperience_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appExperiences = $em->getRepository('AppBundle:AppExperience')->findAll();

        return $this->render('appexperience/index.html.twig', array(
            'appExperiences' => $appExperiences,
        ));
    }

    /**
     * Creates a new appExperience entity.
     *
     * @Route("/new", name="appexperience_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $appExperience = new Appexperience();
        $form = $this->createForm('AppBundle\Form\AppExperienceType', $appExperience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appExperience);
            $em->flush($appExperience);

            return $this->redirectToRoute('appexperience_show', array('id' => $appExperience->getId()));
        }

        return $this->render('appexperience/new.html.twig', array(
            'appExperience' => $appExperience,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a appExperience entity.
     *
     * @Route("/{id}", name="appexperience_show")
     * @Method("GET")
     */
    public function showAction(AppExperience $appExperience)
    {
        $deleteForm = $this->createDeleteForm($appExperience);

        return $this->render('appexperience/show.html.twig', array(
            'appExperience' => $appExperience,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appExperience entity.
     *
     * @Route("/{id}/edit", name="appexperience_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AppExperience $appExperience)
    {
        $deleteForm = $this->createDeleteForm($appExperience);
        $editForm = $this->createForm('AppBundle\Form\AppExperienceType', $appExperience);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appexperience_edit', array('id' => $appExperience->getId()));
        }

        return $this->render('appexperience/edit.html.twig', array(
            'appExperience' => $appExperience,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appExperience entity.
     *
     * @Route("/{id}", name="appexperience_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AppExperience $appExperience)
    {
        $form = $this->createDeleteForm($appExperience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appExperience);
            $em->flush($appExperience);
        }

        return $this->redirectToRoute('appexperience_index');
    }

    /**
     * Creates a form to delete a appExperience entity.
     *
     * @param AppExperience $appExperience The appExperience entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AppExperience $appExperience)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appexperience_delete', array('id' => $appExperience->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
