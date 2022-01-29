<?php
    include './public.php';

    //登入验证
    if ($_POST['state'] == 'login') {
    
        //极验二次验证
        require_once dirname(dirname(__FILE__)) . '/public/geetest/lib/class.geetestlib.php';
        require_once dirname(dirname(__FILE__)) . '/public/geetest/config/config.php';
        
        $GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
        if ($_SESSION['gtserver'] == 1) {   //服务器正常
            $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode']);
            if ($result) {
            } else {
                Notifications("./login.php","人机验证失败，请重试！","i");
            }
        } else {  //服务器宕机,走failback模式
            if ($GtSdk->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'])) {
            } else {
                Notifications("./login.php","人机验证失败，请重试！","i");
            }
        }
        
        if (empty($_POST['username'])) {
            Notifications("./login.php","请输入账号！","w");
        }
        if (empty($_POST['password'])) {
            Notifications("./login.php","请输入密码！","w");
        }
        //判断是否存在中文
        if (preg_match("/[\x7f-\xff]/", $_POST['id'])||preg_match("/[\x7f-\xff]/", $_POST['password'])||preg_match("/[\x7f-\xff]/", $_POST['username'])||preg_match("/[\x7f-\xff]/", $_POST['power'])) {
            Notifications("./edit.php?state=editUser&id={$_POST['id']}","存在非法字符！","w");
        }
        if (mb_strlen($_POST['username'], 'UTF8') > 24) {
            Notifications("./edit.php?state=editUser&id={$id}","用户名不得超出24个字符！","w");
        }
        if (mb_strlen($_POST['username'], 'UTF8') < 6) {
            Notifications("./edit.php?state=editUser&id={$id}","用户名不得低于6个字符！","w");
        }
        if (mb_strlen($_POST['password'], 'UTF8') > 24) {
            Notifications("./edit.php?state=editUser&id={$id}","密码不得超出24个字符！","w");
        }
        if (mb_strlen($_POST['password'], 'UTF8') < 6) {
            Notifications("./edit.php?state=editUser&id={$id}","密码不得低于6个字符！","w");
        }
    
        $username = Escape($conn, $_POST['username']);//获取登录表单信息
        $password = md5($_POST['password']);//获取登录表单信息
    
        $sql = Execute($conn, "select * from user where username = '{$username}' and password = '{$password}'");//查询数据库
    
        if (mysqli_num_rows($sql) !== 1) {
            Notifications("./login.php","账号或密码错误！","d");
        }
    
        $linshi_data = mysqli_fetch_array($sql);
        //登陆成功设置session id
        $_SESSION['id'] = $linshi_data['id'];
        
        $sql = "update user set sign_time = '{$time}',sign_ip = '{$ip}' where id='{$linshi_data['id']}'";
        Execute($conn, $sql);
        Notifications("./index.php","登入成功！");
    }

