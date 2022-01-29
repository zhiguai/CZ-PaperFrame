<?php
header('Content-type:text/html;charset=utf-8');
if (!empty($_GET['tishi'])) {
    echo <<<"STR"
<script type="text/javascript">
	window.onload=function(){
	  mdui.snackbar({
	    message: '{$_GET['tishi']}',
	    position: 'left-top'
	  });
	}
</script>
STR;
}
if($_GET['state'] == "complete"){
    if (!file_put_contents("lock.txt", "FatDa")) {
        header("location:/install/install-3.php?tishi=安装记录生成失败,检查写入权限重试或删除install文件夹!#example1-tab5");
        exit;
    }
    header("location:/index/000.php?&notifications=安装完成，请删除install文件夹!");
    exit;    
}
?>

<?php include_once "header.php"; ?>
				<div class="mdui-tab mdui-tab-full-width" mdui-tab>
				  	<a href="#example1-tab1" class="mdui-ripple" disabled>程序介绍</a>
				  	<a href="#example1-tab2" class="mdui-ripple" disabled>数据库配置</a>
				  	<a href="#example1-tab3" class="mdui-ripple" disabled>管理员配置</a>
                    <a href="#example1-tab4" class="mdui-ripple" >安装完成</a>
				</div>

				<div id="example1-tab5" class="mdui-p-a-2">
                    <div class="mdui-typo">
                            <h1 class="mdui-text-center">安装完成</h1>
                            <p>  
                                <ul>
                                    <li>管理地址：//<?php echo $_SERVER['SERVER_NAME'];?>/admin</li>
                                    <li>门户首页：//<?php echo $_SERVER['SERVER_NAME'];?>/index</li>
                                </ul>
                            </p>
                            <blockquote>如果您安装并使用了该程序，将默认您阅读并同意该条款<a href="http://fatda.cn/index.php/archives/8/">《Fatda用户条款》</a></blockquote>
                            <blockquote>Made by 吃纸怪 ©<?=date("Y")?> FatDa. All rights reserved. </blockquote>
                            <blockquote>最终解释权归FatDa所有</blockquote>
                        </div>
                        <div class="mdui-divider mdui-m-t-4 mdui-m-b-2"></div>
                        <div class="mdui-col">
                            <a href='./install-3.php?state=complete'><button class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple  mdui-color-pink-accent">完成安装</button></a>
                        </div>
                    </div>
				</div>
<?php include_once "footer.php"; ?>