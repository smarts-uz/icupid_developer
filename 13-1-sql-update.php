<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



include"inc/config.php";

$DB->Update("delete from field where fName='country'");
$DB->Update("delete from field where fName='em_85820081128'");
$DB->Update("delete from field where fName='postcode'");

/*
/* inserting new field miles from*/
$DB->Insert("INSERT INTO `field` (`fid`, `fName`, `fType`, `fOrder`, `fGender`, `groupid`, `required`, `browsepage`, `matchpage`, `linked_id`, `groupid_1`, `groupid_2`) VALUES
(62, 'milesfrom', 1, 1, 2, 2, 0, 'no', 'no', 0, 0, 0)");

$lastInsertId= $DB->InsertID();
$DB->Insert("INSERT INTO `field_caption` (`id`, `Cid`, `lang`, `caption`, `description`, `match`) "
. "VALUES (683, ".$lastInsertId.", 'english', 'Location', '', 'no')");

$DB->Update("update field set quickbrowsepage ='yes' where fName='milesfrom' or fName='location' "); 
