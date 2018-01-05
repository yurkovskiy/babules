<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Activities_Activities extends Controller_Commonentity 
{

	protected $modelName = "Activities";
	protected $indexViewFile = "admin/activities/index";
	protected $addFormViewFile = "admin/activities/aeform";
	protected $editFormViewFile = "admin/activities/aeform";
	protected $redirectURL = "activities/activities";
	protected $keyFieldName = "activity_id";
	protected $operationTypes = array("Витрата", "Дохід");
		
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
		
		/*if (!isset($_GET['page']))
		{
			//if (is_null($pagination->getCurrentPage()))
			{
				$url = $pagination->url($pagination->getLastPage());
				$this->request->redirect($url);
			}
		}*/
										
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