<?include './public.php';//引入公共库
if($_GET['notifications'] == ""){
    echo '<script>window.location.href="./"</script>'; 
    exit;    
}
include './header.php';//引入公共头部资源?>
        <section id="fh5co-hero" class="js-fullheight" style="background-image: url(&quot;../assets/admin/image/7TZsxO.jpg&quot;); height: 644px;" data-next="yes">
            <div class="fh5co-overlay"></div>
            <div class="container">
                <div class="fh5co-intro no-js-fullheight">
					<div class="fh5co-intro-text">
						
						<div class="fh5co-center-position">
							<h2 class="animate-box fadeInUp animated">X﹏X我们遇到一些问题!</h2>
							<h3 class="animate-box fadeInUp animated"><?echo $_GET['notifications'];?></h3>
						</div>
					</div>
				</div>
            </div>
        </section>
<?include './footer.php';//引入公共尾部资源?>