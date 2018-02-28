<?php
$url = "http://sh.qihoo.com/";
include("Snoopy.class.php");
$snoopy = new Snoopy;
 
$snoopy->fetch($url); //获取所有内容
echo $snoopy->results; //显示结果
 
//可选以下
/*$snoopy->fetchtext; //获取文本内容（去掉html代码）
 
$snoopy->fetchlinks; //获取链接
 
$snoopy->fetchform;  //获取表单*/
 /*include "snoopy.class.php";
 $snoopy = new Snoopy;
 @$snoopy->fetchform("https://www.mgtv.com/");
 print $snoopy->results;*/
?>