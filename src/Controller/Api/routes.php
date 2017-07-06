<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
     $routes->connect('/', ['controller' => 'Users', 'action' => 'login', 'home']);
		

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});
Router::prefix('api', function ($routes) {
    $routes->extensions(['json', 'xml']);

	$routes->resources(
		'Items', [
		   'map' => [
			   'item' => [
				   'action' => 'item',
				   'method' => 'GET'
			   ],
			   'itemdescription' => [
				   'action' => 'itemdescription',
				   'method' => 'GET'
			   ],
			   'view_all' => [
				   'action' => 'view_all',
				   'method' => 'GET'
			   ],
			   'search_item' => [
				   'action' => 'search_item',
				   'method' => 'GET'
			   ]
		   ]
		]
	);
	$routes->resources(
		'Customers', [
		   'map' => [
			   'registration' => [
				   'action' => 'registration',
				   'method' => 'GET'
			   ],
			   'profile_edit' => [
				   'action' => 'profile_edit',
				   'method' => 'POST'
				   ],
				   'my_account' => [
				   'action' => 'my_account',
				   'method' => 'GET'
				   ],
				   'push_token_update' => [
				   'action' => 'push_token_update',
				   'method' => 'POST'
				   ],
				   'customer_location_update' => [
				   'action' => 'customer_location_update',
				   'method' => 'GET'
				   ],
				   'customer_tracker' => [
				   'action' => 'customer_tracker',
				   'method' => 'GET'
				   ]
		   ]
		]
	);
	$routes->resources(
		'Users', [
		   'map' => [
			   'flash' => [
				   'action' => 'flash',
				   'method' => 'GET'
			   ],
			   'current_api_version' => [
				   'action' => 'current_api_version',
				   'method' => 'GET'
			   ]
		   ]
		]
	);
	$routes->resources(
		'ItemCategories', [
		   'map' => [
			   'home' => [
				   'action' => 'home',
				   'method' => 'GET'
			   ]
		   ]
		]
	);
	
	$routes->resources(
		'Carts', [
		   'map' => [
			   'plus_add_to_cart' => [
				   'action' => 'plus_add_to_cart',
 				   'method' => 'POST'
			   ],
			   'minus_add_to_cart' => [
				   'action' => 'minus_add_to_cart',
 				   'method' => 'POST'
			   ],
			   'fetch_add_to_cart' => [
				   'action' => 'fetch_add_to_cart',
				   'method' => 'POST'
			   ],
			   'reviewOrder' => [
				   'action' => 'reviewOrder',
				   'method' => 'GET'
			   ]
		   ]
		]
	);
	$routes->resources(
		'PromoCodes', [
		   'map' => [
			   'varifyPromoCodes' => [
				   'action' => 'varifyPromoCodes',
				   'method' => 'GET'
			   ]
		   ]
		]
	);
	$routes->resources(
		'CustomerAddresses', [
		   'map' => [
			   'add_address' => [
				   'action' => 'add_address',
				   'method' => 'POST'
			   ]
		   ]
		]
	);
	
		
		$routes->resources(
		'Plans', [
		   'map' => [
			   'plan' => [
				   'action' => 'plan',
				   'method' => 'GET'
			   ]
		   ]
		]
	);
	
	$routes->resources(
		'Orders', [
		   'map' => [
			   'track_order' => [
				   'action' => 'track_order',
				   'method' => 'GET'
			   ],
			   'view_my_track_order' => [
				   'action' => 'view_my_track_order',
				   'method' => 'GET'
				  ],
			   'my_order' => [
				   'action' => 'my_order',
				   'method' => 'GET'
			   ],
			   'place_order' => [
				   'action' => 'place_order',
				   'method' => 'POST'
			   ],
			   'cancel_order' => [
				   'action' => 'cancel_order',
				   'method' => 'GET'
			   ],
			   'pending_order_list' => [
				   'action' => 'pending_order_list',
				   'method' => 'GET'
			   ],
			   'view_my_pending_order' => [
				   'action' => 'view_my_pending_order',
				   'method' => 'GET'
			   ],
			   'driver_billing' => [
				   'action' => 'driver_billing',
				   'method' => 'POST'
			   ]
			 ]
		]);
				   
				   
	$routes->resources(
		'JainCashPoints', [
		   'map' => [
			   'referral' => [
				   'action' => 'referral',
				   'method' => 'GET'
			   ],
			   'referral_update' => [
				   'action' => 'referral_update',
				   'method' => 'GET'
			   ],
			   'jain_cash_details' => [
				   'action' => 'jain_cash_details',
				   'method' => 'GET'
			   ]
		   ]
		]
	);

	$routes->resources(
		'ComboOffers', [
		   'map' => [
			   'combo_offer_list' => [
				   'action' => 'combo_offer_list',
				   'method' => 'GET'
			   ],
			   'combo_offer_view' => [
				   'action' => 'combo_offer_view',
				   'method' => 'GET'
			   ]
		   ]
		]
	);

	$routes->resources(
		'BulkBookingLeads', [
		   'map' => [
			   'add_bulk_order' => [
				   'action' => 'add_bulk_order',
				   'method' => 'POST'
			   ]
		   ]
		]
	);
	
	$routes->resources(
		'ItemSubCategories', [
		   'map' => [
			   'itemsubcategory' => [
				   'action' => 'itemsubcategory',
				   'method' => 'GET'
			   ]
		   ]
		]
	);
	$routes->resources(
		'Feedbacks', [
		   'map' => [
			   'feedback_form' => [
				   'action' => 'feedback_form',
				   'method' => 'POST'
			   ]
		   ]
		]
	);
	$routes->resources(
		'Drivers', [
		   'map' => [
			   'supplier_locations' => [
				   'action' => 'supplier_locations',
				   'method' => 'GET'
			   ],
			   'supplier_login' => [
				   'action' => 'supplier_login',
				   'method' => 'GET'
			   ],
			   'push_token_update' => [
				   'action' => 'push_token_update',
				   'method' => 'POST'
			   ],
			   'driver_location_update' => [
				   'action' => 'driver_location_update',
				   'method' => 'GET'
			   ]
		   ]
		]
	);
	$routes->resources(
		'Wallets', [
		   'map' => [
			   'wallet_details' => [
				   'action' => 'wallet_details',
				   'method' => 'GET'
			   ],
			   'add_money' => [
				   'action' => 'add_money',
				   'method' => 'POST'
			   ]
		   ]
		]
	);
	$routes->resources(
		'CashBacks', [
		   'map' => [
			   'cash_back_details' => [
				   'action' => 'cash_back_details',
				   'method' => 'GET'
			   ],
			   'claim_on_cash_back' => [
				   'action' => 'claim_on_cash_back',
				   'method' => 'GET'
			   ]
		   ]
		]
	);
	

});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
