<?php
if (!defined('INCLUDED776')) die ('Fatal error.');
if (!defined('NOFOLLOW')) $nof=' rel="nofollow"'; else $nof='';

if(isset($_GET['days'])) $days=$_GET['days'];
elseif(isset($_POST['days'])) $days=$_POST['days'];
else $days='0000';
if(isset($_GET['lst'])) $lst=$_GET['lst'];
elseif(isset($_POST['lst'])) $lst=$_POST['lst'];
else $lst=0;
if(isset($_GET['top'])) $top=$_GET['top'];
elseif(isset($_POST['top'])) $top=$_POST['top'];
else $top=0;

$days=substr($days,0,4)+0;
if($days<=0) $days=$defDays;

if(!isset($clForumsUsers)) $clForumsUsers=array();
$closedForums=getAccess($clForums, $clForumsUsers, $user_id);
$extra=($closedForums!='n'?1:0);

if (isset($topStats) and in_array($topStats,array(1,2,3,4))) $tKey=$topStats; else $tKey=4;

$stats_barWidth='';$statsOpt='';$list_stats_viewed='';$list_stats_popular='';$list_stats_aUsers='';

if($enableViews) $lstLim=2;
else $lstLim=1;

$lst+=0;$top+=0;$key2='';
if($top+1>$tKey) $top=$tKey-1;
if($lst>$lstLim) $lst=$lstLim;
function fTopa($top){
if($top==0) $topa=5;
elseif($top==1) $topa=10;
elseif($top==2) $topa=20;
else $topa=40;
return $topa;
}

$statsTop=' . ';
for($i=0;$i<$tKey;$i++) $statsTop.=($i<>$top?'<a href="'.$indexphp.'action=stats&amp;top='.$i.'&amp;days='.$days.'&amp;lst='.$lst.'"'.$nof.'>'.$l_stats_top.' '.fTopa($i).'</a> . ':$l_stats_top.' '.fTopa($i).' . ');
$makeLim=fTopa($top);

$statsOptL=array($l_stats_popular,$l_stats_aUsers,$l_stats_viewed);

for($i=0;$i<=$lstLim;$i++){
if($i!=$lst and $statsOptL[$i]!='') $statsOpt.=' / <b><a href="'.$indexphp.'action=stats&amp;top='.$top.'&amp;days='.$days.'&amp;lst='.$i.'"'.$nof.'>'.$statsOptL[$i].'</a></b>';
elseif($statsOptL[$i]!='') $statsOpt.= ' / <b>'. $statsOptL[$i].'</b>';
}

$tpl=makeUp('stats_bar');

if($lst==0){
$xtr=getByDay('WHERE',$Tt,'topic_time').' ';
$xtr.=($extra==1?getClForums($closedForums,'AND',$Tt,'forum_id','AND','!='):'');
}
elseif($enableViews&&$lst==2){
$xtr=getByDay('AND',$Tt,'topic_time').' ';
$xtr.=($extra==1?getClForums($closedForums,'AND',$Tt,'forum_id','AND','!='):'');
}

if($lst==0&&$cols=db_simpleSelect(0,$Tt,'topic_id, topic_title, forum_id, posts_count','','','','posts_count DESC',$makeLim)){
do{

if(isset($preModerationType) and $preModerationType>0 and isset($premodTopics) and in_array($cols[0], $premodTopics)) $cols[1]=$l_topicQueued;

$val=$cols[3]-1;
if(!isset($vMax)) $vMax=$val;
if ($vMax!=0) $stats_barWidth=round(100*($val/$vMax));
if($stats_barWidth>$stats_barWidthLim) $key='<a href="'.$indexphp.'action=vthread&amp;forum='.$cols[2].'&amp;topic='.$cols[0].'"'.$nof.'>'.$cols[1].'</a>';
else{
$key2='<a href="'.$indexphp.'action=vthread&amp;forum='.$cols[2].'&amp;topic='.$cols[0].'"'.$nof.'>'.$cols[1].'</a>';
$key='<a href="'.$indexphp.'action=vthread&amp;forum='.$cols[2].'&amp;topic='.$cols[0].'"'.$nof.'>...</a>';
}
$list_stats_popular.=ParseTpl($tpl);
}
while($cols=db_simpleSelect(1));
}

elseif($lst==1 && $cols=db_simpleSelect(0,$Tu,'user_id,username,num_posts',$dbUserId,'>',1,'num_posts DESC',$makeLim)){
do{
$val=$cols[2];
if(!isset($vMax)) $vMax=$val;
if ($vMax!=0) $stats_barWidth=round(100*($val/$vMax));
if($stats_barWidth>$stats_barWidthLim) $key='<a href="'.$indexphp.'action=userinfo&amp;user='.$cols[0].'"'.$nof.'>'.$cols[1].'</a>';
else{
$key2='<a href="'.$indexphp.'action=userinfo&amp;user='.$cols[0].'"'.$nof.'>'.$cols[1].'</a>';
$key='<a href="'.$indexphp.'action=userinfo&amp;user='.$cols[0].'"'.$nof.'>...</a>';
}
$list_stats_aUsers.=ParseTpl($tpl);
}
while($cols=db_simpleSelect(1));
}

elseif($enableViews&&$lst==2&&$cols=db_simpleSelect(0,$Tt,'topic_id, topic_views, topic_title, forum_id','','','','topic_views DESC, topic_id DESC',$makeLim,'topic_views','>',0,false)){
do{
if($cols[1]){

if(isset($preModerationType) and $preModerationType>0 and isset($premodTopics) and in_array($cols[0], $premodTopics)) $cols[2]=$l_topicQueued;

if(!isset($vMax)) $vMax=$cols[1];
$val=$cols[1];
$stats_barWidth=round(100*($val/$vMax));
if($stats_barWidth>$stats_barWidthLim) $key='<a href="'.$indexphp.'action=vthread&amp;forum='.$cols[3].'&amp;topic='.$cols[0].'"'.$nof.'>'.$cols[2].'</a>';
else{
$key2='<a href="'.$indexphp.'action=vthread&amp;forum='.$cols[3].'&amp;topic='.$cols[0].'"'.$nof.'>'.$cols[2].'</a>';
$key='<a href="'.$indexphp.'action=vthread&amp;forum='.$cols[3].'&amp;topic='.$cols[0].'"'.$nof.'>...</a>';
}
$list_stats_viewed.=ParseTpl($tpl);
}
else break;
}
while($cols=db_simpleSelect(1));
}

unset($xtr);

$numUsers=db_simpleSelect(2,$Tu,'count(*)');
$numTopics=db_simpleSelect(2,$Tf,'SUM(topics_count)');
$numPosts=db_simpleSelect(2,$Tf,'SUM(posts_count)')-$numTopics;
$adminInf=db_simpleSelect(2,$Tu,$dbUserSheme['username'][1],$dbUserId,'=',1);
$lastRegUsr=db_simpleSelect(0,$Tu,"{$dbUserId}, {$dbUserSheme['username'][1]}",$dbUserId,'>',1,"{$dbUserId} DESC",1);

$title=$title.$l_stats;

echo load_header($layout[1]["contents"]); echo ParseTpl(makeUp('stats'));
?>