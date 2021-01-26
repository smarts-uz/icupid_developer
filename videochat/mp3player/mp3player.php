<?
require_once('settings.php');
require_once MP3PLAYER_ROOT.'core/core.php';
require_once MP3PLAYER_ROOT.'core/db.class.php';
require_once MP3PLAYER_ROOT.'core/xml.class.php';
require_once MP3PLAYER_ROOT.'core/utils.class.php';

define('MP3PLAYER_PLAYLIST_TABLE', DB_PREFIX.'mp3player_playlists');
define('MP3PLAYER_SONGS_TABLE',    DB_PREFIX.'mp3player_songs');

class Mp3Player
{
	var $action;
	var $userID;

	function Mp3Player()
	{
		$this->InitRequestParams();
		switch ($this->action)
		{
			case 'all_songs':		$this->GetAllSongs();	break;
			case 'playlist':		$this->Playlist();		break;
			case 'save_playlist':	$this->SavePlaylist();	break;
			case 'all_genres_list':	$this->AllGenresList();	break;
			case 'genres_list':		$this->GenresList();	break;
			case 'upload':			$this->UploadNewMp3();	break;
			case 'get_last_song':	$this->GetLastSong();	break;
			case 'delete_song':		$this->DeleteSong();	break;
			default:
				$Xml = new XML();
				$Xml->Error("Action undefined");
				$Xml->Send();
				break;
		}
	}

	function InitRequestParams()
	{
		$this->action = urldecode($_REQUEST['action']);
		$this->userID = '';
		if(isset($_REQUEST['userID'])) $this->userID = urldecode($_REQUEST['userID']);
	}

	function GetAllSongs() 
	{
		Db::Connect();

		$condition = '1';

		$fromDate = getInputParam('fromDate');
		if($fromDate)
		{
			$condition .= ' AND `date` > "'.Db::PrepareStr($fromDate).'"';
		}
		$toDate = getInputParam('toDate');
		if($toDate)
		{
			$condition .= ' AND `date` < "'.Db::PrepareStr($toDate).' 23:59:59"';
		}

		$rows = Db::Select(MP3PLAYER_SONGS_TABLE, $condition);

		$Xml = new XML();
		$Xml->AddNode("songs",$rows);
		$Xml->Send();
	}

	function Playlist()
	{
		Db::Connect();

		$row = Db::Get(MP3PLAYER_PLAYLIST_TABLE, "userID='".$this->userID."'");
		if(!Utils::IsArray($row))
		{
			Db::Insert(MP3PLAYER_PLAYLIST_TABLE,
				array('userID'	=> $this->userID));
		}
		$arr = split(',',$row['playlist']);
		$Xml = new XML();
		$Xml->AddNode("playlist",$arr);
		$Xml->Send();
	}

	function SavePlaylist()
	{
		Db::Connect();

		$rows = Db::Update(MP3PLAYER_PLAYLIST_TABLE,
			array('playlist' => $_REQUEST['playlist']),
			"userID='".$this->userID."'");

		echo '<ok />';
	}

	function AllGenresList()
	{
		$rows = $GLOBALS['allGenresList'];

		$Xml = new XML();
		$Xml->AddNode("allGenres",$rows);
		$Xml->Send();
	}

	function GetLastSong()
	{
		Db::Connect();

		$sql = "SELECT * FROM `".MP3PLAYER_SONGS_TABLE."`
		WHERE userID='".$this->userID."' ORDER BY id DESC LIMIT 1";
		$result = Db::Query($sql);
        $rows = array();
        while($row = mysql_fetch_assoc($result)) $rows[] = $row;

		$Xml = new XML();
		$Xml->AddNode("songs",$rows);
		$Xml->Send();
	}

	function GenresList()
	{
		Db::Connect();

		$result = Db::Query("SELECT DISTINCT genre FROM ".MP3PLAYER_SONGS_TABLE);
        $rows = array();
        while($row = mysql_fetch_assoc($result)) $rows[] = $row;

		$Xml = new XML();
		$Xml->AddNode("genres",$rows);
		$Xml->Send();
	}

	function UploadNewMp3()
	{
	    if(!isset($_FILES['Filedata'])) $this->FileUploadError();

		$newName = uniqid('mp3').'_'.date('m_d').'.mp3';
		$nameToSave = FILES_DIR.'mp3/'.$newName;

	    if(file_exists($nameToSave))
		{
			trace('FILE_EXISTS');
	    	$Xml = new XML();
			$Xml->Error("FILE_EXISTS");
			$Xml->Send();
	    }

	    if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $nameToSave))
		{
			chmod($nameToSave, 0755);
			Db::Connect();
			Db::Insert(MP3PLAYER_SONGS_TABLE, array(
	    		'artist'	=> $_GET['artist'],
	    		'title'		=> $_GET['title'],
	    		'userName'		=> $_GET['userName'],
	    		'userID'		=> $this->userID,
	    		'path'		=> $newName,
	    		'date'		=> 'NOW()'
	    		));

	    	$Xml = new XML();
			$Xml->Error("UPLOAD_SUCCESS");
			$Xml->Send();
	    }
		else
		{
			trace('CANT_SAVE_FILE');
	    	$Xml = new XML();
			$Xml->Error("CANT_SAVE_FILE");
			$Xml->Send();
	    }
	}

	function FileUploadError()
	{
		trace('FileUploadError');
		header("HTTP/1.0 415 Unsupported Media Type");
		exit;
	}

	function DeleteSong()
	{
		$id = (int)getInputParam('id');

		Db::Connect();
		$song = Db::Get(MP3PLAYER_SONGS_TABLE, 'id='.$id);

		if($song)
		{
			$nameToDelete = FILES_DIR.'mp3/'.$song['path'];
			@unlink($nameToDelete);

			Db::Delete(MP3PLAYER_SONGS_TABLE, 'id='.$id);

			$playlists = Db::Select(MP3PLAYER_PLAYLIST_TABLE);
			$num = count($playlists);
			for($i = 0; $i < $num; $i++)
			{
				$list = $playlists[$i]['playlist'];
				if($list)
				{
					$arr = split('[,]', $list);
					$key = array_search($id, $arr);
					unset($arr[$key]);
					$str = '';
					foreach($arr as $value)
						$str .= $value.',';
					$str = substr($str, 0 , -1);
					Db::Update(MP3PLAYER_PLAYLIST_TABLE,
						array('playlist' => $str), 'id='.$playlists[$i]['id']);
				}
			}

	    	$Xml = new XML();
			$Xml->Error("SONG_DELETED");
			$Xml->Send();
		}
		else
		{
	    	$Xml = new XML();
			$Xml->Error("SONG_NOT_FOUND");
			$Xml->Send();
	    }
	}
}

$GLOBALS['allGenresList'] = array(
	19	=> 'Other',
	18	=> 'Soul',
	17	=> 'Rock',
	16	=> 'Rap',
	15	=> 'Punk',
	14	=> 'Pop',
	13	=> 'New Age',
	12	=> 'Metal',
	11	=> 'Jazz',
	10	=> 'Indie',
	9	=> 'Hip Hop',
	8	=> 'Hard Rock',
	7	=> 'Funk',
	6	=> 'Ethnic',
	5	=> 'Disco',
	4	=> 'Country',
	3	=> 'Classic',
	2	=> 'Blues',
	1	=> 'Alternative',
);

$mp3 = new Mp3Player();

?>
