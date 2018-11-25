<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_Common {

	public function action_index() {
		if (!Auth::instance()->logged_in()) {
			$this->redirect("login");
		}
		else {
			$content = View::factory('admin/frontpage/index');
			$this->template->content = $content;
		}
	}

} // Main Controller