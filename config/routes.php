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
				  ]
			 ]
		]);
				   
				   
	$routes->resources(
		'JainCashPoints', [
		   'map' => [
			   'referral' => [
				   'action' => 'referral',
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
