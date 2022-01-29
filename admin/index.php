<?php
    include './header.php';
    include './public1.php';

    $cntcont='select * from contents';//文章
    $cntcont=mysqli_num_rows(Execute($conn, $cntcont));
    
    $user='select * from user';//评论
    $user=mysqli_num_rows(Execute($conn, $user));
?>
                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">控制面板</h4>
                                </div>
                            </div>
                        </div>
                        <?Vnotifications()?>
                        <!-- end page title -->
                        <div class="row">
<? if ($admin_data['power'] == "1") {?>
                            <div class="col-xl-6 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">管理员</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="<?echo $user;?>">0</span>
                                                </h4>
                                            </div>
        
                                            <div class="col-3">
                                                <div class="activity-icon avatar-md">
                                                    <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                                                    <i class="fas fa-ad as fa-address-card font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
<?}?>        
                            <div class="col-xl-6 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">文章</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="<?echo $cntcont;?>">0</span>
                                                </h4>
                                            </div>
        
                                            <div class="col-3">
                                                <div class="activity-icon avatar-md">
                                                    <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                                                    <i class="fas fa-ad as fas fa-file-alt font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            
                        </div><!-- end row-->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

<?php include 'footer.php';?>