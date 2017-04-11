<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AsinChild;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Asinchild controller.
 *
 */
class AsinChildController extends Controller
{
    /**
     * Lists all asinChild entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $asinChildren = $em->getRepository('AppBundle:AsinChild')->findByUser($this->getUser());

        return $this->render('asinchild/index.html.twig', array(
            'asinChildren' => $asinChildren,
        ));
    }

    /**
     * Creates a new asinChild entity.
     *
     */
    public function newAction(Request $request)
    {
        $asinChild = new Asinchild();
        $form = $this->createForm('AppBundle\Form\AsinChildType', $asinChild);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($asinChild);
            $em->flush();

            return $this->redirectToRoute('asinchild_show', array('id' => $asinChild->getId()));
        }

        return $this->render('asinchild/new.html.twig', array(
            'asinChild' => $asinChild,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a asinChild entity.
     *
     */
    public function showAction(AsinChild $asinChild)
    {
        $deleteForm = $this->createDeleteForm($asinChild);

        return $this->render('asinchild/show.html.twig', array(
            'asinChild' => $asinChild,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing asinChild entity.
     *
     */
    public function editAction(Request $request, AsinChild $asinChild)
    {
        $deleteForm = $this->createDeleteForm($asinChild);
        $editForm = $this->createForm('AppBundle\Form\AsinChildType', $asinChild);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('asinchild_edit', array('id' => $asinChild->getId()));
        }

        return $this->render('asinchild/edit.html.twig', array(
            'asinChild' => $asinChild,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a asinChild entity.
     *
     */
    public function deleteAction(Request $request, AsinChild $asinChild)
    {
        $form = $this->createDeleteForm($asinChild);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($asinChild);
            $em->flush();
        }

        return $this->redirectToRoute('asinchild_index');
    }

    /**
     * Creates a form to delete a asinChild entity.
     *
     * @param AsinChild $asinChild The asinChild entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AsinChild $asinChild)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('asinchild_delete', array('id' => $asinChild->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
