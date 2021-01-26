<?PHP
/***************************************************************************
 *
 *	 PROJECT: iCupid Dating Software
 *	 VERSION: 9
 *	 LISENSE: OWN / LEASED (http://www.advandate.com/license.php)
 *
 *	 This program is a commercial software product and any kind of usage
 *	 means agreement to the eMeeting software License Agreement.
 *
 *	 This notice MUST NOT be removed from the code.   
 *
 *   Copyright 2006-2009 AdvanDate, Ltd.
 *   http://www.advandate.com/
 *
 ***************************************************************************/
class DB
{
    var $handle;
    var $hostname;
    var $username;
    var $password;
    var $persistent;
    var $connected;
    var $database;
    var $prefix;
	var $_errorNum		= 0;
	/** @var string Internal variable to hold the database error message */
	var $_errorMsg		= '';

    function __construct($hostname, $username, $password, $database, $prefix = NULL, $persistent = FALSE, $language ='utf8')
    {
        $this->handle     = 0;
        $this->connected  = FALSE;
        $this->hostname   = $hostname;
        $this->password   = $password;
        $this->username   = $username;
        $this->persistent = $persistent;
        $this->database   = $database;
        $this->prefix     = $prefix;
		$this->language    = $language;
    }



    function Connect()
    {
        if( !$this->connected )
        {
            if( $this->persistent )
            {
                $this->handle = @mysql_pconnect($this->hostname, $this->username, $this->password) or $DIDNT_WORK =true;
            }
            else
            {
                $this->handle = @mysqli_connect($this->hostname, $this->username, $this->password) or $DIDNT_WORK =true;
            }
			
			if( isset($DIDNT_WORK) ){
				return 1;
			}
			
			if($this->language =="install"){
			
				$data = $this->CreateDB($this->database);
				
				return $data;
				
			}else{
			
           		$this->SelectDB($this->database);
			
			}
			

			//if (!mysql_set_character_set($this->handle, "utf8")) 
			//{
				 
					//   mysql_character_set_name($this->handle);
			//}

            $this->connected = TRUE;
        }
    }
    function Connection()
    {
       
        $con = @mysqli_connect($this->hostname, $this->username, $this->password);
       // $con = mysqli_connect($this->hostname, $this->username, $this->password);
        return $con;
    }


    function CreateDB($database)
    {
        $this->database = $database;
		
		$this->Insert("CREATE DATABASE IF NOT EXISTS `$database`");

        if( !mysqli_select_db($this->handle,$this->database) )
        {
            return 2;
        }
    }
	

    function IsConnected()
    {
        return $this->connected;
    }



    function Disconnect()
    {
        if( $this->connected )
        {
            mysqli_close($this->handle);
            $this->handle    = 0;
            $this->connected = FALSE;
        }
    }



    function SelectDB($database)
    {
        $this->database = $database;


        if( !mysqli_select_db($this->handle,$this->database) )
        {
            trigger_error(mysqli_error($this->handle), E_USER_ERROR);
        }
    }



    function Row($query)
    {
        $this->HandlePrefix($query);

		 mysqli_query($this->handle," '".$this->language."'");
		
        $result = @mysqli_query($this->handle,$query);
        if(!$result)

        {
            trigger_error(@mysqli_error($this->handle),E_USER_ERROR);
        }

        $row = @mysqli_fetch_array($result);

        @mysqli_free_result($result);

        return $row;
    }

    function Assoc($query)
    {
        $this->HandlePrefix($query);

        mysqli_query($this->handle,"set names '".$this->language."'");
        
        $result = mysqli_query($this->handle,$query);

        if( !$result )
        {
            trigger_error(mysqli_error($this->handle) . "<br><br><b>Query:</b><br>$query", E_USER_ERROR);
        }

        $row = @mysqli_fetch_assoc($result);

        @mysqli_free_result($result);

        return $row;
    }

    function Count($query)
    {
        $this->HandlePrefix($query);
		
		mysqli_query("set names '".$this->language."'",$this->handle);

        $result = mysqli_query($query, $this->handle);

        if( !$result )
        {
            trigger_error(mysqli_error($this->handle) . "<br><br><b>Query:</b><br>$query", E_USER_ERROR);
        }

        $row = mysqli_fetch_row($result);

        mysqli_free_result($result);

        return $row[0];
    }



    function Query($query)
    {
        $this->HandlePrefix($query);
		
		mysqli_query($this->handle,"set names '".$this->language."'");

        $result = mysqli_query($this->handle, $query);

        if( !$result )
        {
            trigger_error(mysqli_error($this->handle) . "<br><br><b>Query:</b><br>$query", E_USER_ERROR);
        }

        return $result;
    }


    
    function Insert($query)
    {
        $this->HandlePrefix($query);
		 
		mysqli_query($this->handle,"set names '".$this->language."'");

        $result = mysqli_query($this->handle,$query);

        if( !$result )
        {
            trigger_error(mysqli_error($this->handle) . "<br><br><b>Query:</b><br>$query", E_USER_ERROR);
        }
    }



    function Create($query)
    {
        $this->Insert($query);
    }



    function Update($query)
    {
        $this->Insert($query);
    }


    function Free($result)
    {
        mysqli_free_result($result);
        return;
    }


    function Affected()
    {
        $id = mysqli_affected_rows($this->handle);
        return $id;
    }
	
    function InsertID()
    {
        $id = mysqli_insert_id($this->handle);
        return $id;
    }



    function NumRows($result)
    {
        return mysqli_num_rows($result);
    }



    function NextRow($result)
    {
        return @mysqli_fetch_array($result);
    }



    function Seek($result, $where)
    {
        mysqli_data_seek($result, $where);
    }


    
    function RestoreTables($restore_file)
    {
        $statements = file($restore_file);

        foreach( $statements as $statement )
        {
            $this->HandlePrefix($statement);

            $statement = preg_replace("/;$/", "", $statement);

            mysqli_query($statement, $this->handle);
        }
    }

    function GetTables()
    {
        $tables = array();
        $result = $this->Query('SHOW TABLES');

        while( $row = $this->NextRow($result) )
        {
            $tables[$row[0]] = $row[0];
        }

        $this->Free($result);

        return $tables;
    }
	
    function HandlePrefix(&$query)
    {
        if( $this->prefix != NULL )
        {
            $query = str_replace('EM_', $this->prefix, $query);
        }
    }
	
	function CleanMYSQL($value){
	
		return $value;
		
	}
	
	/// EXTRA BITS
	
	function getErrorMsg() {
		return str_replace( array( "\n", "'" ), array( '\n', "\'" ), $this->_errorMsg );
	}
	/**
	 * @return int The error number for the most recent query
	 */
	function getErrorNum() {
		return $this->_errorNum;
	}
}
?>