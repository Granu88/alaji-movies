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

class MoviesType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', TextType::class, [
        'label' => "Nom du film",
      ])
      ->add('description', TextareaType::class, [
        'label' => "Synopsis",
        'required' => false,
      ])
      ->add('date', DateType::class, [
        'format' => 'dd-MMMM-yyyy',
        'years' => range(1950, date('Y')),
        'label' => "Date de parution",
        'required' => false,
      ])
      ->add('country', TextType::class, [
        'label' => "Pays",
        'required' => false,
      ])
      ->add('cover', TextType::class, [
        'label' => "Couverture",
        'required' => false,
      ])
      ->add('link', TextType::class, [
        'label' => "Lien Allociné",
        'required' => false,
      ])
      ->add('author', EntityType::class, [
        'label' => "Réalisateur",
        'class' => Authors::class,
        'choice_label' => 'name',
        'required' => false,
        'placeholder' => 'Séléctioner un réalisateur',
      ])
      ->add('save', SubmitType::class, [
        'label' => "Ajouter un film"
      ]);
  }
}
?>
