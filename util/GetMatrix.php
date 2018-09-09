<?php
    header("content-type: text/html;charset=utf-8");
    try
    {
	#echo 'name='.$name.'#';
	$set_charset = 'export LANG=en_US.UTF-8;';
	$target=shell_exec($set_charset.'python3 MatrixBuilder.py');
	$target=str_replace(', ',',',$target);
	$target=str_replace(']',']-',$target);
	//$target=exec('python3 getMessage.py');
    }
    catch(Exception $e)
    {
	echo 'Message: ' .$e->getMessage();
    }
    //$target=str_replace("'","\"",$target);
   
    echo $target;

?>
