<?include './public.php';//引入公共库
if($_GET['id'] !== ""){
    $id = Escape($conn,$_GET['id']);
    $sql = Execute($conn,"select * from contents where id = '{$id}'");//查询数据
    if(mysqli_num_rows($sql) !== 1){Notifications("文章不存在");}
    $contents_data = mysqli_fetch_assoc($sql);
}else{Notifications("参数无效！");}
include './header.php';//引入公共头部资源?>

        <section id="fh5co-hero" class="js-fullheight" style="background-image: url(&quot;<?echo $contents_data['oneimg'];?>&quot;); height: 644px;" data-next="yes">
            <div class="fh5co-overlay"></div>
            <div class="container">
                <div class="fh5co-intro no-js-fullheight">
					<div class="fh5co-intro-text">
						
						<div class="fh5co-center-position">
							<h2 class="animate-box fadeInUp animated"><?echo $contents_data['tittle'];?></h2>
							<h3 class="animate-box fadeInUp animated"><?echo $contents_data['time'];?><br>CONTENTSID:<?echo $contents_data['id'];?>/USERID:<?echo $contents_data['user_id'];?></h3>
						</div>
					</div>
				</div>
            </div>
            <div class="fh5co-learn-more animate-box fadeInUp animated" style="margin-left: -80.5px;">
                <a href="#" class="scroll-btn">
                    <span class="text">下滑查看</span>
                    <span class="arrow"><i class="icon-chevron-down"></i></span>
                </a>
            </div>
        </section>
        <!-- END #fh5co-hero -->
        <section id="fh5co-pricing">
			<div class="container">
                <?echo '<div id="editormd-view"><textarea style="display:none;">'.$contents_data['content'].'</textarea></div>';?>
			</div>
		</section>
		
<?include './footer.php';//引入公共尾部资源?>