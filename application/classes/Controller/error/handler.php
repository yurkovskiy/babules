<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Error_Handler extends Controller_Common {

	public $template = "error";
	protected $mainPageURL = "";
	
	public function before()
	{
		parent::before();

		$this->template->page = URL::site(rawurldecode(Request::$initial->uri()));
		$this->mainPageURL = URL::site();

		// internal request
		if (Request::$initial !== Request::$current)
		{
			if ($message = rawurldecode($this->request->param('message')))
			{
				$this->template->message = $message;
			}
		}
		else
		{
			$this->request->action(404);
		}

		// set HTTP status
		$this->response->status((int) $this->request->action());
	}

	public function action_404()
	{
		$this->template->title = '404 Сторінка не знайдена';
		$this->template->message = "Будь-ласка спробуйте перезавантажити сторінку, або перейдіть на головну сторінку";
		$this->template->url = $this->mainPageURL;

		// check is it internal link
		if (isset ($_SERVER['HTTP_REFERER']) AND strstr($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME']) !== FALSE)
		{
			// assign flag
			$this->template->local = TRUE;
		}

		// assign HTTP status
		$this->response->status(404);
	}

	public function action_503()
	{
		$this->template->title = 'Service is unavaliable';
		$this->template->message = "Будь-ласка спробуйте перезавантажити сторінку, або перейдіть на головну сторінку";
	}

	public function action_500()
	{
		$this->template->title = 'Internal Server Error';
		$this->template->message = "Будь-ласка спробуйте перезавантажити сторінку, або перейдіть на головну сторінку";
	}

} // End Error_Handler