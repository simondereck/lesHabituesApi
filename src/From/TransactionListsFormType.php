<?php

namespace App\Form;

use App\Entity\PageData;
use App\Tools\SMTools;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionListsFormType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('page',NumberType::class)
            ->add('limit',NumberType::class)
            ->add('type',ChoiceType::class,[
                "choices"=>[
                    "total" => SMTools::$TYPE_TOTAL,
                    "debiter"=>SMTools::$TYPE_DEBITER,
                    "crediter"=>SMTools::$TYPE_CREDITER
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PageData::class,
        ]);
    }
}
