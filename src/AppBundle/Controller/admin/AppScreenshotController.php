<?php

namespace AppBundle\Controller\admin;

use AppBundle\Entity\AppScreenshot;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Appscreenshot controller.
 *
 * @Route("admin/appscreenshot")
 */
class AppScreenshotController extends Controller
{
    /**
     * Lists all appScreenshot entities.
     *
     * @Route("/", name="appscreenshot_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appScreenshots = $em->getRepository('AppBundle:AppScreenshot')->findAll();

        return $this->render('appscreenshot/index.html.twig', array(
            'appScreenshots' => $appScreenshots,
        ));
    }

    /**
     * Creates a new appScreenshot entity.
     *
     * @Route("/new", name="appscreenshot_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $appScreenshot = new Appscreenshot();
        $form = $this->createForm('AppBundle\Form\AppScreenshotType', $appScreenshot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appScreenshot);
            $em->flush($appScreenshot);

            return $this->redirectToRoute('appscreenshot_show', array('id' => $appScreenshot->getId()));
        }

        return $this->render('appscreenshot/new.html.twig', array(
            'appScreenshot' => $appScreenshot,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a appScreenshot entity.
     *
     * @Route("/{id}", name="appscreenshot_show")
     * @Method("GET")
     */
    public function showAction(AppScreenshot $appScreenshot)
    {
        $deleteForm = $this->createDeleteForm($appScreenshot);

        return $this->render('appscreenshot/show.html.twig', array(
            'appScreenshot' => $appScreenshot,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appScreenshot entity.
     *
     * @Route("/{id}/edit", name="appscreenshot_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AppScreenshot $appScreenshot)
    {
        $deleteForm = $this->createDeleteForm($appScreenshot);
        $editForm = $this->createForm('AppBundle\Form\AppScreenshotType', $appScreenshot);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appscreenshot_edit', array('id' => $appScreenshot->getId()));
        }

        return $this->render('appscreenshot/edit.html.twig', array(
            'appScreenshot' => $appScreenshot,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appScreenshot entity.
     *
     * @Route("/{id}", name="appscreenshot_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AppScreenshot $appScreenshot)
    {
        $form = $this->createDeleteForm($appScreenshot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appScreenshot);
            $em->flush($appScreenshot);
        }

        return $this->redirectToRoute('appscreenshot_index');
    }

    /**
     * Creates a form to delete a appScreenshot entity.
     *
     * @param AppScreenshot $appScreenshot The appScreenshot entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AppScreenshot $appScreenshot)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appscreenshot_delete', array('id' => $appScreenshot->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
