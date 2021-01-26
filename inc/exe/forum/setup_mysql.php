<?php


$varr = @mysqli_connect($DBhost, $DBusr, $DBpwd) or die ('<b>Database/configuration error.</b>');
@mysqli_select_db($varr,$DBname) or die ('<b>Database/configuration error (DB is missing).</b>');

function makeLim($page,$numRows,$viewMax){
$page=pageChk($page,$numRows,$viewMax);
if(intval($numRows/$viewMax)!=0&&$numRows>0){
if ($page>0) return ($page*$viewMax).','.$viewMax;
else return $viewMax;
}
else return '';
}

function getByDay($prefix,$table,$field){
if($table!='') $table.='.';
if($prefix!='') $prefix=' '.$prefix;
$xtr2=$prefix.' TO_DAYS(now())-TO_DAYS('.$table.$field.')<'.$GLOBALS['days'];
return $xtr2;
}

function getClForums($closedForums,$more,$prefix,$field,$syntax,$condition){
$xtr=$more.' (';
if($prefix!='') $prefix=$prefix.'.';
$siz=sizeof($closedForums);
foreach($closedForums as $c) {
$xtr.=' '.$prefix.$field.$condition.$c;
$siz--;
if ($siz!=0) $xtr.=' '.$syntax;
}
return $xtr.') ';
}

function db_simpleSelect($sus,$table='',$fields='',$uniF='',$uniC='',$uniV='',$orderby='',$limit='',$uniF2='',$uniC2='',$uniV2='',$and2=true,$groupBy=''){
if(!$sus){
$where='';
if($uniF!='') $where=' WHERE '.$uniF.$uniC."'".$uniV."'";
if($uniF2!='') {
$q=(substr_count($uniV2,'.')>0?'':"'");
$a=($and2?'AND':'WHERE');
$where.=' '.$a.' '.$uniF2.$uniC2.$q.$uniV2.$q;
}
if($limit!='') $limit='limit '.$limit;
if($orderby!='') $orderby='order by '.$orderby;
if($groupBy!='') $groupBy='group by '.$groupBy;
$xtr=(!isset($GLOBALS['xtr'])?'':$GLOBALS['xtr']);

$sql='SELECT '.$fields.' FROM '.$table.$where.' '.$xtr.' '.$groupBy.' '.$orderby.' '.$limit;
//if($sus==0 and function_exists('parseSql')) $sql=parseSql($sql);
//echo "!-- ".$sql." --><br>";
$result=mysqli_query($GLOBALS['varr'],$sql);
if($result) {
$GLOBALS['countRes']=mysqli_num_rows($result);
$GLOBALS['result']=$result;
}
}
if(($sus==1||isset($result))&&isset($GLOBALS['countRes'])&&$GLOBALS['countRes']>0)  return mysqli_fetch_row($GLOBALS['result']);
elseif($sus==2){
$a=(strlen($uniF2)?'AND':'');
$w=(strlen($uniF)||strlen($uniF2)?'WHERE':'');
$xtr=(isset($GLOBALS['xtr'])?$GLOBALS['xtr']:'');
return mysql_result(mysql_query('SELECT '.$fields.' FROM '.$table.' '.$w.' '.$uniF.$uniC.$uniV.' '.$a.' '.$uniF2.$uniC2.$uniV2.' '.$xtr),0);
}
else return FALSE;
}

function insertArray($insertArray,$tabh){
$into=''; $values='';
foreach($insertArray as $ia) {
$iia=$GLOBALS[$ia];
$into.=$ia.',';
$values.=($iia=='now()'?$iia.',':"'".$iia."',");
}
//		 $order   = array("\r\n", "\n", "\r","\r\n\r");
//		 $replace = '<br>';
//		 $values = str_replace($order, $replace,$values);
//die('insert into '.$tabh.' ('.$into.') values ('.$values.')');
$into=substr($into,0,strlen($into)-1);
$values=substr($values,0,strlen($values)-1);

$res=mysqli_query($GLOBALS['varr'],'insert into '.$tabh.' ('.$into.') values ('.$values.')') or die('<p>'.mysqli_error($GLOBALS['varr']).'. Please, try another name or value.');
$GLOBALS['insres']=mysqli_insert_id($GLOBALS['varr']);
return mysqli_errno($GLOBALS['varr']);
}

function updateArray($updateArray,$tabh,$uniq,$uniqVal){
$into='';
foreach($updateArray as $ia) {
$iia=$GLOBALS[$ia];
$into.=($iia=='now()'?$ia.'='.$iia.',':$ia."='".$iia."',");
}
$into=substr($into,0,strlen($into)-1);
$unupdate=($uniq!=''?' where '.$uniq.'='."'".$uniqVal."'":'');
$res=mysqli_query($GLOBALS['varr'],'update '.$tabh.' set '.$into.' '.$unupdate) or die('<p>'.mysqli_error().'. Please, try another name or value.');
return mysqli_affected_rows($GLOBALS['varr']);
}

function db_delete($table,$uniF='',$uniC='',$uniV='',$uniF2='',$uniC2='',$uniV2=''){
$where=($uniF!=''?'where '.$uniF.$uniC.$uniV:'');
if($uniF2!='') {
$where.=' AND '.$uniF2.$uniC2.$uniV2;
}
$sql='DELETE FROM '.$table.' '.$where;
$result=mysqli_query($GLOBALS['varr'],$sql);
if($result) return mysqli_affected_rows($GLOBALS['varr']);
else return FALSE;
}

