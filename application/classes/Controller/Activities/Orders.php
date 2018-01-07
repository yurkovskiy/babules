<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Orders Controller [Activities]
 * @author Yuriy Bezgachnyuk
 * @copyright 2014, Yuriy Bezgachnyuk, IF, Ukraine
 * 
 */

class Controller_Activities_Orders extends Controller_Commonentity 
{
	
	protected $modelName = "Activities";
	protected $indexViewFile = "admin/orders/index";
	protected $orderViewFile = "admin/orders/order";
	protected $orderGViewFile = "admin/orders/gorder";
	protected $orderDViewFile = "admin/orders/dorder";
	protected $keyFieldName = "activity_id";
	protected $operationTypes = array("Витрата", "Дохід");
		
	public function action_index()
	{
		// get information about categories
		$categoriesModel = Model::factory("Categories")->getRecords();
		// Show input data form
		$content = View::factory($this->indexViewFile);
		$content->categories = $categoriesModel;
		$this->template->content = $content;
	}

	/**
	 * @method action_view
	 * Common method for handle view (order) action
	 */	
	public function action_view()
	{
		// check submit button
		$btn_graph = $this->request->post("btn_graph");
		$btn_dynamic = $this->request->post("btn_dynamic");
		if (!is_null($btn_graph))
		{
			$this->graph_view();
			return;
		}
		if (!is_null($btn_dynamic))
		{
			$this->dynamic_view();
			return;
		}
		else
		{
			$this->general_view();
		}	
	}
	
	protected function graph_view()
	{
		// handle form data
		$startDate = $this->request->post("start_date");
		$endDate = $this->request->post("end_date");
		$operationType = $this->request->post("operation_type");
		
		//get information about categories
		$sumOfMoneyByCategories = array();
		$modelCategories = Model::factory("Categories")->getRecords();
		foreach ($modelCategories as $category)
		{
			$sumOfMoney = Model::factory($this->modelName)->getSumOfMoney($operationType, $startDate, $endDate, $category->category_id);
			// check if we have operations on some category
			if (!is_numeric($sumOfMoney)) 
			{
				continue;				
			}
			$sumOfMoneyByCategories[$category->category_name] = $sumOfMoney;
			unset($sumOfMoney);
		}
		unset($modelCategories);
		
		// Reverse Sorting $sumOfMoneyByCategories
		arsort($sumOfMoneyByCategories);
		
		// generate view variables
		$content = View::factory($this->orderGViewFile);
		$content->operationTypes = $this->operationTypes;
		$content->operationType = $operationType;
		$content->sumOfMoney = $sumOfMoneyByCategories;
		$content->startDate = $startDate;
		$content->endDate = $endDate;
		$this->template->content = $content;
	}
	
	protected function dynamic_view()
	{
		// handle form data
		$startDate = $this->request->post("start_date");
		$endDate = $this->request->post("end_date");
		$operationType = $this->request->post("operation_type");
		$category_id = $this->request->post("category_id");
		$category_name = "";
		
		if ($category_id != "null")
		{
			$category_model = Model::factory("Categories")->getRecord($category_id);
			foreach ($category_model as $category)
			{
				$category_name = $category->category_name;
			}
			unset($category_model);		
		}
		else 
		{
			$category_id = null;
		}
		
		$sumOfMoneyByDate = array();
		
		$sumOfMoney = Model::factory($this->modelName)->getSumOfMoneyByDates($operationType, $startDate, $endDate, $category_id);
		foreach ($sumOfMoney as $item)
		{
			$sumOfMoneyByDate[$item->day] = $item->sum;
		}
		unset($sumOfMoney);
		
		// generate view variables
		$content = View::factory($this->orderDViewFile);
		$content->operationTypes = $this->operationTypes;
		$content->operationType = $operationType;
		$content->sumOfMoney = $sumOfMoneyByDate;
		$content->startDate = $startDate;
		$content->endDate = $endDate;
		$content->category_name = (isset($category_name)) ? $category_name : "";
		$this->template->content = $content;
	}
	
	protected function general_view()
	{
		// get information from index form
		$startDate = $this->request->post("start_date");
		$endDate = $this->request->post("end_date");
		$operationType = $this->request->post("operation_type");
		$category_id = $this->request->post("category_id");
		$category_name = "";
		
		// check if category_id is selected
		if ($category_id == "null")
		{
			$category_id = null;
		}
		else 
		{
			$categoryModel = Model::factory("categories")->getRecord($category_id);
			foreach ($categoryModel as $category)
			{
				$category_name = "--> ".$category->category_name;
			}
			unset($categoryModel);
		}
					
		$sumOfMoney = Model::factory($this->modelName)->getSumOfMoney($operationType, $startDate, $endDate, $category_id);
		$content = View::factory($this->orderViewFile);
		$content->operationTypes = $this->operationTypes;
		$content->sumOfMoney = $sumOfMoney;
		$content->startDate = $startDate;
		$content->endDate = $endDate;
		$content->operationType = $operationType;
		$content->categoryName = $category_name;
		$this->template->content = $content;
	}
}