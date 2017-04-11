<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Asin;
use AppBundle\Entity\AsinChild;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadAsinData extends AbstractFixture implements FixtureInterface,ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $user = $this->getReference('test-user');

        $asin = new Asin();
        $asin->setAsin('asin-asin');
        $asin->setTitle('asin-title');
        $asin->setMap(2.02);
        $asin->setUser($user);

        $manager->persist($asin);

        $child = new AsinChild();
        $child->setSellerName('New seller #1');
        $child->setLivePrice(1.01);
        $child->setAsin($asin);

        $manager->persist($child);

        $child = new AsinChild();
        $child->setSellerName('New seller #2');
        $child->setLivePrice(1.01);
        $child->setAsin($asin);

        $manager->persist($child);
        $manager->flush();

    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 2;
    }
}