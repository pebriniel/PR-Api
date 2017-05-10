<?php

namespace AppBundle\Controller\admin;

use BS\CoreBundle\Entity\AppCompany;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Appcompany controller.
 *
 * @Route("admin/appcompany")
 */
class AppCompanyController extends Controller
{
    /**
     * Lists all appCompany entities.
     *
     * @Route("/", name="appcompany_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appCompanies = $em->getRepository('BSCoreBundle:AppCompany')->findAll();

        return $this->render('appcompany/index.html.twig', array(
            'appCompanies' => $appCompanies,
        ));
    }

    /**
     * Creates a new appCompany entity.
     *
     * @Route("/new", name="appcompany_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $appCompany = new Appcompany();
        $form = $this->createForm('AppBundle\Form\AppCompanyType', $appCompany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appCompany);
            $em->flush($appCompany);

            return $this->redirectToRoute('appcompany_show', array('id' => $appCompany->getId()));
        }

        return $this->render('appcompany/new.html.twig', array(
            'appCompany' => $appCompany,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a appCompany entity.
     *
     * @Route("/{id}", name="appcompany_show")
     * @Method("GET")
     */
    public function showAction(AppCompany $appCompany)
    {
        $deleteForm = $this->createDeleteForm($appCompany);

        return $this->render('appcompany/show.html.twig', array(
            'appCompany' => $appCompany,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appCompany entity.
     *
     * @Route("/{id}/edit", name="appcompany_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AppCompany $appCompany)
    {
        $deleteForm = $this->createDeleteForm($appCompany);
        $editForm = $this->createForm('AppBundle\Form\AppCompanyType', $appCompany);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appcompany_edit', array('id' => $appCompany->getId()));
        }

        return $this->render('appcompany/edit.html.twig', array(
            'appCompany' => $appCompany,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appCompany entity.
     *
     * @Route("/{id}", name="appcompany_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AppCompany $appCompany)
    {
        $form = $this->createDeleteForm($appCompany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appCompany);
            $em->flush($appCompany);
        }

        return $this->redirectToRoute('appcompany_index');
    }

    /**
     * Creates a form to delete a appCompany entity.
     *
     * @param AppCompany $appCompany The appCompany entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AppCompany $appCompany)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appcompany_delete', array('id' => $appCompany->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
