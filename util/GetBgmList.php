<?php
    header("content-type: text/html;charset=utf-8");
//setlocale(LC_ALL, 'zh_CN');
//setlocale(LC_ALL, 'en_US.UTF-8');
    try
    {
	$set_charset = 'export LANG=en_US.UTF-8;';
	$target=shell_exec($set_charset.'python3 GetMessage.py');
	//$target=exec('python3 getMessage.py');
    }
    catch(Exception $e)
    {
	echo 'Message: ' .$e->getMessage();
    }
//    $target=shell_exec('python3.5 getMessage.py');
    //echo 'target='.$target;
    $target=str_replace("'","\"",$target);
   // $target=unicode_decode($target);
   
    //$target=preg_replace_callback('',function ($matchs){return "X";},"bbbbbabbbbb");
    //$target=preg_replace_callback('\\u[0-9a-fA-F]{4}',function ($matchs){return $matchs."X";},$target);
    echo $target;
//    while($file=$files->read()) {
//        if (!is_dir($dir.$file)and ($file!=".") and ($file!="..")) {//不是文件
//            $mp3 = strstr($file, ".");//aaa.mp3=>.mp3
//            if ($mp3 == ".mp3") {
//                echo $output;
//
//            }
//        }
//    }

?>
