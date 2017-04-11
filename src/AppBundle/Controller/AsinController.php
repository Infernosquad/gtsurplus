<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Asin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Asin controller.
 *
 */
class AsinController extends Controller
{
    /**
     * Lists all asin entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $asins = $em->getRepository('AppBundle:Asin')->findBy([
            'user' => $this->getUser()
        ]);

        return $this->render('asin/index.html.twig', array(
            'asins' => $asins,
        ));
    }

    /**
     * Creates a new asin entity.
     *
     */
    public function newAction(Request $request)
    {
        $asin = new Asin();
        $asin->setUser($this->getUser());
        $form = $this->createForm('AppBundle\Form\AsinType', $asin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($asin);
            $em->flush();

            return $this->redirectToRoute('asin_show', array('id' => $asin->getId()));
        }

        return $this->render('asin/new.html.twig', array(
            'asin' => $asin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a asin entity.
     *
     */
    public function showAction(Asin $asin)
    {
        $deleteForm = $this->createDeleteForm($asin);

        return $this->render('asin/show.html.twig', array(
            'asin' => $asin,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing asin entity.
     *
     */
    public function editAction(Request $request, Asin $asin)
    {
        $deleteForm = $this->createDeleteForm($asin);
        $editForm = $this->createForm('AppBundle\Form\AsinType', $asin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('asin_edit', array('id' => $asin->getId()));
        }

        return $this->render('asin/edit.html.twig', array(
            'asin' => $asin,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a asin entity.
     *
     */
    public function deleteAction(Request $request, Asin $asin)
    {
        $form = $this->createDeleteForm($asin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($asin);
            $em->flush();
        }

        return $this->redirectToRoute('asin_index');
    }

    /**
     * Creates a form to delete a asin entity.
     *
     * @param Asin $asin The asin entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Asin $asin)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('asin_delete', array('id' => $asin->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
