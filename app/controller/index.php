<?php

namespace Controller;

class Index extends \Controller {

	/**
	 * GET /
	 * @param \Base $fw
	 * @return void
	 */
	public function index(\Base $fw) {
		if($this->_getUser()) {
			$fw->reroute('/dashboard');
		}
		$this->_render('index.html');
	}

	/**
	 * POST /login
	 * @param \Base $fw
	 * @return void
	 */
	public function login(\Base $fw) {
		if($this->_getUser()) {
			$fw->reroute('/dashboard');
		}
		$username = $fw->get('POST.username');
		$password = $fw->get('POST.password');
		$user = new \Model\User;
		$user->load(array('username = ?', $username));
		if($user->id) {
			if(password_verify($password, $user->password)) {
				$fw->set('SESSION.user_id', $user->id);
				$fw->reroute('/dashboard');
			}
		}

		$fw->set('error', 'Invalid username or password.');
		$this->_render('index.html');
	}

}
