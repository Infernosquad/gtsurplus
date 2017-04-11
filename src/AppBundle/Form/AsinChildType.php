<?php

namespace AppBundle\Form;

use AppBundle\Entity\Asin;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AsinChildType extends AbstractType
{
    /**
     * @var TokenStorageInterface
     */
    private $storage;

    public function __construct(TokenStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->storage->getToken()->getUser();

        $builder
            ->add('sellerName')
            ->add('livePrice')
            ->add('asin', EntityType::class, [
                'class' => Asin::class,
                'query_builder' => function (EntityRepository $er) use($user) {
                    return $er->createQueryBuilder('a')
                        ->where('a.user = :user')
                        ->setParameter('user',$user->getId());
                },
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\AsinChild'
        ]);
    }
}
