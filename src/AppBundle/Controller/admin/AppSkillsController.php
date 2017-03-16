<?php

namespace AppBundle\Controller\admin;

use AppBundle\Entity\AppSkills;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Appskill controller.
 *
 * @Route("admin/appskills")
 */
class AppSkillsController extends Controller
{
    /**
     * Lists all appSkill entities.
     *
     * @Route("/", name="appskills_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appSkills = $em->getRepository('AppBundle:AppSkills')->findAll();

        return $this->render('appskills/index.html.twig', array(
            'appSkills' => $appSkills,
        ));
    }

    /**
     * Creates a new appSkill entity.
     *
     * @Route("/new", name="appskills_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $appSkill = new Appskill();
        $form = $this->createForm('AppBundle\Form\AppSkillsType', $appSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appSkill);
            $em->flush($appSkill);

            return $this->redirectToRoute('appskills_show', array('id' => $appSkill->getId()));
        }

        return $this->render('appskills/new.html.twig', array(
            'appSkill' => $appSkill,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a appSkill entity.
     *
     * @Route("/{id}", name="appskills_show")
     * @Method("GET")
     */
    public function showAction(AppSkills $appSkill)
    {
        $deleteForm = $this->createDeleteForm($appSkill);

        return $this->render('appskills/show.html.twig', array(
            'appSkill' => $appSkill,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appSkill entity.
     *
     * @Route("/{id}/edit", name="appskills_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AppSkills $appSkill)
    {
        $deleteForm = $this->createDeleteForm($appSkill);
        $editForm = $this->createForm('AppBundle\Form\AppSkillsType', $appSkill);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appskills_edit', array('id' => $appSkill->getId()));
        }

        return $this->render('appskills/edit.html.twig', array(
            'appSkill' => $appSkill,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appSkill entity.
     *
     * @Route("/{id}", name="appskills_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AppSkills $appSkill)
    {
        $form = $this->createDeleteForm($appSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appSkill);
            $em->flush($appSkill);
        }

        return $this->redirectToRoute('appskills_index');
    }

    /**
     * Creates a form to delete a appSkill entity.
     *
     * @param AppSkills $appSkill The appSkill entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AppSkills $appSkill)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appskills_delete', array('id' => $appSkill->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
