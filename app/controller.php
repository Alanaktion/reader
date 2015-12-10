<?php

abstract class Controller {

	/**
	 * Get the currently logged in user ID
	 * @return int|bool
	 */
	protected function _getUser() {
		return \Base::instance()->get("user.id") ?: false;
	}

	/**
	 * Require a user to be logged in. Redirects to /login if a sesison is not found.
	 * @return int|bool
	 */
	protected function _requireLogin() {
		$id = $this->_getUser();
		if(!$id) {
			\Base::instance()->reroute('/');
		}
		return $id;
	}

	/**
	 * Render a view
	 * @param string  $file
	 * @param string  $mime
	 * @param array   $hive
	 * @param int     $ttl
	 */
	protected function _render($file, $mime = "text/html", array $hive = null, $ttl = 0) {
		echo \Template::instance()->render($file, $mime, $hive, $ttl);
	}

}
