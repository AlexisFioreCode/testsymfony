<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                "label" => "Votre titre :",
            ])
            ->add('content', null, [
                "label" => "Contenu :",
            ])
            ->add('author', null, [
                "label" => "Auteur :",
            ])
            ->add('category', null, [
                "label" => "Catégorie :",
            ])

            ->add('enregistrer', SubmitType::class, [
                "attr" => ["class" => "bg-dark text-white"],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
