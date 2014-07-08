<?php
namespace Arnm\ArtistBundle\Controller;

use Arnm\ArtistBundle\Form\SettingsType;
use Arnm\ArtistBundle\Model\Settings;
use Arnm\ConfigBundle\Manager\ConfigManager;
use Arnm\CoreBundle\Controllers\ArnmController;
/**
 * This controller administrates Artists bundle settings
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class SettingsController extends ArnmController
{

    /**
     * @return Response
     */
    public function editAction()
    {
        $config = new Settings();
        $configMgr = $this->getConfigManager();
        $configMgr->load($config);

        $this->loadConfigObjects($config);

        $form = $this->createForm(new SettingsType(), $config);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                try {
                    $configMgr->save($config);

                    $this->getSession()
                        ->getFlashBag()
                        ->add('notice', $this->get('translator')
                        ->trans('artist.settings.message.update.success', array(), 'artist'));
                } catch (\Exception $exc) {
                    $this->getSession()
                        ->getFlashBag()
                        ->add('error', $this->get('translator')
                        ->trans($exc->getMessage(), array(), 'artist'));
                }

                return $this->redirect($this->generateUrl('arnm_artists_settings'));
            }
        }
        return $this->render('ArnmArtistBundle:Settings:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Load the objects into the settings object if ID's exist
     *
     * @param Settings $settings
     */
    protected function loadConfigObjects(Settings $settings)
    {
        $pageId = $settings->getInheritPage();
        if(!empty($pageId)){
            $settings->setPage($this->get('arnm_pages.manager')->getPageById($pageId));
        }
        $areaCode = $settings->getReplaceArea();
        if(!empty($areaCode)){
            $em = $this->getEntityManager();
            $settings->setArea($em->getRepository('ArnmPagesBundle:Area')->findOneByCode($areaCode));
        }
    }

    /**
     * Gets an instance of config manager
     *
     * @return Arnm\ConfigBundle\Manager\ConfigManager
     */
    protected function getConfigManager()
    {
        return $this->get('arnm_config.manager');
    }
}
