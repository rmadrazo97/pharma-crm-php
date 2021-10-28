<?php

namespace PHPMaker2022\pharma;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // customers
    $app->map(["GET","POST","OPTIONS"], '/CustomersList[/{customer_id}]', CustomersController::class . ':list')->add(PermissionMiddleware::class)->setName('CustomersList-customers-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/CustomersAdd[/{customer_id}]', CustomersController::class . ':add')->add(PermissionMiddleware::class)->setName('CustomersAdd-customers-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/CustomersView[/{customer_id}]', CustomersController::class . ':view')->add(PermissionMiddleware::class)->setName('CustomersView-customers-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/CustomersEdit[/{customer_id}]', CustomersController::class . ':edit')->add(PermissionMiddleware::class)->setName('CustomersEdit-customers-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/CustomersDelete[/{customer_id}]', CustomersController::class . ':delete')->add(PermissionMiddleware::class)->setName('CustomersDelete-customers-delete'); // delete
    $app->group(
        '/customers',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{customer_id}]', CustomersController::class . ':list')->add(PermissionMiddleware::class)->setName('customers/list-customers-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{customer_id}]', CustomersController::class . ':add')->add(PermissionMiddleware::class)->setName('customers/add-customers-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{customer_id}]', CustomersController::class . ':view')->add(PermissionMiddleware::class)->setName('customers/view-customers-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{customer_id}]', CustomersController::class . ':edit')->add(PermissionMiddleware::class)->setName('customers/edit-customers-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{customer_id}]', CustomersController::class . ':delete')->add(PermissionMiddleware::class)->setName('customers/delete-customers-delete-2'); // delete
        }
    );

    // products
    $app->map(["GET","POST","OPTIONS"], '/ProductsList[/{product_id}]', ProductsController::class . ':list')->add(PermissionMiddleware::class)->setName('ProductsList-products-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ProductsAdd[/{product_id}]', ProductsController::class . ':add')->add(PermissionMiddleware::class)->setName('ProductsAdd-products-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ProductsView[/{product_id}]', ProductsController::class . ':view')->add(PermissionMiddleware::class)->setName('ProductsView-products-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ProductsEdit[/{product_id}]', ProductsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProductsEdit-products-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ProductsDelete[/{product_id}]', ProductsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProductsDelete-products-delete'); // delete
    $app->group(
        '/products',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{product_id}]', ProductsController::class . ':list')->add(PermissionMiddleware::class)->setName('products/list-products-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{product_id}]', ProductsController::class . ':add')->add(PermissionMiddleware::class)->setName('products/add-products-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{product_id}]', ProductsController::class . ':view')->add(PermissionMiddleware::class)->setName('products/view-products-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{product_id}]', ProductsController::class . ':edit')->add(PermissionMiddleware::class)->setName('products/edit-products-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{product_id}]', ProductsController::class . ':delete')->add(PermissionMiddleware::class)->setName('products/delete-products-delete-2'); // delete
        }
    );

    // sales_order
    $app->map(["GET","POST","OPTIONS"], '/SalesOrderList[/{order_id}]', SalesOrderController::class . ':list')->add(PermissionMiddleware::class)->setName('SalesOrderList-sales_order-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/SalesOrderAdd[/{order_id}]', SalesOrderController::class . ':add')->add(PermissionMiddleware::class)->setName('SalesOrderAdd-sales_order-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/SalesOrderView[/{order_id}]', SalesOrderController::class . ':view')->add(PermissionMiddleware::class)->setName('SalesOrderView-sales_order-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/SalesOrderEdit[/{order_id}]', SalesOrderController::class . ':edit')->add(PermissionMiddleware::class)->setName('SalesOrderEdit-sales_order-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/SalesOrderDelete[/{order_id}]', SalesOrderController::class . ':delete')->add(PermissionMiddleware::class)->setName('SalesOrderDelete-sales_order-delete'); // delete
    $app->group(
        '/sales_order',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{order_id}]', SalesOrderController::class . ':list')->add(PermissionMiddleware::class)->setName('sales_order/list-sales_order-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{order_id}]', SalesOrderController::class . ':add')->add(PermissionMiddleware::class)->setName('sales_order/add-sales_order-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{order_id}]', SalesOrderController::class . ':view')->add(PermissionMiddleware::class)->setName('sales_order/view-sales_order-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{order_id}]', SalesOrderController::class . ':edit')->add(PermissionMiddleware::class)->setName('sales_order/edit-sales_order-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{order_id}]', SalesOrderController::class . ':delete')->add(PermissionMiddleware::class)->setName('sales_order/delete-sales_order-delete-2'); // delete
        }
    );

    // sales_order_detail
    $app->map(["GET","POST","OPTIONS"], '/SalesOrderDetailList[/{order_detail_id}]', SalesOrderDetailController::class . ':list')->add(PermissionMiddleware::class)->setName('SalesOrderDetailList-sales_order_detail-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/SalesOrderDetailAdd[/{order_detail_id}]', SalesOrderDetailController::class . ':add')->add(PermissionMiddleware::class)->setName('SalesOrderDetailAdd-sales_order_detail-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/SalesOrderDetailView[/{order_detail_id}]', SalesOrderDetailController::class . ':view')->add(PermissionMiddleware::class)->setName('SalesOrderDetailView-sales_order_detail-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/SalesOrderDetailEdit[/{order_detail_id}]', SalesOrderDetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('SalesOrderDetailEdit-sales_order_detail-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/SalesOrderDetailDelete[/{order_detail_id}]', SalesOrderDetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('SalesOrderDetailDelete-sales_order_detail-delete'); // delete
    $app->group(
        '/sales_order_detail',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{order_detail_id}]', SalesOrderDetailController::class . ':list')->add(PermissionMiddleware::class)->setName('sales_order_detail/list-sales_order_detail-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{order_detail_id}]', SalesOrderDetailController::class . ':add')->add(PermissionMiddleware::class)->setName('sales_order_detail/add-sales_order_detail-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{order_detail_id}]', SalesOrderDetailController::class . ':view')->add(PermissionMiddleware::class)->setName('sales_order_detail/view-sales_order_detail-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{order_detail_id}]', SalesOrderDetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('sales_order_detail/edit-sales_order_detail-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{order_detail_id}]', SalesOrderDetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('sales_order_detail/delete-sales_order_detail-delete-2'); // delete
        }
    );

    // users
    $app->map(["GET","POST","OPTIONS"], '/UsersList[/{user_id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('UsersList-users-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UsersAdd[/{user_id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('UsersAdd-users-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/UsersView[/{user_id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('UsersView-users-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/UsersEdit[/{user_id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('UsersEdit-users-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UsersDelete[/{user_id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('UsersDelete-users-delete'); // delete
    $app->group(
        '/users',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{user_id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('users/list-users-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{user_id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('users/add-users-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{user_id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('users/view-users-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{user_id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('users/edit-users-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{user_id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('users/delete-users-delete-2'); // delete
        }
    );

    // error
    $app->map(["GET","POST","OPTIONS"], '/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
