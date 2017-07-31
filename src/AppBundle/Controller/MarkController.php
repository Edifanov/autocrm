<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations;

use AppBundle\Entity\Mark;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MarkController
 * @package AppBundle\Controller
 * @Annotations\RouteResource("mark")
 */
class MarkController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Lists all mark entities.
     *
     */
    public function cgetAction()
    {
        $em = $this->getDoctrine()->getManager();

        $marks = $em->getRepository('AppBundle:Mark')->findAll();

        $data = array("marks" => $marks);
        $view = $this->view($data);
        return $this->handleView($view);
    }

    /**
     * Creates a new mark entity.
     *
     */
    public function newAction(Request $request)
    {
        $mark = new Mark();
        $form = $this->createForm('AppBundle\Form\MarkType', $mark);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mark);
            $em->flush();

            return $this->redirectToRoute('mark_show', array('id' => $mark->getId()));
        }

        return $this->render('mark/new.html.twig', array(
            'mark' => $mark,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a mark entity.
     *
     */
    public function showAction(Mark $mark)
    {
        $deleteForm = $this->createDeleteForm($mark);

        return $this->render('mark/show.html.twig', array(
            'mark' => $mark,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing mark entity.
     *
     */
    public function editAction(Request $request, Mark $mark)
    {
        $deleteForm = $this->createDeleteForm($mark);
        $editForm = $this->createForm('AppBundle\Form\MarkType', $mark);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mark_edit', array('id' => $mark->getId()));
        }

        return $this->render('mark/edit.html.twig', array(
            'mark' => $mark,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a mark entity.
     *
     */
    public function deleteAction(Request $request, Mark $mark)
    {
        $form = $this->createDeleteForm($mark);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mark);
            $em->flush();
        }

        return $this->redirectToRoute('mark_index');
    }

    /**
     * Creates a form to delete a mark entity.
     *
     * @param Mark $mark The mark entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Mark $mark)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mark_delete', array('id' => $mark->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
