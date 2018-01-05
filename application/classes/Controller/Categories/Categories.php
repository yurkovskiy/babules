<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Categories_Categories extends Controller_Commonentity 
{

	protected $modelName = "Categories";
	protected $indexViewFile = "admin/categories/index";
	protected $addFormViewFile = "admin/categories/aeform";
	protected $editFormViewFile = "admin/categories/aeform";
	protected $redirectURL = "categories/categories";
	protected $keyFieldName = "category_id";
	
}