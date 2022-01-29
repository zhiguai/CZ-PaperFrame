<?include './public.php';//引入公共库
if (mb_strlen($_GET['searchcont'], 'UTF8') > 30) {
    Notifications("./","搜索内容不得超出30个字符！","w");
}
$page_now_page = Escape($conn,$_GET['page']);
$searchcont = Escape($conn,$_GET['searchcont']);
if($_GET['searchcont'] !== ""){
    $sql = "select * from contents where id like binary '%{$searchcont}%' or tittle like binary '%{$searchcont}%' or user_id like binary '%{$searchcont}%' or top like binary '%{$searchcont}%' or ip like binary '%{$searchcont}%'  or time like binary '%{$searchcont}%'";
}else{
    $sql = "select * from contents";
}
$page_result = page($conn,$sql,"id",1,9,$page_now_page,$page_totalPage);
include './header.php';//引入公共头部资源?>
        <!-- #fh5co-header -->

        <section id="fh5co-hero" class="js-fullheight" style="background-image: url(&quot;../assets/admin/image/7TZsxO.jpg&quot;); height: 644px;" data-next="yes">
            <div class="fh5co-overlay"></div>
            <div class="container">
                <div class="fh5co-intro js-fullheight" style="height: 644px;">
                    <div class="fh5co-intro-text">
						<div class="fh5co-center-position">
							<h2 class="animate-box fadeInUp animated">搜 索</h2>
							<h3 class="animate-box fadeInUp animated">查看更多文章</h3>
						</div>
                    </div>
                </div>
            </div>
            <div class="fh5co-learn-more animate-box fadeInUp animated" style="margin-left: -80.5px;">
                <a href="#" class="scroll-btn">
                    <span class="text">探索更多关于我们的信息</span>
                    <span class="arrow"><i class="icon-chevron-down"></i></span>
                </a>
            </div>
        </section>
        <!-- END #fh5co-hero -->
        <section id="fh5co-projects">
            <section id="fh5co-subscribe">
            	<div class="container">
            
            		<h3 class="animate-box fadeInUp animated"><label for="text">可搜索，时间，标题，内容，发布者</label></h3>
            		<form action="./search.php" method="get" class="animate-box fadeInUp animated">
            			<input type="text" class="form-control" placeholder="输入你要检索的内容" id="text" name="searchcont">
            			<input type="submit" value="搜索" class="btn btn-primary">
            		</form>
            
            	</div>
            </section>
            <div class="container">
                <div class="row">
<?
while ($page_data = mysqli_fetch_array($page_result)){ 
?>
                    <div class="col-md-4 col-sm-6 col-xxs-12 animate-box fadeInUp animated">
                        <a href="./page.php?id=<?echo $page_data['id']?>" class="fh5co-project-item">
                            <div class="img-responsive" style="background: url(<?echo $page_data['oneimg']?>) no-repeat center;
                                background-size: cover;
                                padding-top: 100px !important;
                                padding-bottom: 100px !important;">  
                            </div>
                            <div class="fh5co-text">
                                <h2><?if($page_data['top']==1){echo'🔝';}?><?echo $page_data['tittle']?></h2>
                                <p><?echo $page_data['time']?></p>
                            </div>
                        </a>
                    </div>
<?
}
?>
                </div>
                <a href="?page=1<?echo '&searchcont='.$_GET['searchcont'];?>" class="btn btn-primary ">首页</a>
                <?if(!empty($_GET['page']) && $_GET['page'] !== "1"){ ?>
                <a href="?page=<?$page = $page_now_page - 1;echo $page.'&searchcont='.$_GET['searchcont'];?>" class="btn btn-primary ">上一页</a>
                <?}?>
                <a class="btn btn-primary "><?echo $page_now_page."/".$page_totalPage;?></a>
                <?if($page_totalPage > $page_now_page){?>
                <a href="?page=<?$page = $page_now_page + 1;echo $page.'&searchcont='.$_GET['searchcont'];?>" class="btn btn-primary ">下一页</a>
                <?}?>
                <a href="?page=<?echo $page_totalPage.'&searchcont='.$_GET['searchcont'];?>" class="btn btn-primary ">尾页</a>
            </div>
        </section>
        <!-- END #fh5co-projects -->
<?include './footer.php';//引入公共尾部资源?>