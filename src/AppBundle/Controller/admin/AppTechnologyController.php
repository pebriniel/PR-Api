<?php

namespace AppBundle\Controller\admin;

use AppBundle\Entity\AppTechnology;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Apptechnology controller.
 *
 * @Route("admin/apptechnology")
 */
class AppTechnologyController extends Controller
{
    /**
     * Lists all appTechnology entities.
     *
     * @Route("/", name="apptechnology_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appTechnologies = $em->getRepository('AppBundle:AppTechnology')->findAll();

        return $this->render('apptechnology/index.html.twig', array(
            'appTechnologies' => $appTechnologies,
        ));
    }

    /**
     * Creates a new appTechnology entity.
     *
     * @Route("/new", name="apptechnology_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $appTechnology = new Apptechnology();
        $form = $this->createForm('AppBundle\Form\AppTechnologyType', $appTechnology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appTechnology);
            $em->flush($appTechnology);

            return $this->redirectToRoute('apptechnology_show', array('id' => $appTechnology->getId()));
        }

        return $this->render('apptechnology/new.html.twig', array(
            'appTechnology' => $appTechnology,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a appTechnology entity.
     *
     * @Route("/{id}", name="apptechnology_show")
     * @Method("GET")
     */
    public function showAction(AppTechnology $appTechnology)
    {
        $deleteForm = $this->createDeleteForm($appTechnology);

        return $this->render('apptechnology/show.html.twig', array(
            'appTechnology' => $appTechnology,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appTechnology entity.
     *
     * @Route("/{id}/edit", name="apptechnology_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AppTechnology $appTechnology)
    {
        $deleteForm = $this->createDeleteForm($appTechnology);
        $editForm = $this->createForm('AppBundle\Form\AppTechnologyType', $appTechnology);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('apptechnology_edit', array('id' => $appTechnology->getId()));
        }

        return $this->render('apptechnology/edit.html.twig', array(
            'appTechnology' => $appTechnology,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appTechnology entity.
     *
     * @Route("/{id}", name="apptechnology_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AppTechnology $appTechnology)
    {
        $form = $this->createDeleteForm($appTechnology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appTechnology);
            $em->flush($appTechnology);
        }

        return $this->redirectToRoute('apptechnology_index');
    }

    /**
     * Creates a form to delete a appTechnology entity.
     *
     * @param AppTechnology $appTechnology The appTechnology entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AppTechnology $appTechnology)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('apptechnology_delete', array('id' => $appTechnology->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
