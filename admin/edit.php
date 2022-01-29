<?php
    include './header.php';
    include './public1.php';
?>

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">编辑</h4>
                                </div>
                            </div>
                        </div>
                        <?Vnotifications()?>
                        <!-- end page title -->
<?if($_GET['state'] == "editUser" && !empty($_GET['id'])){
$id = Escape($conn,$_GET['id']);
$sql = Execute($conn,"select * from user where id = '{$id}'");//查询数据
if(mysqli_num_rows($sql) !== 1){Notifications("./","用户不存在","w");}
$user_data = mysqli_fetch_assoc($sql);
?>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">编辑 管理员ID:<?echo $user_data['id'];?></h4>
                                        <p class="card-title-desc">
                                            注意:密码留空默认不修改
                                        </p>
                                    </div>
                                    <div class="card-body">
                                        
                                        <form method="post" action="./api.php" class="needs-validation" novalidate="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3 position-relative">
                                                        <input name="state" style="display: none;" value="editUser" />
                                                        <input name="id" style="display: none;" value="<?echo $user_data['id'];?>" />
                                                        <label class="form-label" for="validationTooltip01">用户名</label>
                                                        <input name="username" type="text" class="form-control" id="validationTooltip01" placeholder="username" value="<?echo $user_data['username'];?>" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3 position-relative">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">权限</label>
                                                            <select name="power" required="" class="form-control form-select">
                                                                <?if($user_data['power'] == "2"){?>
                                                                <option value="2">管理员</option>
                                                                <option value="1">站长</option>
                                                                <?}else{?>
                                                                <option value="1">站长</option>
                                                                <option value="2">管理员</option>
                                                                <?}?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="validationTooltip03">密码</label>
                                                        <input name="password" type="password" class="form-control" id="validationTooltip03" placeholder="password" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit"> 提 交 </button>
                                        </form>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
<?}elseif($_GET['state'] == "editContents"){
$id = Escape($conn,$_GET['id']);
$sql = Execute($conn,"select * from contents where id = '{$id}'");//查询数据
if(mysqli_num_rows($sql) !== 1){Notifications("./","文章不存在","w");}
$contents_data = mysqli_fetch_assoc($sql);
?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">编辑 文章ID:<?echo $contents_data['id'];?></h4>
                                        <p class="card-title-desc">注意:请不要在"*"项中填入HTML代码</p>
                                    </div>
                                    <div class="card-body">
                                        
                                        <form method="post" action="./api.php" class="needs-validation" novalidate="">
                                            <div class="row">
                                                <div class="row">                                                            
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="formrow-email-input">标题</label>
                                                            <input name="tittle" type="text" class="form-control" id="validationTooltip01" placeholder="tittle" value="<?echo $contents_data['tittle'];?>" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="formrow-password-input">*封面图</label>
                                                            <input name="oneimg" type="text" class="form-control" id="validationTooltip01" placeholder="http://xxx.xxx.xxx/img.jpg" value="<?echo $contents_data['oneimg'];?>" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label">置顶</label>
                                                            <select name="top" required="" class="form-control form-select">
                                                                <?if($contents_data['top'] == "1"){?>
                                                                <option value="1">设置</option>
                                                                <option value="0">取消</option>
                                                                <?}else{?>
                                                                <option value="0">取消</option>
                                                                <option value="1">设置</option>
                                                                <?}?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3 position-relative">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3 position-relative">
                                                        <input name="state" style="display: none;" value="editContents" />
                                                        <input name="id" style="display: none;" value="<?echo $contents_data['id'];?>" />
                                                        <div id="test-editor">
                                                            <textarea name="content" style="display:none;"><?echo $contents_data['content'];?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit"> 提 交 </button>
                                        </form>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
<?}else{Notifications("./","参数出现无效","d");}?>
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
<?php include 'footer.php';?>