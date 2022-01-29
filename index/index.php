<?include './public.php';//引入公共库
$page_now_page = Escape($conn,$_GET['page']);
$page_result = page($conn,'select * from contents',"top",1,9,$page_now_page,$page_totalPage);
include './header.php';//引入公共头部资源?>
        <!-- #fh5co-header -->

        <section id="fh5co-hero" class="js-fullheight" style="background-image: url(&quot;../assets/admin/image/7TZsxO.jpg&quot;); height: 644px;" data-next="yes">
            <div class="fh5co-overlay"></div>
            <div class="container">
                <div class="fh5co-intro js-fullheight" style="height: 644px;">
                    <div class="fh5co-intro-text">
                        <div class="fh5co-left-position">
                            <h2 class="animate-box fadeInUp animated">
                                Create Awesome Things for Better Web
                            </h2>
                            <p class="animate-box fadeInUp animated">
                                <a href="./search.php" target="_blank" class="btn btn-primary">更多内容</a>
                            </p>
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
            <div class="container">
                <div class="row row-bottom-padded-md">
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <h2 class="fh5co-lead animate-box fadeInUp animated"> NEWS </h2>
                        <p class="fh5co-sub-lead animate-box fadeInUp animated">下面是为您推荐的内容. </p>
                    </div>
                </div>
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
            </div>
        </section>
        <!-- END #fh5co-projects -->
<?include './footer.php';//引入公共尾部资源?>