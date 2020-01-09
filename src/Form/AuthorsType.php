<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use App\Entity\Authors;

class AuthorsType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', TextType::class, [
        'label' => "Nom de l'auteur",
      ])
      ->add('biography', TextareaType::class, [
        'label' => "Biography",
        'required' => false,
      ])
      ->add('birthday', DateType::class, [
        'format' => 'dd-MMMM-yyyy',
        'years' => range(1950, date('Y')),
        'label' => "Date de naissance",
        'required' => false,
      ])
      ->add('nationality', TextType::class, [
        'label' => "Nationalité",
        'required' => false,
      ])
      ->add('photo', TextType::class, [
        'label' => "Photo",
        'required' => false,
      ])
      ->add('link', TextType::class, [
        'label' => "Lien Allociné",
        'required' => false,
      ])
      ->add('save', SubmitType::class, [
        'label' => "Ajouter un réalisateur"
      ]);
  }
}
?>
