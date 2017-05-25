<?php

namespace Ds\Bundle\AssetBundle\DataFixtures\ORM;

use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\AssetBundle\Entity\Asset;
use Ds\Bundle\AssetBundle\Entity\AssetAssociation;

/**
 * Class LoadAssetAssociationData
 */
class LoadAssetAssociationData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $assetAssociations = $this->parse(__DIR__.'/../../Resources/data/{server}/asset_associations.yml');

        foreach ($assetAssociations as $assetAssociation) {
            $entity = new AssetAssociation;
            $entity
                ->setAsset($manager->getRepository(Asset::class)->findOneBy(['uuid' => $assetAssociation['asset']]))
                ->setUuid($assetAssociation['uuid'])
                ->setEntity($assetAssociation['entity'])
                ->setEntityUuid($assetAssociation['entity_uuid'])
                ->setOwner($assetAssociation['owner'])
                ->setOwnerUuid($assetAssociation['owner_uuid']);
            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
