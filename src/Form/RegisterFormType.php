<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
               'label' => 'Votre pseudo',
               'attr' => [
                  'placeholder' => 'Votre pseudo',
               ],
            ])
           ->add('email', EmailType::class, [
              'label'=>'Votre email',
              'attr'=>[
                 'placeholder'=>'Votre email'
              ]
           ])
           ->add('plainPassword', RepeatedType::class, [
              'type' => PasswordType::class,
              'invalid_message' => 'Les mots de passe sont différents',
              'options' => ['attr' => ['class' => 'password-field']],
              'required' => true,
              'first_options'  => ['label' => 'Mot de passe'],
              'second_options' => ['label' => 'Répéter le mot de passe'],
              'mapped' => false,
              'label' => 'Votre mot de passe',
              'attr' => ['autocomplete' => 'new-password',
                 'placeholder' => 'Votre mot de passe',
              ],
              'constraints' => [
                 new NotBlank([
                    'message' => 'Veuillez entrer un mot de passe',
                 ]),
                 new Length([
                    'min' => 6,
                    'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères.',
                    'max' => 4096,
                 ]),
              ],
           ])
           ->add('agreeTerms', CheckboxType::class, [
              'mapped' => false,
              'label' => 'Termes et conditions',
              'constraints' => [
                 new IsTrue([
                    'message' => 'Vous devez accepter nos conditions.',
                 ]),
              ],
           ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
