<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/7/2
 * Time: 16:57
 */
    $dir ="../bgm/mp3/";
    $files = scandir($dir);
    $files=array_splice($files,2);

    echo count($files)-1;
?>
