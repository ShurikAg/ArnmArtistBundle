<?php
namespace Arnm\ArtistBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
/**
 * Template form use to manage Templates as well as gets embedded into page form
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class ArtistType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('name', 'text', array(
        'label' => 'artist.form.name.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'artist.form.name.help',
    		'translation_domain' => 'artist',
            'class' => 'form-control'
        ),
        'translation_domain' => 'artist',
        'required' => false
    ));
    $builder->add('title', 'text', array(
        'label' => 'artist.form.title.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'artist.form.title.help',
            'translation_domain' => 'artist',
            'class' => 'form-control'
        ),
        'translation_domain' => 'artist',
        'required' => false
    ));
    $builder->add('slug', 'text', array(
        'label' => 'artist.form.slug.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'artist.form.slug.help',
            'translation_domain' => 'artist',
            'class' => 'form-control'
        ),
        'translation_domain' => 'artist',
        'required' => false
    ));
    $builder->add('statement', 'textarea', array(
        'label' => 'artist.form.statement.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'artist.form.statement.help',
            'translation_domain' => 'artist',
            'class' => 'form-control'
        ),
        'translation_domain' => 'artist',
        'required' => false
    ));
    $builder->add('file', 'file', array(
        'label' => 'artist.form.file.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'artist.form.file.help',
            'translation_domain' => 'artist',
            'class' => ''
        ),
        'translation_domain' => 'artist',
        'required' => false
    ));
    $builder->add('active', 'checkbox', array(
        'label' => 'artist.form.active.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'artist.form.active.help',
            'translation_domain' => 'artist',
            'class' => 'checkbox'
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
    return 'artist';
  }

  /**
   * (non-PHPdoc)
   * @see Symfony\Component\Form.AbstractType::getDefaultOptions()
   */
  public function getDefaultOptions(array $options)
  {
    return array(
        'data_class' => 'Arnm\ArtistBundle\Entity\Artist'
    );
  }
}
