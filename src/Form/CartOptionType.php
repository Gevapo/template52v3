<?php

namespace App\Form;

use App\Entity\CartOption;
use App\Entity\ProductOptionChoice;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartOptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event){
            /** @var CartOption $cartOption */
            $cartOption = $event->getData();
            $form = $event->getForm();

            $form->add('productOptionChoice', EntityType::class, [
                'class' => ProductOptionChoice::class,
                'query_builder' => function(EntityRepository $er) use ($cartOption) {
                    return $er->createQueryBuilder('c')
                        ->join('c.productoption', 'o')
                        ->where('o.id=:id')
                        ->setParameter('id', $cartOption->getProductOption()->getId())
                    ;
                },
                'label' => $cartOption->getProductOption()->getLabel(),
                'placeholder' => 'Maak een keuze',
                /*
                 * voeg een data-price attribuut toe aan de <option> elementen
                 */
                'choice_attr' => function (ProductOptionChoice $choice, $key, $index) {
                    return ['data-price' => (float) $choice->getPrice()];
                },

                /*
                 * Voeg een class attibuut toe aan de <select> element
                 */
                'attr' => array(
                    'class' => 'productoption'
                )
            ]);
        });

//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('cartItem')
//            ->add('productOption')
//        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CartOption::class,
        ]);
    }
}
