<?

class XML
{

	var $error			= false;
	var $errorType		= '';
	var $errorMessage	= '';

	var $nodes			= array();


	function XML()
	{
		$this->nodes = Array();
	}

	function Error($type='',$msg='')
	{
		$this->error		= true;
		$this->errorType	= strtoupper($type);
		$this->errorMessage	= $msg;
	}

	function Send()
	{
		header('Content-type: text/xml');
		echo $this->Render();
	}

	function AddNode($nodeName,$data)
	{
		$this->nodes[]=array(
			'name'	=> $nodeName,
			'data'	=> $data
		);
	}

	function Render()
	{
		$msg = "";
		
		if ($this->error)
		{
			$msg.="<error type=\"{$this->errorType}\" msg=\"{$this->errorMessage}\" />";
			return $msg;
		}

		if (Utils::IsArray($this->nodes))
		foreach ($this->nodes as $node)
		{
			$msg.=$this->RenderNode($node['name'],$node['data']);

		}

		return $msg;

	}

	function RenderNode($name,$data)
	{
		$name = $this->GetValidName($name);
		$txt = "<".$name.">";

		if(Utils::IsArray($data))
		{
			foreach($data as $key=>$row)
			{
				if (Utils::IsArray($row))
				{
					$value = $this->RenderNode($key,$row);
					$txt.= $value;
				}
				else
				{
					$value = $row;
					$key = $this->GetValidName($key);
					$txt.= "<$key><![CDATA[".$value."]]></$key>";
				}
			}
		}
		$txt.= "</$name>";
		return $txt;
	}

	function GetValidName($name)
	{
		$name =  preg_replace("/^[0-9]/", "_", $name);
		$name =  preg_replace("/[^a-zA-Z0-9_]/", "_", $name);
		return $name;
	}

}

?>