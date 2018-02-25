<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions activities table model
 *
 */

class Model_Activities extends Model_Common 
{
	
	protected $tableName = "activities";
	protected $fieldNames = array("activity_id", "category_id", "operation_type", "activity_sum", "activity_desc", "activity_date", "activity_tags");
	
	/**
	 * 
	 * @param int $operationType
	 * @param string $startDate
	 * @param string $endDate
	 * @param int $category_id - category filter
	 * @return decimal - sum of money for period
	 */
	public function getSumOfMoney($operationType, $startDate, $endDate, $category_id = null)
	{
		$category_query = "";
		if (!is_null($category_id))
		{
			$category_query = "AND {$this->fieldNames[1]} = {$category_id} ";
		}
		$query = "SELECT SUM({$this->fieldNames[3]}) AS sum 
				  FROM {$this->tableName} 
				  WHERE {$this->fieldNames[2]} = {$operationType} {$category_query} 
				  AND {$this->fieldNames[5]} BETWEEN '{$startDate}' AND '{$endDate}'";
		$sum = DB::query(Database::SELECT, $query)->execute()->get('sum');
		return $sum;
	}

	/**
	 *
	 * @param int $operationType
	 * @param string $startDate
	 * @param string $endDate
	 * @param int $category_id - category filter
	 * @return object - MySQL Object
	 */
	public function getSumOfMoneyByDates($operationType, $startDate, $endDate, $category_id = null)
	{
		$category_query = "";
		if (!is_null($category_id))
		{
			$category_query = "AND {$this->fieldNames[1]} = {$category_id} ";
		}
		$query = "SELECT DATE_FORMAT({$this->fieldNames[5]}, '%d/%m/%Y') as day, SUM({$this->fieldNames[3]}) AS sum
		FROM {$this->tableName}
		WHERE {$this->fieldNames[2]} = {$operationType} {$category_query}
		AND {$this->fieldNames[5]} BETWEEN '{$startDate}' AND '{$endDate}'
		GROUP BY day";
		$result = DB::query(Database::SELECT, $query)->as_object()->execute();
		return $result;
	}
	
	/**
	 * 
	 * @param int $operationType
	 * @param date(string) $startDate
	 * @param date(string) $endDate
	 * @return object - MySQL Object
	 */
	public function getSumOfMoneyByMonthAndYear($operationType, $startDate, $endDate, $category_id = null)
	{
		$category_query = "";
		if (!is_null($category_id))
		{
			$category_query = "AND {$this->fieldNames[1]} = {$category_id} ";
		}
		$query = "SELECT DATE_FORMAT({$this->fieldNames[5]}, '%Y-%m') as my, SUM({$this->fieldNames[3]}) AS sum
		FROM {$this->tableName}
		WHERE {$this->fieldNames[2]} = {$operationType} {$category_query}
		AND YEAR({$this->fieldNames[5]}) BETWEEN YEAR('{$startDate}') AND YEAR('{$endDate}')
		GROUP BY my";
		
		$result = DB::query(Database::SELECT, $query)->as_object()->execute();
		return $result;
	}
	
	/**
	 * 
	 * @param int $category_id - unique id (number) of category
	 * @return int - number of returned records
	 */
	public function countRecordsByCategory($category_id)
	{
		$query = "SELECT COUNT(*) AS count FROM {$this->tableName} WHERE {$this->fieldNames[1]} = {$category_id}";
		$count = DB::query(Database::SELECT, $query)->execute()->get('count');
		return $count;
	}
	
	/**
	 * 
	 * @param int $limit
	 * @param int $offset
	 * @param int $category_id
	 * @return MySQL Result Object
	 */
	public function getRecordsRangeByCategory($limit, $offset, $category_id)
	{
		$query = DB::select_array($this->fieldNames)->from($this->tableName)->where($this->fieldNames[1], "=", $category_id)->order_by($this->fieldNames[0], 'asc')->limit($limit)->offset($offset);
		$result = $query->as_object()->execute();
		return $result;
	}
}