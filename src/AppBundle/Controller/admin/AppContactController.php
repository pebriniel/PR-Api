<?php

namespace AppBundle\Controller\admin;

use AppBundle\Entity\AppContact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Appcontact controller.
 *
 * @Route("admin/appcontact")
 */
class AppContactController extends Controller
{
    /**
     * Lists all appContact entities.
     *
     * @Route("/", name="appcontact_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appContacts = $em->getRepository('AppBundle:AppContact')->findAll();

        return $this->render('appcontact/index.html.twig', array(
            'appContacts' => $appContacts,
        ));
    }

    /**
     * Creates a new appContact entity.
     *
     * @Route("/new", name="appcontact_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $appContact = new Appcontact();
        $form = $this->createForm('AppBundle\Form\AppContactType', $appContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appContact);
            $em->flush($appContact);

            return $this->redirectToRoute('appcontact_show', array('id' => $appContact->getId()));
        }

        return $this->render('appcontact/new.html.twig', array(
            'appContact' => $appContact,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a appContact entity.
     *
     * @Route("/{id}", name="appcontact_show")
     * @Method("GET")
     */
    public function showAction(AppContact $appContact)
    {
        $deleteForm = $this->createDeleteForm($appContact);

        return $this->render('appcontact/show.html.twig', array(
            'appContact' => $appContact,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appContact entity.
     *
     * @Route("/{id}/edit", name="appcontact_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AppContact $appContact)
    {
        $deleteForm = $this->createDeleteForm($appContact);
        $editForm = $this->createForm('AppBundle\Form\AppContactType', $appContact);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appcontact_edit', array('id' => $appContact->getId()));
        }

        return $this->render('appcontact/edit.html.twig', array(
            'appContact' => $appContact,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appContact entity.
     *
     * @Route("/{id}", name="appcontact_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AppContact $appContact)
    {
        $form = $this->createDeleteForm($appContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appContact);
            $em->flush($appContact);
        }

        return $this->redirectToRoute('appcontact_index');
    }

    /**
     * Creates a form to delete a appContact entity.
     *
     * @param AppContact $appContact The appContact entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AppContact $appContact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appcontact_delete', array('id' => $appContact->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
