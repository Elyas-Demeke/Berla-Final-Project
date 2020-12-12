        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">My Profile</h4>
                    </div>

                    <div class="col-sm-5 col-6 text-right m-b-30">
                        <a href="<?php echo base_url('Employees/setting')?>" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Edit Profile</a>
                    </div>
                </div>
                <div class="card-box profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"><img class="avatar" src="<?php echo base_url().$user_data['photo'] ?>" alt=""></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0"><?php echo $user_data['fname'].' '.$user_data['mname'].' '. $user_data['lname'] ?></h3>
                                                <small class="text-muted"><?php echo $user_data['rolename'] ?></small>
                                                <div class="staff-id">Employee ID : <?php echo $user_data['empid'] ?></div>                                                
                                                <div class="staff-id">Ward : <?php echo $user_data['wardname'] ?></div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="#"><?php echo $user_data['phone'] ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="#"><?php echo $user_data['email'] ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Birthday:</span>
                                                    <span class="text"><?php echo $user_data['dob'] ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Office Number:</span>
                                                    <span class="text"><?php echo $user_data['officeno'] ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Gender:</span>
                                                    <span class="text"><?php 
                                                    if($user_data['sex'] == 1)
                                                        echo "Male";
                                                    else
                                                        echo "Female";
                                                     ?>
                                                        </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>