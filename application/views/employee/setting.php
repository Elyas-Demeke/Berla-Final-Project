<div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Edit Profile</h4>
                    </div>
                </div>
                <form  role="form" method="post" enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo base_url('Employees/setting/')?>">
                    <div class="card-box">
                        <h3 class="card-title">Basic Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-img-wrap">
                                    <img class="inline-block" src="<?php echo base_url().$user_data['photo'] ?>" alt="user">
                                    <div class="fileupload btn">
                                        <span class="btn-text">edit</span>
                                        <input class="upload" name="photo" type="file">
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">First Name</label>
                                                <input type="text" name="fname" class="form-control floating" value="<?php echo $user_data['fname'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Middle Name</label>
                                                <input type="text" name="mname" class="form-control floating" value="<?php echo $user_data['mname'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Last Name</label>
                                                <input type="text" name="lname" class="form-control floating" value="<?php echo $user_data['lname'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Birth Date</label>
                                                <div class="cal-icon">
                                                    <input class="form-control floating" name="dob" type="date" value="<?php echo $user_data['dob'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus select-focus">
                                                <label class="focus-label">Gender</label>
                                                <input class="form-control floating" name="dob" type="text" value="<?php if($user_data['sex'] == 1): ?>
                                                    <?php echo 'Male'; ?>
                                                    <?php else: ?>
                                                    <?php echo 'Female'; ?>
                                                    <?php endif; ?>" readonly>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <h3 class="card-title">Contact Informations</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Phone</label>
                                    <input type="text" name="phone" class="form-control floating" value="<?php echo $user_data['phone'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Office Phone</label>
                                    <input type="text" name="office_number" class="form-control floating" value="<?php echo $user_data['officeno'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Email</label>
                                    <input type="text" name="email" class="form-control floating" value="<?php echo $user_data['email'] ?>">
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="card-box">
                        <h3 class="card-title">Credentials</h3>
                        <div class="form-group">
                          <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              Leave the password field empty if you don't want to change.
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Password</label>
                                    <input type="password" name="password" class="form-control floating">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Confirm Password</label>
                                    <input type="password" name='cpassword' class="form-control floating">
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="text-center m-t-20">
                        <button class="btn btn-primary submit-btn" type="button">Save Changes</button>
                    </div>
                </form>

