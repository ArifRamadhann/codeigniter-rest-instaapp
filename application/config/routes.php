<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']    = 'feed';
$route['404_override']          = 'not-found';
$route['translate_uri_dashes']  = TRUE;

// -------------------------
// API Routes
// -------------------------

// Main Routes
$route['api']                            = 'api/main';

// Auth Routes
$route['api/auth/register']['POST']      = 'api/auth/register';
$route['api/auth/login']['POST']         = 'api/auth/login';
$route['api/auth/logout']['POST']        = 'api/auth/logout';
$route['api/auth/me']['POST']            = 'api/auth/me';

// User Routes
$route['api/user/show']['POST']          = 'api/user/show';
$route['api/user/update']['POST']        = 'api/user/update';

// Post Routes
$route['api/post/create']['POST']        = 'api/post/create';
$route['api/post/show']['POST']          = 'api/post/show';
$route['api/post/delete']['POST']        = 'api/post/delete';
$route['api/feeds']['POST']              = 'api/post/feeds'; // Get feed of current user

// Follow Routes
$route['api/follow/suggestion']['POST']  = 'api/follow/suggestion';
$route['api/follow/follow']['POST']      = 'api/follow/follow';
$route['api/follow/unfollow']['POST']    = 'api/follow/unfollow';
$route['api/followers']['POST']          = 'api/follow/followers';
$route['api/following']['POST']          = 'api/follow/following';

// Likes Routes
$route['api/like/']['POST']              = 'api/like/like';
$route['api/unlike/']['POST']            = 'api/like/unlike'; 

// Comment Routes
$route['api/comment/add']['POST']        = 'api/comment/add'; // Comment on post ID
$route['api/comment/remove']['POST']     = 'api/comment/remove'; // Comment on post ID

// -------------------------
// APP Routes
// -------------------------

// Feed Routes
$route['feed']                  = 'feed';
$route['feed/(:any)']           = 'feed/$1';
$route['feed/(:any)/(:any)']    = 'feed/$1/$2';

// Auth Routes (app)
$route['auth']                  = 'auth';
$route['auth/(:any)']           = 'auth/$1';
$route['auth/(:any)/(:any)']    = 'auth/$1/$2';

// Profile Routes
$route['profile']               = 'profile';
$route['profile/(:any)']        = 'profile/$1';
$route['profile/(:any)/(:any)'] = 'profile/$1/$2';

// Post Routes
$route['post']                  = 'post';
$route['post/(:any)']           = 'post/$1';
$route['post/(:any)/(:any)']    = 'post/$1/$2';

// Explore Routes
$route['explore']               = 'explore';
$route['explore/(:any)']        = 'explore/$1';
$route['explore/(:any)/(:any)'] = 'explore/$1/$2';