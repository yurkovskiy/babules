<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package Controller Classes
 * @subpackage admin section
 * @name Controller_Admin_Commonentity class
 * @author Yuriy Bezgachnyuk, IF, Ukraine
 * @copyright 2013 by Yuriy Bezgachnyuk
 * @version 0.1
 *
 */

abstract class Controller_Commonentity extends Controller_Common
{

	/**
	 * @var String Model class name
	 */
	protected $modelName = "";

	/**
	 * @var String path to file with HTML template for action_index
	 */
	protected $indexViewFile = "";

	/**
	 * @var String path to file with HTML template for action_add
	 */
	protected $addFormViewFile = "";

	/**
	 * @var String path to file with HTML template for action_edit
	 */
	protected $editFormViewFile = "";

	/**
	 * @var String name of view file where will show error message
	 */
	protected $errorViewFile = "admin/error";

	/**
	 * @var mixed array with data from HTML-from
	 */
	protected $data = array();

	/**
	 * @var String URL for redirect (always action_index)
	 */
	protected $redirectURL = "";

	/**
	 * @var String name of primary key field for update action
	 */
	protected $keyFieldName = "";

	/**
	 * @var int number of records on page (for pagination)
	 */
	protected $items_per_page = 10; // 10 items by default

	public function before()
	{
		if (!Auth::instance()->logged_in())
		{
			$this->redirect("admin/login");
		}
		else
		{
			parent::before();
		}
	}

	/**
	 * Set new value of $this->items_per_page attribute
	 *
	 * @param int $newItemPerPage - number of records on page
	 */
	public function setItemsPerPage($newItemsPerPage)
	{
		if ($newItemsPerPage > 0) {
			$this->items_per_page = $newItemsPerPage;
		}
	}

	public function action_index()
	{
		$count = Model::factory($this->modelName)->countRecords();
		/* Paginator */
		$pagination = Pagination::factory(array('total_items' => $count, 'items_per_page' => $this->items_per_page));
		$model = Model::factory($this->modelName)->getRecordsRange($pagination->items_per_page, $pagination->offset);
		$page_links = $pagination->render();
		/* Paginator */
		$content = View::factory($this->indexViewFile)->bind('page_links', $page_links);
		$content->currentPage = $pagination->getCurrentPage();
		$content->itemsPerPage = $pagination->getItemsPerPage();
		$content->data = $model;
		$this->template->content = $content;
	}

	/**
	 * Handler for add/edit actions
	 *
	 * @param String $pathToViewFile - path to file where placed needed HTML-form
	 * @param int $record_id - primary key value
	 */
	protected function addEditHandler($pathToViewFile, $record_id = null)
	{
		$content = View::factory($pathToViewFile);
		if (!is_null($record_id))
		{
			$model = Model::factory($this->modelName)->getRecord($record_id);
			$content->data = $model;
		}
		$this->template->content = $content;
	}

	/**
	 * Method for handle edit action
	 *
	 */
	public function action_edit()
	{
		$record_id = $this->request->param('id');
		$this->addEditHandler($this->editFormViewFile, $record_id);
	}

	public function action_add()
	{
		$this->addEditHandler($this->addFormViewFile);
	}

	public function action_del() 
	{
		$record_id = $this->request->param('id');
		$this->action_erase($record_id);
	}

	/**
	 * Method which getting variables from HTML-forms
	 *
	 */
	protected function prepareMainData()
	{
		$fieldNames = Model::factory($this->modelName)->getFieldNames();
		for ($i = 1;$i < sizeof($fieldNames);$i++)
		{
			if (strlen($this->request->post($fieldNames[$i])) < 1)
			{
				$this->data[] = null;
			}
			else
			{
				$this->data[] = trim($this->request->post($fieldNames[$i]));
			}

		}
	}

	/**
	 * Method for handle error's actions (generate view after Exceptions)
	 *
	 * @param Model $model
	 */
	protected function showErrorMessage($model)
	{
		$content = View::factory($this->errorViewFile);
		$content->message = $model;
		$this->template->content = $content;
	}

	public function action_register()
	{
		// get variables from Request object
		$this->data[] = 0; // record_id - default for increment
		$this->prepareMainData();
		$model = Model::factory($this->modelName)->registerRecord($this->data);
		if (is_string($model))
		{
			$this->showErrorMessage($model);
			return;
		}
		if ($model)
		{
			$this->redirect($this->redirectURL);
		}
	}

	/**
	 * Method for handle update action
	 *
	 */
	public function action_update()
	{
		$this->data[] = intval($this->request->post($this->keyFieldName));
		$this->prepareMainData();
		$model = Model::factory($this->modelName)->updateRecord($this->data);
		if (is_string($model)) 
		{
			$this->showErrorMessage($model);
			return;
		}
		if ($model)
		{
			$this->redirect($this->redirectURL);
		}
	}

	/**
	 * Handler of erase action
	 *
	 * @param int $record_id - value of key (primary key)
	 */
	protected function action_erase($record_id)
	{
		$model = Model::factory($this->modelName)->eraseRecord($record_id);
		if (is_string($model))
		{
			$this->showErrorMessage($model);
			return;
		}
		if ($model)
		{
			$this->redirect($this->redirectURL);
		}
	}

} // end of class