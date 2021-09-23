<?php
if(!isset($_SESSION)){session_start();} 
include("../inc/conn.php");
include("../inc/top2.php");
include("../inc/bottom.php");
include("../label.php");
if (isset($_REQUEST["action"])=="add"){
checkyzm($_POST["yzm"]);
session_write_close();
$sitename = isset($_POST['sitename'])?$_POST['sitename']:"";
$url = isset($_POST['url'])?addhttp($_POST['url']):"";
$logo = isset($_POST['logo'])?addhttp($_POST['logo']):"";
$content = isset($_POST['content'])?$_POST['content']:"";

if ($sitename==''||$url==''||$logo==''||$content==''){
	showmsg('璇峰畬鏁村～鍐欐偍鐨勪俊鎭�');
}

query("insert into zzcms_link (sitename,url,logo,content,sendtime)values('$sitename','$url','$logo','$content','".date('Y-m-d H:i:s')."')");
showmsg('鎿嶄綔鎴愬姛锛佹彁绀猴細鎻愪氦鐢宠鍚庯紝璇峰仛濂芥湰绔欓摼鎺モ€斺€斿鏋滄病鏈夊鍔犳湰绔欑殑閾炬帴锛岄偅涔堜綘鐨勭敵璇锋槸涓嶄細琚€氳繃鐨勩€�','link.php') ;
}

$fp="../template/".$siteskin."/link.htm";
if (file_exists($fp)==false){
WriteErrMsg($fp.'妯℃澘鏂囦欢涓嶅瓨鍦�');
exit;
}
$f = fopen($fp,'r');
$strout = fread($f,filesize($fp));
fclose($f);
$strout=str_replace("{#siteskin}",$siteskin,$strout) ;
$strout=str_replace("{#sitename}",sitename,$strout) ;
$strout=str_replace("{#siteurl}",siteurl,$strout) ;
$strout=str_replace("{#logourl}",logourl,$strout) ;
$strout=str_replace("{#sitebottom}",sitebottom(),$strout);
$strout=str_replace("{#sitetop}",sitetop(),$strout);
$strout=showlabel($strout);

echo  $strout;
?>