function db_ipCheck($thisIp,$thisIpMask,$user_id){
$res=mysqli_query($GLOBALS['varr'],'select id from '.$GLOBALS['Tb'].' where 
banip='."'".$thisIp."'".' or banip='."'".$thisIpMask[0]."'".' or
banip='."'".$thisIpMask[1]."'".' or banip='."'".$user_id."'");
if($res and mysqli_num_rows($res)>0) return TRUE; else return FALSE;
}

function db_inactiveUsers($sus,$what=''){
/*Admin - users that didnt any post */
if(!$sus) {
if($GLOBALS['makeLim']>0) $GLOBALS['makeLim']='LIMIT '.$GLOBALS['makeLim'];
$result=mysqli_query($GLOBALS['varr'],'select '.$what.' from '.$GLOBALS['Tu'].' LEFT JOIN '.$GLOBALS['Tp'].' ON '.$GLOBALS['Tu'].'.'.$GLOBALS['dbUserId'].'='.$GLOBALS['Tp'].'.poster_id where '.$GLOBALS['Tp'].'.poster_id IS NULL order by '.$GLOBALS['Tu'].'.'.$GLOBALS['dbUserId'].' '.$GLOBALS['makeLim']);
if($result) {
$GLOBALS['countRes']=mysqli_num_rows($result);
$GLOBALS['result']=$result;
}
}
if(isset($GLOBALS['countRes']) and $GLOBALS['countRes']>0) return mysqli_fetch_row($GLOBALS['result']);
else return FALSE;
}

function db_deadUsers($sus,$less){
/*Admin-dead users*/
if(!$sus){
$GLOBALS['makeLim']=(isset($GLOBALS['makeLim'])&&$GLOBALS['makeLim']>0?'LIMIT '.$GLOBALS['makeLim']:'');
$result=mysqli_query($GLOBALS['varr'],'select '.$GLOBALS['Tu'].'.'.$GLOBALS['dbUserId'].','.$GLOBALS['Tu'].'.'.$GLOBALS['dbUserSheme']['username'][1].','.$GLOBALS['Tu'].'.'.$GLOBALS['dbUserDate'].','.$GLOBALS['Tu'].'.'.$GLOBALS['dbUserSheme']['user_password'][1].','.$GLOBALS['Tu'].'.'.$GLOBALS['dbUserSheme']['user_email'][1].',max('.$GLOBALS['Tp'].'.post_time) as m from '.$GLOBALS['Tu'].','.$GLOBALS['Tp'].' where '.$GLOBALS['Tu'].'.'.$GLOBALS['dbUserId'].'='.$GLOBALS['Tp'].'.poster_id group by '.$GLOBALS['Tp'].'.poster_id having m<'."'".$less."' ".$GLOBALS['makeLim']);
if($result){
$GLOBALS['countRes']=mysqli_num_rows($result);
$GLOBALS['result']=$result;
}
}
if(isset($GLOBALS['countRes']) and $GLOBALS['countRes']>0) return mysql_fetch_row($GLOBALS['result']);
else return FALSE;
}

function db_calcAmount($tbName,$tbKey,$tbVal,$setName,$setField,$tbKey2=''){
/* Function to get amount of values from table $tbName by criteria $tbKey=$tbVal; then update table's $setName field $setField by this amount */
$amount=0;

$amount=mysqli_fetch_assoc(mysqli_query($GLOBALS['varr'],'select count(*) AS total from '.$tbName.' where '.$tbKey.'='.$tbVal));
if($tbKey2=='') $tbKey2 = $tbKey;
mysqli_query($GLOBALS['varr'],'update '.$setName.' set '.$setField.'='."'".$amount['total']."'".' where '.$tbKey2.'='.$tbVal);
return $amount['total'];
}

function db_searchSelect($sus, $table='', $fields='', $sqlstr='', $makeLim='', $orderBy=''){
if(!$sus){
$sql='SELECT '.$fields.' FROM '.$table.' WHERE '.$sqlstr.' ';
if($orderBy!='') $sql.="ORDER BY $orderBy ";
if($makeLim!='') $sql.='LIMIT '.$makeLim;
//echo "!-- ".$sql." --><br>";
$result=mysqli_query($GLOBALS['varr'],$sql);
if($result) {
$GLOBALS['countRes']=mysqli_num_rows($result);
$GLOBALS['result']=$result;
}
}
if( ($sus==1 OR isset($result) ) AND isset($GLOBALS['countRes']) AND $GLOBALS['countRes']>0) return mysqli_fetch_row($GLOBALS['result']);
else return FALSE;
}

function db_genPhrase($phrase,$where,$searchType){
if($where==0) $field='post_text';
elseif($where==1) $field='topic_title';

if(substr($phrase,0,1)=='~' and substr($phrase,strlen($phrase)-1,1)=='~') {
$phs=substr($phrase,1,strlen($phrase)-2);
$sql=" $field like '%{$phs}%' ";
$GLOBALS['phrase']=$phs;
}

else{
$sql=' (';

if($searchType==0){
$words=explode(' ',$phrase);

$gen='';
foreach($words as $w) {
$w=trim($w);
if($w!='' and strlen($w)>2) $gen.="{$w}% ";
}
$gen=trim($gen);
$sql=" ($field like '% {$gen}' or $field like '%<br>{$gen}' or $field like '{$gen}' or $field like '%;{$gen}' or $field like '".substr($gen,0,strlen($gen)-1).".') ";
}
else $sql=" ($field like '% {$phrase} %' or $field like '{$phrase} %' or $field like '%&quot;{$phrase} %' or $field like '% {$phrase}.' or $field like '{$phrase}.') ";
}

return $sql;
}

?>