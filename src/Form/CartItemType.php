<?php

namespace App\Form;

use App\Entity\CartItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var CartItem $cartItem */
        $cartItem = $builder->getData();

        $builder
            ->add('amount', null, [
                'label' => 'Aantal'
            ])
            ->add('cartOptions', CollectionType::class, [
                'label' => false,
                'entry_type' => CartOptionType::class,
                'entry_options' => [
                    'label' => false,
                ],
            ])
//            ->add('product')
//            ->add("In winkelwagen", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CartItem::class,
        ]);
    }
}
