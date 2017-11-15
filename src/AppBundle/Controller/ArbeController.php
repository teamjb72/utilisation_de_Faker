<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Arbe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Arbe controller.
 *
 * @Route("arbe")
 */
class ArbeController extends Controller
{
    /**
     * Lists all arbe entities.
     *
     * @Route("/", name="arbe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $arbes = $em->getRepository('AppBundle:Arbe')->findAll();

        return $this->render('arbe/index.html.twig', array(
            'arbes' => $arbes,
        ));
    }

    /**
     * Creates a new arbe entity.
     *
     * @Route("/new", name="arbe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $arbe = new Arbe();
        $form = $this->createForm('AppBundle\Form\ArbeType', $arbe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($arbe);
            $em->flush();

            return $this->redirectToRoute('arbe_show', array('id' => $arbe->getId()));
        }

        return $this->render('arbe/new.html.twig', array(
            'arbe' => $arbe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a arbe entity.
     *
     * @Route("/{id}", name="arbe_show")
     * @Method("GET")
     */
    public function showAction(Arbe $arbe)
    {
        $deleteForm = $this->createDeleteForm($arbe);

        return $this->render('arbe/show.html.twig', array(
            'arbe' => $arbe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing arbe entity.
     *
     * @Route("/{id}/edit", name="arbe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Arbe $arbe)
    {
        $deleteForm = $this->createDeleteForm($arbe);
        $editForm = $this->createForm('AppBundle\Form\ArbeType', $arbe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('arbe_edit', array('id' => $arbe->getId()));
        }

        return $this->render('arbe/edit.html.twig', array(
            'arbe' => $arbe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a arbe entity.
     *
     * @Route("/{id}", name="arbe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Arbe $arbe)
    {
        $form = $this->createDeleteForm($arbe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($arbe);
            $em->flush();
        }

        return $this->redirectToRoute('arbe_index');
    }

    /**
     * Creates a form to delete a arbe entity.
     *
     * @param Arbe $arbe The arbe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Arbe $arbe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('arbe_delete', array('id' => $arbe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
