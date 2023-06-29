<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('surname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom*',
                'label_attr' => [
                    'class' => 'form-label mt-3 m-1'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Emplacement obligatoire',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} lettres',
                        'max' => 50,
                    ]),
                ],
            ])

            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Prénom*',
                'label_attr' => [
                    'class' => 'form-label mt-3 m-1'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Emplacement obligatoire',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le prénom doit contenir au moins {{ limit }} lettres',
                        'max' => 50,
                    ]),
                ],
            ])

            ->add('email',  TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'E-mail*',
                'label_attr' => [
                    'class' => 'form-label mt-3 m-1'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Emplacement obligatoire',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le mail doit contenir au moins {{ limit }} caractères',
                        'max' => 50,
                    ]),
                ],
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control'
                ],
                'label' => 'Mot de passe*',
                'label_attr' => [
                    'class' => 'form-label mt-3 m-1'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('deliveryAddress', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Adresse de Livraison',
                'label_attr' => [
                    'class' => 'form-label mt-3 m-1'
                ],
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} lettres',
                        'max' => 200,
                    ]),
                ],
            ])

            ->add('deliveryPostCode',  TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Code Postal de Livraison',
                'label_attr' => [
                    'class' => 'form-label mt-3 m-1'
                ],
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Le code postal ne contient que cinq chiffres',
                        'max' => 5,
                    ]),
                ],
            ])

            ->add('billingAddress',  TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Adresse de facturation*',
                'label_attr' => [
                    'class' => 'form-label mt-3 m-1'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Emplacement obligatoire',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'L\'adresse doit contenir au moins {{ limit }} lettres',
                        'max' => 200,
                    ]),
                ],
            ])

            ->add('billingPostCode', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Code Postal de facturation*',
                'label_attr' => [
                    'class' => 'form-label mt-3 m-1'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Emplacement obligatoire',
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Le code postal ne contient que cinq chiffres',
                        'max' => 5,
                    ]),
                ],
            ])
            
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-3 m-1'
                ],
                'label' => 'Enregistrer'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
