<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\CatalogProductBundle\Controller\Admin;

use EveryWorkflow\CatalogProductBundle\Repository\CatalogProductRepositoryInterface;
use EveryWorkflow\CoreBundle\Annotation\EWFRoute;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetProductController extends AbstractController
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
     *     name="admin.catalog.product.view",
     *     methods="GET"
     * )
     * @throws \Exception
     */
    public function __invoke(string $uuid, Request $request): JsonResponse
    {
        $data = [];

        if ($uuid !== 'create') {
            $item = $this->catalogProductRepository->findById($uuid);
            if ($item) {
                $data['item'] = $item->toArray();
            }
        }

        $data['data_form'] = $this->catalogProductRepository->getForm()->toArray();

        return (new JsonResponse())->setData($data);
    }
}
