        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Doctor</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                      <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <?php echo $this->session->flashdata('success'); ?>
                      </div>
                      <?php elseif($this->session->flashdata('errors')): ?>
                        <div class="alert alert-error alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <?php echo $this->session->flashdata('errors'); ?>
                      </div>
                      
                      <?php else: ?>
                          <?php if(validation_errors()): ?>
                            <div class="alert alert-error alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <?php echo validation_errors(); ?>

                          </div>
                      <?php endif; ?>
                  <?php endif; ?>

                  <form role="form" method="post" enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo base_url('Doctors/add')?>">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="fname" name="fname" required value="<?php echo set_value('fname');?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Middle Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="mname" required value="<?php echo set_value('mname');?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="lname" required value="<?php echo set_value('lname');?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" required value="<?php echo set_value('email');?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" required value="<?php echo set_value('password');?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" type="password" name="cpassword" required value="<?php echo set_value('cpassword');?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="date" class="form-control " name="dob" required value="<?php echo set_value('dob');?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group gender-select">
                              <label class="gen-label">Gender:</label>
                              <div class="form-check-inline">
                                 <label class="form-check-label">
                                    <input type="radio" name="gender[]" class="form-check-input " value="1">Male
                                </label>
                            </div>
                            <div class="form-check-inline">
                             <label class="form-check-label">
                                <input type="radio" name="gender[]" class="form-check-input" value="2">Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                   <div class="row">
                      <div class="col-sm-6">
                         <div class="form-group">
                            <label >Office Number</label>
                            <input type="text" class="form-control" name="office_number" required value="<?php echo set_value('office_number');?>">
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input class="form-control" type="text" name="phone" required value="<?php echo set_value('phone');?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="form-group">
                    <label>Ward</label>
                    <select name="ward" class="form-control select">
                        <option > Select </option>
                        <option value="1">Gynecology</option>
                        <option value="2">Pediatrics</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
               <div class="form-group">
                  <label>Avatar</label>
                  <div class="profile-upload">
                     <div class="upload-img">
                        <img name="avatar" alt="" src="<?php echo base_url('assets/img/user.jpg')?>">
                    </div>
                    <div class="upload-input">
                        <input type="file" name="photo" class="form-control" id="photo" value="Save" value="<?php echo set_value('photo');?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="display-block">Status</label>
        <div class="form-check form-check-inline">
           <input class="form-check-input" type="radio" name="status[]" id="doctor_active" value="1" checked>
           <label class="form-check-label" for="doctor_active">
               Active
           </label>
       </div>
       <div class="form-check form-check-inline">
           <input class="form-check-input" type="radio" name="status[]" id="doctor_inactive" value="2">
           <label class="form-check-label" for="doctor_inactive">
               Inactive
           </label>
       </div>
   </div>
   <div class="m-t-20 text-center">
    <button type="submit" class="btn btn-primary submit-btn">Create Doctor</button>
</div>
</form>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
     $("#Doctors").addClass('active');
 }); 
</script>          