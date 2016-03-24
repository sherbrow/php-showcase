<?php

namespace BanqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as FormType;

class AccountType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', FormType\TextType::class, [ 'attr' => ['placeholder' => 'XX54']])
            ->add('name', FormType\TextType::class)
            ->add('credits', FormType\NumberType::class)
            ->add('submit', FormType\SubmitType::class, [ 'label' => 'Enregistrer'])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BanqueBundle\Entity\Account'
        ));
    }
}
