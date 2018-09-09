<?php
    header("content-type: text/html;charset=utf-8");
    $name=$_POST['name'];
    try
    {
	#echo 'name='.$name.'#';
	$set_charset = 'export LANG=en_US.UTF-8;';
	$target=shell_exec($set_charset.'python3 GetTheme.py '.$name);
	
	//$target=exec('python3 getMessage.py');
    }
    catch(Exception $e)
    {
	echo 'Message: ' .$e->getMessage();
    }
    //$target=str_replace("'","\"",$target);
   
    echo $target;

?>
