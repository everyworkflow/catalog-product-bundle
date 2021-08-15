<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\CatalogProductBundle\Controller\Admin;

use EveryWorkflow\CatalogProductBundle\DataGrid\CatalogProductDataGridInterface;
use EveryWorkflow\CoreBundle\Annotation\EWFRoute;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListProductController extends AbstractController
{
    protected CatalogProductDataGridInterface $catalogProductDataGrid;

    public function __construct(CatalogProductDataGridInterface $catalogProductDataGrid)
    {
        $this->catalogProductDataGrid = $catalogProductDataGrid;
    }

    /**
     * @EWFRoute(
     *     admin_api_path="catalog/product",
     *     name="admin.catalog.product",
     *     priority=10,
     *     methods="GET"
     * )
     */
    public function __invoke(Request $request): JsonResponse
    {
        $dataGrid = $this->catalogProductDataGrid->setFromRequest($request);
        return (new JsonResponse())->setData($dataGrid->toArray());
    }
}
