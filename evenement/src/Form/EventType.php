<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;


class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class, ['attr'=>['class' => 'form-control']])
            ->add('dateEvent',DateType::class,[
                'html5'  => false,
                'format' => 'dd-MM-yyyy']
                , ['attr'=>['class' => 'form-control js-datepicker','placeholder'=>"Date de naissance"]]
            )
            ->add('typeEvent',TextType::class, ['attr'=>['class' => 'form-control']])
            ->add('capacite',NumberType::class, ['attr'=>['class' => 'form-control ']])
            ->add('prix',NumberType::class, ['attr'=>['class' => 'form-control ']])
            ->add('imageFile',VichFileType::class, array(
                'label'             => 'Picture (.jpg or .png)',
                'download_link'     => false,
                'required'          => false,
                'delete_label'          => false
                

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
