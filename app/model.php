<?php

abstract class Model extends DB\SQL\Mapper {

	/**
	 * Initialize model instance
	 */
	function __construct() {
		parent::__construct(\Base::instance()->get('db.instance'), $this->getTableName());
	}

	/**
	 * Get the database table name for the model
	 * @return string
	 */
	public function getTableName() {
		return strtolower(str_replace('\\', '_', trim(preg_replace('/^model/i', '', get_class($this)), '\\')));
	}

	/**
	 * Load by ID directly if a number is passed
	 * @param  string|array  $filter
	 * @param  array         $options
	 * @param  integer       $ttl
	 * @return mixed
	 */
	function load($filter=NULL, array $options=NULL, $ttl=0) {
		if(is_numeric($filter)) {
			return parent::load(array("id = ?", $filter), $options, $ttl);
		} elseif(is_array($filter)) {
			return parent::load($filter, $options, $ttl);
		}
		throw new \Exception('$filter must be an int or array');
	}

	/**
	 * Get or set the model data
	 * @param  array|null $data
	 * @return Model|array
	 */
	public function data(array $data = null) {
		if($data === null) {
			return $this->fields();
		} else {
			foreach($data as $key=>$val) {
				$this->set($key, $val);
			}
			return $this;
		}
	}

}
