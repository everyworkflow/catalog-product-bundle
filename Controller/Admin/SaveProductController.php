<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\CatalogProductBundle\Controller\Admin;

use EveryWorkflow\CatalogProductBundle\Entity\CatalogProductEntityInterface;
use EveryWorkflow\CatalogProductBundle\Repository\CatalogProductRepositoryInterface;
use EveryWorkflow\CoreBundle\Annotation\EWFRoute;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SaveProductController extends AbstractController
{
    protected CatalogProductRepositoryInterface $catalogProductRepository;

    public function __construct(CatalogProductRepositoryInterface $catalogProductRepository)
    {
        $this->catalogProductRepository = $catalogProductRepository;
    }

    /**
     * @EWFRoute(
     *     admin_api_path="catalog/product/{uuid}",
     *     defaults={"uuid"="create"},
     *     name="admin.catalog.product.save",
     *     methods="POST"
     * )
     */
    public function __invoke(string $uuid, Request $request): JsonResponse
    {
        $submitData = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        if ('create' === $uuid) {
            /** @var CatalogProductEntityInterface $item */
            $item = $this->catalogProductRepository->getNewEntity($submitData);
        } else {
            $item = $this->catalogProductRepository->findById($uuid);
            foreach ($submitData as $key => $val) {
                $item->setData($key, $val);
            }
        }
        $result = $this->catalogProductRepository->saveEntity($item);

        if ($result->getUpsertedId()) {
            $item->setData('_id', $result->getUpsertedId());
        }

        return (new JsonResponse())->setData([
            'message' => 'Successfully saved changes.',
            'item' => $item->toArray(),
        ]);
    }
}
