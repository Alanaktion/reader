<?php

// Init Composer autoloader
require_once 'vendor/autoload.php';

// Init app
$fw = Base::instance();
$fw->mset(array(
	'AUTOLOAD' => 'app/',
	'CACHE' => true,
	'ESCAPE' => false,
	'PREFIX' => 'dict.',
	'PACKAGE' => 'Reader',
	'UI' => 'app/view/',
));

// Init config
if(is_file('config.php')) {
	$fw->mset(require('config.php'));
} else {
	throw new Exception('No config.php file found.');
}

// Init db
$db = new DB\SQL(
	'mysql:host=' . $fw->get('db.host') . ';port=3306;dbname=' . $fw->get('db.database'),
	$fw->get('db.user'),
	$fw->get('db.password')
);
$fw->set('db.instance', $db);

// Initialize user
$userId = $fw->get('SESSION.user_id');
if($userId) {
	$user = new \Model\User;
	$user->load($userId);
	if($user->id) {
		$fw->set('user', $user->cast());
		$fw->set('user_obj', $user);
	}
}
