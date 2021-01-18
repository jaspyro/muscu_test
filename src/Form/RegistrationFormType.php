<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // --> nom d'utilisateur <-- \\
            ->add('username')


            // --> condition d'utilisation <-- \\
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'j\'accepte les conditions d\'utilisations :',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'vous devez accepter nos condition d\'utilisation.',
                    ]),
                ],
            ])

            // --> email <-- \\
            ->add('email', EmailType::class)

            // --> mots de passe <-- \\
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                    // --> demande a l'utilisateur d'entrer deux fois le mots de passe dans des champs différent pour valider le mots de passe <--\\
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options' => ['label' => 'entrer votre mots de passe:'],
                'second_options' => ['label' => 'rentrer de nouveau le mots de passe.'],
                    // --> message erreur <-- \\
                        // --> vérifie si les deux mots de passe sont les mêmes <-- \\
                        // --> vérifie si un mots de passe a été rentrer. <-- \\
                        // --> vérifie si sa taille limite est entre valeur minimal et valeur maximal <-- \\
                'invalid_message' => 'Les Mots de passe ne sont pas identique !',
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'vous devez entrer un mots de passe pour vous enregistrer',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'votre mots de passe doit contenir au moins {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
