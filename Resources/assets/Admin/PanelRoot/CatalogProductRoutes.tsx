/*
 * @copyright EveryWorkflow. All rights reserved.
 */

import {lazy} from "react";

const ProductListPage = lazy(() => import("@EveryWorkflow/CatalogProductBundle/Admin/Page/ProductListPage"));
const ProductFormPage = lazy(() => import("@EveryWorkflow/CatalogProductBundle/Admin/Page/ProductFormPage"));

export const CatalogProductRoutes = [
    {
        path: '/catalog/product',
        exact: true,
        component: ProductListPage
    },
    {
        path: '/catalog/product/create',
        exact: true,
        component: ProductFormPage
    },
    {
        path: '/catalog/product/:uuid/edit',
        exact: true,
        component: ProductFormPage
    },
];