//==============================================================================================================

    //判断是否登入
    if (empty($_SESSION['id'])) {
        Notifications("./login.php","请先登录","i");
    }
    
    //账号退出
    if ($_GET['state'] == 'logout') {
        unset($_SESSION['id']);
        Notifications("./login.php","退出成功",);
    }
 
    //添加管理员
    if ($_GET['state'] == 'addUser') {
        //判断当前登录者权限
        if ($admin_data['power'] !== "1") {
            Notifications("./index.php","权限不足！","d");
        }
        
        $username = randomkeys(7);
        $password = md5("1234567");
        $sql = "INSERT INTO user (username,password,power,set_time,sign_ip)
        VALUES ('{$username}','{$password}','2','{$time}','{$ip}')";
        
        if (Execute($conn, $sql)) {
            Notifications("./user.php","添加成功,请修改账号密码后使用！","s");
        }
        Notifications("./user.php","添加失败！","d");
    }
    //编辑管理员
    if ($_POST['state'] == 'editUser') {
        //判断当前登录者权限
        if ($admin_data['power'] !== "1") {
            Notifications("./index.php","权限不足！","d");
        }
        //判断是否存在中文
        if (preg_match("/[\x7f-\xff]/", $_POST['id'])||preg_match("/[\x7f-\xff]/", $_POST['password'])||preg_match("/[\x7f-\xff]/", $_POST['username'])||preg_match("/[\x7f-\xff]/", $_POST['power'])) {
            Notifications("./edit.php?state=editUser&id={$_POST['id']}","存在非法字符！","w");
        }

        //整理数据确保可入库
        $id = Escape($conn, $_POST['id']);
        $username = Escape($conn, $_POST['username']);
        $power = Escape($conn, $_POST['power']);

        $sql = Execute($conn, "select * from user where id = '{$id}'");//查询数据
        if (mysqli_num_rows($sql) !== 1) {
            Notifications("./user.php","该用户不存在！","w");
        }

        if (empty($_POST['username']) || empty($_POST['power'])) {
            Notifications("./edit.php?state=editUser&id={$id}","密码除外请勿留空！","w");
        }
        if ($_POST['power'] !== "1" && $_POST['power'] !== "2") {
            Notifications("./edit.php?state=editUser&id={$id}","power参数无效！","w");
        }
        
        $sql = Execute($conn, "select * from user where id = '{$_POST['id']}'");//查询数据
        $user_data = mysqli_fetch_assoc($sql);
        
        if($_POST['username'] == $user_data['username'] && $_POST['power'] == $user_data['power'] && $_POST['password'] == ""){
            Notifications("./edit.php?state=editUser&id={$id}","请修改后再提交！","w");
        }
        //判断是否修改用户名并修改
        if ($_POST['username'] !== $user_data['username']) {
            if (mb_strlen($_POST['username'], 'UTF8') > 24) {
                Notifications("./edit.php?state=editUser&id={$id}","用户名不得超出24个字符！","w");
            }
            if (mb_strlen($_POST['username'], 'UTF8') < 6) {
                Notifications("./edit.php?state=editUser&id={$id}","用户名不得低于6个字符！","w");
            }
            //判断账号是否存在
            $sql = "select * from user where username = '{$username}'";
            $linshi_data = Execute($conn, $sql);
            if (mysqli_num_rows($linshi_data)) {
                Notifications("./edit.php?state=editUser&id={$id}","该用户名重复，请更换后再试！","w");
            }
            $sql = "update user set username = '{$username}', set_time = '{$time}' where id='{$id}'";
            if (Execute($conn, $sql)) {$username = "y";}else{$username = "n";}
        }else{
            $username = "y";
        }
        //判断是否修改权限并修改
        if ($_POST['power'] !== $user_data['power']) {
            if ($id == $admin_data['id']) {
                Notifications("./edit.php?state=editUser&id={$id}","您无法修改自己的权限！","d");
            }
            $sql = "update user set power = {$power}, set_time = '{$time}' where id='{$id}'";
            if (Execute($conn, $sql)) {$power = "y";}else{$power = "n";}
        }else{
            $power = "y";
        }
        //判断是否修改密码并修改
        if ($_POST['password'] !== "") {
            if (mb_strlen($_POST['password'], 'UTF8') > 24) {
                Notifications("./edit.php?state=editUser&id={$id}","密码不得超出24个字符！","w");
            }
            if (mb_strlen($_POST['password'], 'UTF8') < 6) {
                Notifications("./edit.php?state=editUser&id={$id}","密码不得低于6个字符！","w");
            }
            $password = md5($_POST['password']);
            $sql = "update user set password = '{$password}', set_time = '{$time}' where id='{$id}'";
            if (Execute($conn, $sql)) {$password = "y";}else{$password = "n";}
        }else{
            $password = "y";
        }
        if($password == "y" && $username == "y" && $power == "y"){
            Notifications("./user.php","编辑成功！","s");
        }
        Notifications("./edit.php?state=editUser&id={$id}","用户名:{$username}/权限:{$power}/密码:{$password}","w");
    }
    //删除管理员
    if ($_GET['state'] == 'deleteUser') {
        $id = Escape($conn, $_GET['id']);
        //判断当前登录者权限
        if ($admin_data['power'] !== "1") {
            Notifications("./index.php","权限不足！","d");
        }
        if ($id == $admin_data['id']) {
            Notifications("./index.php","您无法删除自己！","d");
        }
        $sql = Execute($conn, "select * from user where id = '{$id}'");//查询数据
        if (mysqli_num_rows($sql) !== 1) {
            Notifications("./user.php","该用户不存在！","w");
        }
        $sql = "delete from user where id='{$id}'";
        if (Execute($conn, $sql)) {
            Notifications("./user.php","删除成功！","s");
        }else{
            Notifications("./user.php","删除失败！","d");
        }
    }
    
    //添加文章
    if ($_GET['state'] == 'addContents') {
        $tittle = randomkeys(7);
        $sql = "INSERT INTO contents (user_id,tittle,ip,time)
        VALUES ('{$admin_data['id']}','{$tittle}','{$ip}','{$time}')";
        
        if (Execute($conn, $sql)) {
            Notifications("./contents.php","添加成功,请编辑后使用！","s");
        }
        Notifications("./contents.php","添加失败！","d");
    }
    //编辑文章
    if ($_POST['state'] == 'editContents') {
        //整理数据确保可入库
        $id = Escape($conn, $_POST['id']);
        $tittle = Escape($conn, $_POST['tittle']);
        $content = Escape($conn, $_POST['content']);
        $oneimg = Escape($conn, $_POST['oneimg']);
        $top = Escape($conn, $_POST['top']);
        if ($_POST['top'] !== "0" && $_POST['top'] !== "1") {
            Notifications("./contents.php","TOP参数无效！","w");
        }
        
        $sql = Execute($conn, "select * from contents where id = '{$id}'");//查询数据
        if (mysqli_num_rows($sql) !== 1) {
            Notifications("./contents.php","该文章不存在！","w");
        }
        
        $sql = Execute($conn, "select * from contents where id = '{$_POST['id']}'");//查询数据
        $contents_data = mysqli_fetch_assoc($sql);

        if($_POST['tittle'] == $contents_data['tittle'] && $_POST['content'] == $contents_data['content'] && $_POST['oneimg'] == $contents_data['oneimg'] && $_POST['top'] == $contents_data['top']){
            Notifications("./contents.php?state=editContent&id={$id}","请修改后再提交","w");
        }
        if($_POST['tittle'] !== $contents_data['tittle']){
            $sql = "update contents set tittle = '{$tittle}', time = '{$time}' ,ip = '{$ip}' where id='{$id}'";
            if (Execute($conn, $sql)) {$tittle = "y";}else{$tittle = "n";}
        }else{
            $tittle = "y";
        }
        
        if($_POST['content'] !== $contents_data['content']){
            $sql = "update contents set content = '{$content}', time = '{$time}' ,ip = '{$ip}' where id='{$id}'";
            if (Execute($conn, $sql)) {$content = "y";}else{$content = "n";}
        }else{
            $content = "y";
        }

        if($_POST['oneimg'] !== $contents_data['oneimg']){
            $sql = "update contents set oneimg = '{$oneimg}', time = '{$time}' ,ip = '{$ip}' where id='{$id}'";
            if (Execute($conn, $sql)) {$oneimg = "y";}else{$oneimg = "n";}
        }else{
            $oneimg = "y";
        }
        
        if($_POST['top'] !== $contents_data['top']){
            $sql = "update contents set top = '{$top}', time = '{$time}' ,ip = '{$ip}' where id='{$id}'";
            if (Execute($conn, $sql)) {$top = "y";}else{$top = "n";}
        }else{
            $top = "y";
        }
        
        if($content == "y" && $tittle == "y" && $oneimg == "y" && $top == "y"){
            Notifications("./contents.php","编辑成功！","s");
        }
        Notifications("./system.php?state=editUser&id={$id}","文章名:{$tittle}/文章内容:{$content}/封面图:{$content}/置顶:{$top}","w");   
    }
    //删除文章
    if ($_GET['state'] == 'deleteContents') {
        $id = Escape($conn, $_GET['id']);
        $sql = Execute($conn, "select * from contents where id = '{$id}'");//查询数据
        if (mysqli_num_rows($sql) !== 1) {
            Notifications("./contents.php","该文章不存在！","w");
        }
        $sql = "delete from contents where id='{$id}'";
        if (Execute($conn, $sql)) {
            Notifications("./contents.php","删除成功！","s");
        }else{
            Notifications("./contents.php","删除失败！","d");
        }
    }

    //编辑系统
    if ($_POST['state'] == 'editSystem') {
        //整理数据确保可入库
        $url = Escape($conn, $_POST['url']);
        $tittle = Escape($conn, $_POST['tittle']);
        $keyworld = Escape($conn, $_POST['keyworld']);
        $description = Escape($conn, $_POST['description']);
        $copyright = Escape($conn, $_POST['copyright']);
        $friends = Escape($conn, $_POST['friends']);

        if($_POST['tittle'] == $system_data['tittle'] && $_POST['keyworld'] == $system_data['keyworld'] && $_POST['url'] == $system_data['url'] && $_POST['description'] == $system_data['description'] && $_POST['copyright'] == $system_data['copyright']&& $_POST['friends'] == $system_data['friends']){
            Notifications("./system.php","请修改后再提交","w");
        }
        if($_POST['tittle'] !== $system_data['tittle']){
            $sql = "update system set value = '{$tittle}' where name='tittle'";
            if (Execute($conn, $sql)) {$tittle = "y";}else{$tittle = "n";}
        }else{
            $tittle = "y";
        }
        
        if($_POST['keyworld'] !== $system_data['keyworld']){
            $sql = "update system set value = '{$keyworld}' where name='keyworld'";
            if (Execute($conn, $sql)) {$keyworld = "y";}else{$keyworld = "n";}
        }else{
            $keyworld = "y";
        }

        if($_POST['url'] !== $system_data['url']){
            $sql = "update system set value = '{$url}' where name='url'";
            if (Execute($conn, $sql)) {$url = "y";}else{$url = "n";}
        }else{
            $url = "y";
        }
        
        if($_POST['description'] !== $system_data['description']){
            $sql = "update system set value = '{$description}' where name='description'";
            if (Execute($conn, $sql)) {$description = "y";}else{$description = "n";}
        }else{
            $description = "y";
        }
		
        if($_POST['copyright'] !== $system_data['copyright']){
            $sql = "update system set value = '{$copyright}' where name='copyright'";
            if (Execute($conn, $sql)) {$copyright = "y";}else{$copyright = "n";}
        }else{
            $copyright = "y";
        }
		
        if($_POST['friends'] !== $system_data['friends']){
            $sql = "update system set value = '{$friends}' where name='friends'";
            if (Execute($conn, $sql)) {$friends = "y";}else{$friends = "n";}
        }else{
            $friends = "y";
        }
        
        if($keyworld == "y" && $tittle == "y" && $url == "y" && $description == "y" && $copyright == "y" && $friends == "y"){
            Notifications("./system.php","编辑成功！","s");
        }
        Notifications("./system.php","站点名:{$tittle}/站点关键词:{$keyworld}/站点域名:{$url}/站点描述:{$description}/站点版权:{$copyright}/友情链接:{$friends}","w");   
    }
    
    Notifications("./","参数无效！","d");
    Close($conn); //关闭数据库连接
?>