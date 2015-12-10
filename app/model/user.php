<?php

namespace Model;

class User extends \Model {

	/**
	 * Array of \Model\Feed objects for the user
	 * @var array
	 */
	protected $feeds;

	/**
	 * Get the user's feed list
	 * @return array
	 */
	public function getFeeds() {
		if(!$this->feeds) {
			$userFeed = new \Model\User\Feed;
			$feedList = $userFeed->find(array('user_id = ?', $this->id));
			$feed = new \Model\Feed;
			$this->feeds = $feed->find('id IN (' . implode(',', $feedIds) . ')');
		}
		return $this->feeds;
	}

}
