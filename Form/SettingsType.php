<?php
namespace Arnm\ArtistBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
/**
 * Template form use to manage Templates as well as gets embedded into page form
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class SettingsType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('page', 'entity', array(
        'class' => 'Arnm\PagesBundle\Entity\Page',
        'property' => 'title',
        'label' => 'artist.settings.form.inherit_page.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'artist.settings.form.inherit_page.help',
    		'translation_domain' => 'artist',
            'class' => 'form-control'
        ),
        'translation_domain' => 'artist',
        'required' => false
    ));
    $builder->add('area', 'entity', array(
        'class' => 'Arnm\PagesBundle\Entity\Area',
        'property' => 'code',
        'label' => 'artist.settings.form.replace_area.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'artist.settings.form.replace_area.help',
            'translation_domain' => 'artist',
            'class' => 'form-control'
        ),
        'translation_domain' => 'artist',
        'required' => false
    ));
  }

  /**
   * (non-PHPdoc)
   * @see Symfony\Component\Form.FormTypeInterface::getName()
   */
  public function getName()
  {
    return 'artist_settings';
  }

  /**
   * (non-PHPdoc)
   * @see Symfony\Component\Form.AbstractType::getDefaultOptions()
   */
  public function getDefaultOptions(array $options)
  {
    return array(
        'data_class' => 'Arnm\ArtistBundle\Model\Settings'
    );
  }
}
