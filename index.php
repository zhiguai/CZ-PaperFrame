<?php
/*
 * @Description: 
 * @Autor: 吃纸怪
 * @QQ: 2903074366
 * @Email: 2903074366@qq.com
 * @QQgroup: 801235342
 * @Github: https://github.com/zhiguai
 */
if (is_dir("./install")) {
    if (!file_exists("./install/lock.txt")) {
        header("location:./install/index.php");
        exit;
    }
}
header("location:./index/index.php");
exit;
