<?php defined('SYSPATH') or die('No direct script access.');

// Login Controller

class Controller_Login extends Controller_Logincommon {

	public function action_index() {
		if (!Auth::instance()->logged_in()) {
			$content = View::factory('/admin/login/loginform');
			$this->template->content = $content;
		}
		else {
			$this->redirect("Main");
		}
	}

	public function action_login() {
		$postVars = $this->request->post();
		$success = Auth::instance()->login($postVars['username'], $postVars['password']);
		if (!$success) {
			Session::instance()->set("authProblem", 1);
		} else {
			Session::instance()->delete("authProblem");
		}
		$this->redirect("main");
	}
	
	public function action_logout() {
		Auth::instance()->logout();
		$this->redirect("login");
	}
	
} // Login Controller