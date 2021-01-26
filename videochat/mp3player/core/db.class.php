<?php
class Db
{
    function Connect()
    {
        if(!mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))
        {
            trace("Db::Connect - can`t connect to db");
            return false;
        }
        if(!mysql_select_db(DB_NAME))
        {
            trace("Db::Connect - can`t select db");
            return false;
        }
        return true;
    }

    function Select($table, $cond = '1')
    {
        $result = Db::Query("SELECT * FROM `".$table."` WHERE ".$cond);
        $rows = array();
        while($row = mysql_fetch_assoc($result)) $rows[] = $row;
        return $rows;
    }

    function SelectEx($query)
    {
        $result = Db::Query($query);
        $rows = array();
        while($row = mysql_fetch_assoc($result)) $rows[] = $row;
        return $rows;
    }

    function Get($table, $cond = '1')
    {
        $result = Db::Query("SELECT * FROM `".$table."` WHERE ".$cond." LIMIT 1");
        $row = mysql_fetch_assoc($result);
        return $row;
    }

    function Insert($table, $values, $safeMode = true)
    {
        $params = Db::MakeParams($values, $safeMode);
        Db::Query("LOCK TABLES `".$table."` WRITE");
        Db::Query("INSERT INTO `".$table."` SET ".implode(", ", $params));
        $result = mysql_insert_id();
        Db::Query("UNLOCK TABLES");
        return $result;
    }

    function Replace($table, $values, $safeMode = true)
    {
        $params = Db::MakeParams($values, $safeMode);
        Db::Query("LOCK TABLES `".$table."` WRITE");
        Db::Query("REPLACE INTO `".$table."` SET ".implode(", ", $params));
        $result = mysql_insert_id();
        Db::Query("UNLOCK TABLES");
        return $result;
    }

    function Update($table, $values, $cond = '1', $safeMode = true)
    {
        $params = Db::MakeParams($values, $safeMode);
        Db::Query("LOCK TABLES `$table` WRITE");
        Db::Query("UPDATE `".$table."` SET ".implode(", ", $params)." WHERE ".$cond);
        $result = mysql_affected_rows();
        Db::Query("UNLOCK TABLES");
        return $result;
    }

    function Delete($table, $cond = '1')
    {
        Db::Query("LOCK TABLES `$table` WRITE");
        Db::Query("DELETE FROM `".$table."` WHERE $cond");
        $result = mysql_affected_rows();
        Db::Query("UNLOCK TABLES");
        return $result;
    }

    function Query($query)
    {
        $result = mysql_query($query);
        if($err = mysql_error())
        {
            trace("*MySQL ERROR* ".$err);
            trace($query);
        }
        return $result;
    }

	function MakeParams($values, $safeMode = true)
	{
        $params = array();
        if($safeMode)
			foreach($values as $field => $value) 
			{
				if($value != 'NOW()') 
					$value = "'" . Db::PrepareStr($value) . "'";
				$params[] = "`" . $field . "`=" . $value;
			}
        else
			foreach($values as $field => $value) 
				$params[] = $field."=".$value;
		return $params;
	}


    function PrepareStr($str)
    {
        return mysql_escape_string($str);
    }
}

?>
