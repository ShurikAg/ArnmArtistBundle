<?php
namespace Arnm\ArtistBundle\Controller;

use Arnm\ArtistBundle\Form\ArtistType;

use Arnm\ArtistBundle\Entity\Artist;

use Arnm\CoreBundle\Controllers\ArnmController;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * This controller is responsibel for artists management
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class ArtistMgrController extends ArnmController
{
    /**
     * Show list of artists
     */
    public function indexAction()
    {
        $entities = $this->getEntityManager()
            ->getRepository('ArnmArtistBundle:Artist')
            ->findAll();

        return $this->render('ArnmArtistBundle:ArtistMgr:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Shows and handles new artist form
     *
     * @return Response
     */
    public function newAction()
    {
        $artist = new Artist();
        $form = $this->createForm(new ArtistType(), $artist);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($artist);
                $em->flush();

                $this->getSession()
                    ->getFlashBag()
                    ->add('notice', $this->get('translator')
                    ->trans('artist.message.create.success', array(), 'artist'));

                return $this->redirect($this->generateUrl('arnm_artists'));
            }
        }
        return $this->render('ArnmArtistBundle:ArtistMgr:new.html.twig',
        array(
            'artist' => $artist,
            'form' => $form->createView()
        ));
    }

    /**
     * Shows and handles editing of existing artist form
     *
     * @return Response
     */
    public function editAction($id)
    {
        $em = $this->getEntityManager();
        $artist = $em->getRepository('ArnmArtistBundle:Artist')->findOneById($id);
        if (! ($artist instanceof Artist)) {
            throw $this->createNotFoundException("Requested artist was not found!");
        }

        $form = $this->createForm(new ArtistType(), $artist);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                $em->persist($artist);
                $em->flush();

                $this->getSession()
                    ->getFlashBag()
                    ->add('notice', $this->get('translator')
                    ->trans('artist.message.update.success', array(), 'artist'));

                return $this->redirect($this->generateUrl('arnm_artist_edit', array(
                    'id' => $artist->getId()
                )));
            }
        }
        return $this->render('ArnmArtistBundle:ArtistMgr:edit.html.twig',
        array(
            'artist' => $artist,
            'form' => $form->createView()
        ));
    }

    /**
     * Delete artist
     *
     * @return Response
     */
    public function deleteAction($id)
    {
        $em = $this->getEntityManager();
        $artist = $em->getRepository('ArnmArtistBundle:Artist')->findOneById($id);
        if (! ($artist instanceof Artist)) {
            throw new $this->createNotFoundException("Requested artist was not found!");
        }

        $em->remove($artist);
        $em->flush();

        $this->getSession()
            ->getFlashBag()
            ->add('notice', $this->get('translator')
            ->trans('artist.message.delete.success', array(), 'artist'));

        return $this->redirect($this->generateUrl('arnm_artists'));
    }
}
