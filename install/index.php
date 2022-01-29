<?php
header('Content-type:text/html;charset=utf-8');
if (file_exists("./lock.txt")) {
	header("location:../index/000.php?notifications=请务必删除程序主目录下的install文件夹后再投入使用！！！");
	exit;
}
?>
<?php include_once "header.php"; ?>
				<div class="mdui-tab mdui-tab-full-width" mdui-tab>
				  	<a href="#example1-tab1" class="mdui-ripple" >程序介绍</a>
				  	<a href="#example1-tab2" class="mdui-ripple" disabled>数据库配置</a>
				  	<a href="#example1-tab3" class="mdui-ripple" disabled>管理员配置</a>
                    <a href="#example1-tab5" class="mdui-ripple" disabled>安装完成</a>
				</div>
				<div id="example1-tab1" class="mdui-p-a-2">
					<div class="mdui-typo">
						<h3>欢迎使用<?echo $softName?><small>V<?echo $softEdition?></small></h3>
					</div>
                    <div class="mdui-panel" mdui-panel>

                    <div class="mdui-panel-item  mdui-panel-item-open">
                        <div class="mdui-panel-item-header">详情</div>
                            <div class="mdui-panel-item-body">
                            <p>  
                                <ul>
                                    <li>作者：吃纸怪</li>
                                    <li>联系方式：
                                        <ul>
                                            <li>QQ：2903074366</li>
                                            <li>EMAIL：2903074366@qq.com</li>
                                        </ul>
                                    </li>
                                    <li>FatDa：<a href="http://fatda.cn">fatda.cn</a></li>
                                    <li>吃纸怪的Github：<a href="https://github.com/zhiguai/">github.com/zhiguai</a></li>
                                    <li>QQ交流群：801235342</li>
                                </ul>
                            </p>
                            <blockquote>如果您安装并使用了该程序，将默认您阅读并同意该条款<a href="http://fatda.cn/index.php/archives/8/">《Fatda用户条款》</a></blockquote>
                            <blockquote>Made by 吃纸怪 ©<?=date("Y")?> FatDa. All rights reserved. </blockquote>
                            <blockquote>最终解释权归FatDa所有</blockquote>
                        </div>
                    </div>

                    </div>
					<div class="mdui-divider mdui-m-t-4 mdui-m-b-2"></div>
					<a href="install-1.php?tab=2#example1-tab2"><button class="mdui-btn mdui-color-pink-accent mdui-m-a-1 mdui-float-right">开始安装</button></a>
				</div>
<?php include_once "footer.php"; ?>