<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Activities_Activities extends Controller_Commonentity 
{

	protected $modelName = "Activities";
	protected $indexViewFile = "admin/activities/index";
	protected $addFormViewFile = "admin/activities/aeform";
	protected $editFormViewFile = "admin/activities/aeform";
	protected $searchFormViewFile = "admin/activities/searchform";
	protected $searchViewFile = "admin/activities/searchresult";
	protected $redirectURL = "activities/activities";
	protected $keyFieldName = "activity_id";
	protected $operationTypes = array("Витрата", "Спец. витрата");
	
	public function action_index()
	{
		$model = null;
		$pagination = null;
		$count = 0;
		
		$category_id = $this->request->param("id");
		// check filter
		if (isset($category_id))
		{
			$count = Model::factory($this->modelName)->countRecordsByCategory($category_id);
			$pagination = Pagination::factory(array('total_items' => $count, 'items_per_page' => $this->items_per_page));
			$model = Model::factory($this->modelName)->getRecordsRangeByCategory($pagination->items_per_page, $pagination->offset, $category_id);
		}
		else
		{
			$count = Model::factory($this->modelName)->countRecords();
			/* Paginator */
			$pagination = Pagination::factory(array('total_items' => $count, 'items_per_page' => $this->items_per_page));
			$model = Model::factory($this->modelName)->getRecordsRange($pagination->items_per_page, $pagination->offset);
		}
		
		// get information about categories
		$categoriesModel = Model::factory("Categories")->getRecords();
		$categories = array();
		
		foreach ($categoriesModel as $category)
		{
			$categories[$category->category_id] = $category->category_name;
		}
		unset($categoriesModel);
		$page_links = $pagination->render();

		$content = View::factory($this->indexViewFile)->bind('page_links', $page_links);
		if (isset($category_id))
		{
			$content->category_id = $category_id;
		}
		$content->currentPage = $pagination->getCurrentPage();
		$content->itemsPerPage = $pagination->getItemsPerPage();
		$content->operationTypes = $this->operationTypes;
		$content->categories = $categories;
		$content->data = $model;
		$this->template->content = $content;
	}
	
	/**
	 * Handler for search action [Display Search form]
	 */
	public function action_search()
	{
		Session::instance()->set("pattern", null); // reset search pattern
		$content = View::factory($this->searchFormViewFile);
		
		// get information about categories
		$categoriesModel = Model::factory("Categories")->getRecords();
		$content->categories = $categoriesModel;
		$this->template->content = $content;		
	}
	
	/**
	 * Handler for search
	 */
	public function action_dosearch()
	{
		// special variable for countRecorsByLetters
		$categories_str = null;
		
		$session = Session::instance();
		if (is_null($session->get("pattern")))
		{
			$session->set("pattern", htmlentities($this->request->post("activity_desc"), ENT_QUOTES));
			$session->set("category_ids", $this->request->post("category_ids"));
		}
		
		$pattern = $session->get("pattern");
		$category_ids = $session->get("category_ids");
	
		if (!is_null($category_ids))
		{
			$categories_str = "(";
			for ($i = 0; $i < count($category_ids) - 1;$i++)
			{
				$categories_str.= intval($category_ids[$i]).",";
			}
			$categories_str.= $category_ids[count($category_ids) - 1];
			$categories_str.= ")";
		}
			
		$count = Model::factory($this->modelName)->countRecordsByLetters("activity_desc", $pattern, $categories_str);
		$pagination = Pagination::factory(array('total_items' => $count, 'items_per_page' => $this->items_per_page));
		$model = Model::factory($this->modelName)->getRecordsRangeByLetters($pagination->items_per_page, $pagination->offset, "activity_desc", $pattern, $category_ids);
		
		// get information about categories
		$categoriesModel = Model::factory("Categories")->getRecords();
		$categories = array();
		
		foreach ($categoriesModel as $category)
		{
			$categories[$category->category_id] = $category->category_name;
		}
		unset($categoriesModel);
		
		$page_links = $pagination->render();
		$content = View::factory($this->searchViewFile)->bind('page_links', $page_links);
		$content->currentPage = $pagination->getCurrentPage();
		$content->itemsPerPage = $pagination->getItemsPerPage();
		$content->operationTypes = $this->operationTypes;
		$content->categories = $categories;
		$content->category_ids = $category_ids;
		$content->pattern = $pattern;
		$content->numberOfRecords = $count;
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
		// Get information about categories
		$model_categories = Model::factory("Categories")->getRecords();
		$content = View::factory($pathToViewFile);
		if (!is_null($record_id))
		{
			$model = Model::factory($this->modelName)->getRecord($record_id);
			$content->data = $model;
		}
		$content->categories = $model_categories;
		$this->template->content = $content;
	}
	
}