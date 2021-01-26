<?php
// Lisk Utils
// v 4.0

Class Utils {

	function CheckInputParameters($strParams)
	{
	    $arrParams = explode(",", $strParams);
	    $len = count($arrParams);
	    for($i = 0; $i < $len; $i++)
	    {
	        $param = $arrParams[$i];
	        if(!isset($_GET[$param]) && !isset($_POST[$param]))
	        {
	            die("invalid parameters - ".$arrParams[$i]." is undefined");
	        }
	    }
	}
	
	function GetInputParam($param, $defaultValue = "")
	{
	    $value = $defaultValue;
	
	    if( isset($_POST[$param]) ) $value = $_POST[$param];
	    else if( isset($_GET[$param]) ) $value = $_GET[$param];
	
	    if(get_magic_quotes_gpc()) $value = stripslashes($value);
	
	    return $value;
	}	
	

	/**
	* Select and return domain name (without www)
	*
	* @param string $url
	* @return string
	*/
	function GetDomainName($url) {
		$url = preg_replace('/^http(s|):\/\/(www.|)/','',$url);
		$rez = split('/',$url);
		return $rez[0];
	}

	/**
	* Remove http://, www., domain name from the string
	*
	* @param string $url
	* @return string
	*/
	function RemoveDomainName($url) {
		$url = preg_replace('/^http(s|):\/\/(www.|)/','',$url);
		$rez = split('/',$url);
		return substr($url,strlen($rez[0]));
	}

	/**
	* remove session id from the string
	*
	* @param string $url
	* @return string
	*/
	function RemoveSessionId($url) {
		return preg_replace('/[?&](PHPSESSID|phpsessid)=[wd]+/','',$url);
	}

	/**
	 * Set cookie variable
	 *
	 * @param string $name - variable name
	 * @param string $value - value
	 * @param int $seconds - time you wish cookie to exist (i.e. 60*60*24*365 - 1 year)
	 */
	function SetCookie($name,$value,$seconds=null) {
		if ($seconds>0) {
			setcookie($name,$value,time()+$seconds, '/');
		} else {
			setcookie($name,$value,null,'/');
		}
	}

	/**
	 * Delete cookie variable
	 *
	 * @param string $name - cookie variable name
	 */
	function DeleteCookie($name) {
		setcookie ($name, '', time() - 3600, '/');
		unset($_COOKIE[$name]);
	}

	/**
	 * Ultimate Randomize method
	 *
	 * @param rows $values any Rows array (f.e. DataItem->values)
	 * @param integer $quantity quantiry of records we need to select
	 * @return rows new rows array conteined random selected values
	 */
	function Randomize($values, $quantity) {
		$result=array();
		$resultList=array();

		// fix importance filed
		if (Utils::IsArray($values))
		foreach ($values as $key=>$row) {
			if ($row['importance']==null) {
				$values[$key]['importance'] = 1;
			} else {
				$values[$key]['importance'] = intval($row['importance']);
			}
		}

		// fix quantity > Count
		if (sizeof($values)<$quantity) {
			$quantity=sizeof($values);
		}

		// create full list
		$fullList=array();
		if (Utils::IsArray($values))
		foreach ($values as $key=>$row) {
			$i=1;
			for ($i=1;$i<=$row['importance'];$i++) {
				$fullList[]=$key;
			}
		}

		$upperBound = sizeof($fullList)-1;

		for ($i=0;$i<$quantity;$i++) {
			$isUnique = false;
			$next = 0;
			$_c = 0;

			while (!$isUnique) {
				$_c++;
				if($_c>1000) { //prevent iternal loop
					break;
				}
				$next = rand(0, $upperBound);
				$inArray = in_array($next, $resultList);
				if(!$inArray) {
					$isUnique = true;
				}
			}
			$resultList[]=$next;
		}

		// create result based on result List
		if (Utils::IsArray($resultList)) {
			foreach ($resultList as $key=>$row) {
				$result[]=$values[$fullList[$row]];
			}
		}

		return $result;
	}

/**
	 * Recreate rows for table parsing. Example
	 * input rows arr[0][id] arr[1][id] arr[n][id]
	 * result arr[0][id_0] arr[0][id_1] arr[0][id_2]
	 * @param Rows $arr values
	 * @param int $cols number of values in result rows
	 * @return Rows
	 */
	function RecreateRowsTableFix($arr,$cols) {
		if (Utils::IsArray($arr)) {
			$result=array();
			$count=count($arr);
			$k=0;
			for ($i=0;$i<$count;$i+=$cols) {
				$result[$i]=array();
				$count1=$cols;
				for ($j=0;$j<$count1 && $arr[$k*$cols+$j];$j++) {
					foreach ($arr[$k*$cols+$j] as $key=> $value) {
						$resulte[$i][$key."_$j"]=$value;
					}
				}
				$k++;
			}
		}
		return $result;
	}

	/**
	 * Use this function to get SQL IN condition when you work with cross structures
	 *
	 * @param string $crossName crossList DataItem name (i.e. hot_items)
	 * @param string $cond cond for SQL select (i.e. parent_id=5)
	 * @return string in format (id1,id2,id3) or empty if nothing found
	 */
	function CrossToIn($crossName,$cond=null) {
		GLOBAL $Db;
		$dataItem = new Data($crossName);
		$rows = $dataItem->SelectValues($cond,'object_id');
		if (Utils::IsArray($rows)) {
			$rez = implode(',',$rows);
			return '('.$rez.')';
		}
		return false;
	}

	/**
	 * Returns true if the specified variable is array and it is not empty
	 *
	 * @param mixed $arr
	 * @return boolean
	 */
	function IsArray($arr=null) {
		return (isset($arr) && is_array($arr) && sizeof($arr)>0)?true:false;
	}

	/**
	 * Returns true is specified variable is empty
	 *
	 * @param mixed $str
	 * @return boolean
	 */
	function IsStringEmpty($str) {
		return (strlen($str)==0)?true:false;
	}

	/**
	 * Convert tree-like string format "<3><4><7>" to array
	 *
	 * @param string $parents
	 * @return array
	 */
	function TreeToArray($parents) {
		$parents=str_replace('<','',$parents);
		$rez =split('>',$parents);
		unset($rez[sizeof($rez)-1]);
		return $rez;
	}

	/**
	 * Returns array for using with $Parser->MakeNavigation method
	 *
	 * @param int $id current node/point id
	 * @param string $treeName name of the tree structure
	 * @return array
	 */
	function TreeToNavigation($id,$treeName) {
		GLOBAL $Db,$App;
		if ($id=='') $id=1;

		$tree=$App->ReadTree($treeName);
		$nodeName = $tree['node'];

		$NodeObj = new Data($nodeName,false);

		$parents=$Db->Get("id=$id",'parents',$NodeObj->table);
		$parents=Utils::TreeToIn($parents."<$id>");
		$names=$Db->select("id IN $parents",'id','id,name',$NodeObj->table);
		return $names;
	}

	/**
	 * Format tree style (or prop) string <id1><id2><idn>
	 * for DB query with IN operator and returns it as
	 * "(id1,id2,idN)"
	 *
	 * @param string $parents
	 * @return string
	 */
	function TreeToIn($parents) {
		$str=implode(',',Utils::TreeToArray($parents));
		return '('.$str.')';
	}


	/**
	 * Calculate tree level base on parents string
	 *
	 * @param string $parents
	 * @return int
	 */
	function TreeLevel($parents) {
		$parentsArr = Utils::TreeToArray($parents);
		return sizeof($parentsArr);
	}

	/**
	 * Sort array by parents order
	 *
	 * @param string $parentsString <id1><id2><idn> OR (id1,id2,idN) format
	 * @param array $rows
	 * @return array
	 */
	function OrderByParents($parentsString,$rows) {
		if (Utils::IsArray($rows)) {
			// format string into (id1,id2,idN) format
			if (substr($parentsString,0,1)=='<') $parentsString = Utils::TreeToIn($parentsString);

			//convert paretns string into array
			$arr = split(',',substr($parentsString,1,-1));

			$rez = array();
			foreach ($arr as $v1) {
				foreach ($rows as $k2=>$v2) {
					if ($v2['id']==$v1) {
						$rez[] = $v2;
					}
				}
			}
			return $rez;
		} else {
			return null;
		}
	}

	/**
	 * Converts rows (hash of hashes) to hash of specified variables
	 *
	 * @param array $list
	 * @param string $keyName result hash key variable name
	 * @param string $valueName value variable name
	 * @return array
	 */
	function ListToHash($list, $keyName, $valueName) {
		$hash = array();
		if (Utils::IsArray($list)) {
			foreach($list as $item) {
				$hash[$item[$keyName]] = $item[$valueName];
			}
		}
		return $hash;
	}

	/**
	 * stripes slashes from $value if magic quotes is used
	 *
	 * @param mixed $value
	 * @return mixed
	 */
	function StripSlashes($value) {
		if (get_magic_quotes_gpc()) {
			if (is_array($value)) {
				foreach ($value as $key => $val) {
					if (is_array($val)) {
						$value[$key] = Utils::StripSlashes($val);
					}
					else
						$value[$key] = stripslashes($val);
				}
			} else $value = stripslashes($value);
		}
		return $value;
	}

	/**
	 * get time with microseconds
	 *
	 * @return float
	 */
	function GetMicroTime() {
	    list($usec, $sec) = explode(' ', microtime());
	    return ((float)$usec + (float)$sec);
	}

	/**
	 * Calculate and returns formatted time interval between 2 dates, for example used to calculate user's age
	 *
	 * @param date $date1
	 * @param date $date2
	 * @param string $resultFormat
	 * @return string
	 */
	function DateDifference($date1,$date2,$resultFormat='days') {
		$date1_s = strtotime($date1);
		$date2_s = strtotime($date2);
		$dif = $date1_s-$date2_s;
		$rez_sign=($dif>0)?-1:1;
		$dif=abs($dif);
		switch ($resultFormat) {
			case 'days':
				$result = round($dif/86400);
			break;
		}
		return ($rez_sign*$result);
	}

	function NodeSort($parent, $rows, $cl, $nodeViewField) {
		STATIC $rez;
		if (Utils::IsArray($rows)) {
			foreach($rows as $row) {
				if ($row['parent_id']==$parent) {
					$rez[$row['id']] = str_repeat("&nbsp;",substr_count($row['parents'],">")*2).$row[$nodeViewField];
					Utils::NodeSort($row['id'], $rows, $cl, $nodeViewField);
				}
			}
		}
		return $rez;
	}

	/**
	 * Render tree structure
	 *
	 * @param integer $parent
	 * @param array $tree
	 * @param array $format
	 * @return string
	 */
	function TreeStructureRender($parent, $tree, $format=null) {
		if (!is_array($format)) {
			$format = array(
				'level0'	=> "",
				'level1'	=> "<a href=\"[url]\">[name]</a><br>",
				'level2'	=> "&nbsp;&nbsp;<a href=\"[url]\">[name]</a><br>",
			);
		}

		static $html;

		foreach ($tree as $row) {
			if ($row['parent_id']==$parent) {
				$prop = preg_split('/[<>]/', $row['parents'],null,PREG_SPLIT_NO_EMPTY);
			    $level = (is_array($prop)) ? count($prop) : 0;

			    $html .= Format::String($format['level'.$level], $row);
				Utils::TreeStructureRender($row['id'], $tree, $format);
			}
		}

		return $html;

	}


}

?>