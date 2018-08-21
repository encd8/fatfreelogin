<?php
//! Base controller
class Controller {
	//! HTTP route pre-processor
	function beforeroute($f3) {
	}
	//! HTTP route post-processor
	function afterroute() {
		// Render HTML layout
		echo Template::instance()->render('layout.html');
	}
	//! Instantiate class
	function __construct() {
		$f3=Base::instance();
		global $md_db;
		$this->db = $md_db;
	}
}

