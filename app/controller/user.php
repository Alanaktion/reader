<?php

namespace Controller;

class User extends \Controller {

	protected $userId;

	public function __construct() {
		$this->userId = $this->_requireLogin();
	}

	/**
	 * GET /dashboard
	 * @return void
	 */
	public function dashboard() {
		$this->_render('dashboard.html');
	}

	/**
	 * GET|POST /logout
	 * @param  \Base $fw
	 * @return void
	 */
	public function logout(\Base $fw) {
		$fw->set('SESSION.user_id', null);
		$fw->reroute('/');
	}

}
