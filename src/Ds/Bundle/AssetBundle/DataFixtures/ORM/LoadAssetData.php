<?php

namespace Ds\Bundle\AssetBundle\DataFixtures\ORM;

use Ds\Bundle\AssetBundle\Entity\Asset;
use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadAssetData
 */
class LoadAssetData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixtures = $this->parse(__DIR__.'/../../Resources/data/{server}/assets.yml');

        foreach ($fixtures as $fixture) {
            $entity = new Asset();
            $entity->setUuid($fixture['uuid']);
            $entity->setOwner($fixture['owner']);
            $entity->setOwnerUuid($fixture['owner_uuid']);
            $entity->setIdentity($fixture['identity']);
            $entity->setIdentityUuid($fixture['identity_uuid']);
            $entity->setTitle($fixture['title']);

            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 0;
    }
}
