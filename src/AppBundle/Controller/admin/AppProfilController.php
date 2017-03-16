<?php

namespace AppBundle\Controller\admin;

use AppBundle\Entity\AppProfil;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Appprofil controller.
 *
 */
class AppProfilController extends Controller
{
    /**
     * Lists all appProfil entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appProfils = $em->getRepository('AppBundle:AppProfil')->findAll();

        return $this->render('appprofil/index.html.twig', array(
            'appProfils' => $appProfils,
        ));
    }

    /**
     * Creates a new appProfil entity.
     *
     */
    public function newAction(Request $request)
    {
        $appProfil = new Appprofil();
        $form = $this->createForm('AppBundle\Form\AppProfilType', $appProfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appProfil);
            $em->flush($appProfil);

            return $this->redirectToRoute('appprofil_show', array('id' => $appProfil->getId()));
        }

        return $this->render('appprofil/new.html.twig', array(
            'appProfil' => $appProfil,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a appProfil entity.
     *
     */
    public function showAction(AppProfil $appProfil)
    {
        $deleteForm = $this->createDeleteForm($appProfil);

        return $this->render('appprofil/show.html.twig', array(
            'appProfil' => $appProfil,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appProfil entity.
     *
     */
    public function editAction(Request $request, AppProfil $appProfil)
    {
        $deleteForm = $this->createDeleteForm($appProfil);
        $editForm = $this->createForm('AppBundle\Form\AppProfilType', $appProfil);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appprofil_edit', array('id' => $appProfil->getId()));
        }

        return $this->render('appprofil/edit.html.twig', array(
            'appProfil' => $appProfil,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appProfil entity.
     *
     */
    public function deleteAction(Request $request, AppProfil $appProfil)
    {
        $form = $this->createDeleteForm($appProfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appProfil);
            $em->flush($appProfil);
        }

        return $this->redirectToRoute('appprofil_index');
    }

    /**
     * Creates a form to delete a appProfil entity.
     *
     * @param AppProfil $appProfil The appProfil entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AppProfil $appProfil)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appprofil_delete', array('id' => $appProfil->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
