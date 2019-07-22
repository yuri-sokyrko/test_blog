<?php

return [
	// MainController
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'main/index/{page:\d+}' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'post/{id:\d+}' => [
		'controller' => 'main',
		'action' => 'post',
	],
	'main/category/{id:\d+}' => [
		'controller' => 'main',
		'action' => 'category',
	],
	'like/{id:\d+}' => [
		'controller' => 'main',
		'action' => 'like',
	],
    
	// AdminController
	'admin/login' => [
		'controller' => 'admin',
		'action' => 'login',
	],
	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],
	'admin/add' => [
		'controller' => 'admin',
		'action' => 'add',
	],
	'admin/edit/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'edit',
	],
	'admin/delete/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'delete',
	],
	'admin/posts/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'posts',
	],
	'admin/posts' => [
		'controller' => 'admin',
		'action' => 'posts',
	],
	'admin/categories' => [
		'controller' => 'admin',
		'action' => 'categories',
	],
	'admin/deleteCat/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'deleteCat',
	],

    // AccountController
    'account/login' => [
        'controller' => 'account',
        'action' => 'login'
    ],

    'account/register' => [
        'controller' => 'account',
        'action' => 'register'
	],
	'account/logout' => [
        'controller' => 'account',
        'action' => 'logout'
    ],
];