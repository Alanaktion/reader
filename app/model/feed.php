<?php

namespace Model;

class Feed extends \Model {

	protected $articles;

	/**
	 * Update the feed, fetching and storing new articles
	 * @return int
	 */
	public function update() {

	}

	/**
	 * Get all articles for the feed
	 * @return array
	 */
	public function getArticles() {
		if(!$this->articles) {
			$article = new \Model\Feed\Article;
			$this->articles = $article->find(array('feed_id = ?', $this->id));
		}
		return $this->articles;
	}

}
