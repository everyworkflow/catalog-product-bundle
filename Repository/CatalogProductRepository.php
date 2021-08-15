<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\CatalogProductBundle\Repository;

use EveryWorkflow\CoreBundle\Annotation\RepoDocument;
use EveryWorkflow\CatalogProductBundle\Entity\CatalogProductEntity;
use EveryWorkflow\EavBundle\Repository\BaseEntityRepository;

/**
 * @RepoDocument(doc_name=CatalogProductEntity::class)
 */
class CatalogProductRepository extends BaseEntityRepository implements CatalogProductRepositoryInterface
{
    protected string $collectionName = 'catalog_product_entity_collection';
    protected array $indexNames = ['sku'];
    protected string $entityCode = 'catalog_product';
}
