<?php
namespace Arnm\ArtistBundle\Controller;

use Arnm\ArtistBundle\Model\Settings;

use Arnm\PagesBundle\Model\PageContentResplacement;

use Arnm\ArtistBundle\Entity\Artist;

use Arnm\CoreBundle\Controllers\ArnmController;
/**
 * Responsible for rendering artists page
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class ArtistController extends ArnmController
{

    public function showAction($slug)
    {
        $artist = $this->getEntityManager()
            ->getRepository('ArnmArtistBundle:Artist')
            ->findOneBySlug($slug);

        if (! ($artist instanceof Artist) || $artist->getActive() !== true) {
            throw $this->createNotFoundException('Artist not found!');
        }

        $settings = new Settings();
        $configMgr = $this->get('arnm_config.manager');
        $configMgr->load($settings);

        //find the page we need to inherit
        $page = $this->get('arnm_pages.manager')->getPageById($settings->getInheritPage());

        $content = $this->renderView('ArnmArtistBundle:Artist:show.html.twig', array(
            'artist' => $artist
        ));

        $replacement = new PageContentResplacement();
        $replacement->setTitle($artist->getTitle());
        $replacement->setContent($content);

        return $this->forward('ArnmPagesBundle:Page:inheritPage', array(
            'page' => $page,
            'area' => $settings->getReplaceArea(),
            'replacement' => $replacement
        ));
    }
}
