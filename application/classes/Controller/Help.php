<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Help extends Controller_Common {

	public function action_about() {
		if (!Auth::instance()->logged_in()) {
			$this->redirect("login");
		}
		$content = View::factory("admin/help/about");
		$this->template->content = $content;
	}

} // End of Help