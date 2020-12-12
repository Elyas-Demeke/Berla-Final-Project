        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Employee Profile</h4>
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

                  <form role="form" method="post" enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo base_url('Employees/edit/'.$Employee_data['empid'])?>">
                    <div class="row">
                      <div class="form-group required col-sm-6" >
                          <label for="groups" class="control-label" >Roles</label>
                            <select class="form-control" id="groups" name="groups" required>
                              <option value="" >Select Role</option>
                              <?php foreach ($group_data as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>" <?php if( $Employee_data['roleId'] == $v['id']){echo "selected";} ?>><?php echo $v['name'] ?></option>
                              <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="fname" name="fname" required value="<?php echo $Employee_data['fname']?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Middle Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="mname" required value="<?php echo $Employee_data['mname']?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="lname" required value="<?php echo $Employee_data['lname']?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" required value="<?php echo $Employee_data['email']?>">
                            </div>
                        </div>
                        <!-- <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password"  value="<?php set_value('password');?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" type="password" name="cpassword"  value="<?php set_value('cpassword');?>">
                            </div>
                        </div> -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="date" class="form-control " name="dob" required value="<?php echo $Employee_data['dob']?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group gender-select">
                              <label class="gen-label">Gender:</label>
                              <div class="form-check-inline">
                                 <label class="form-check-label">
                                    <input type="radio" name="gender[]" class="form-check-input " value="1"<?php 
                                    if( $Employee_data['sex'] == 1):
                                      echo "checked";
                                    endif;
                                    ?>>Male
                                </label>
                            </div>
                            <div class="form-check-inline">
                             <label class="form-check-label">
                                <input type="radio" name="gender[]" class="form-check-input" value="2"<?php 
                                if($Employee_data['sex'] == 2):
                                  echo "checked";
                                endif;
                                ?>>Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                   <div class="row">
                      <div class="col-sm-6">
                         <div class="form-group">
                            <label >Office Number</label>
                            <input type="text" class="form-control" name="office_number" required value="<?php echo $Employee_data['officeno']?>">
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input class="form-control" type="text" name="phone" required value="<?php echo $Employee_data['phone']?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="form-group">
                    <label>Ward</label>
                    <select name="ward" class="form-control select">
                        <option > Select </option>
                        <option value="1" <?php 
                        if($Employee_data['ward_id'] == 1)
                          echo "selected";
                         ?>>Gynecology</option>
                        <option value="2"<?php 
                        if($Employee_data['ward_id'] == 2)
                          echo "selected";
                         ?>>Pediatrics</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
               <div class="form-group">
                  <label>Avatar</label>
                  <div class="profile-upload">
                     <div class="upload-img">
                        <img alt="profile picture" src="<?php echo base_url($Employee_data['photo'])?>">
                    </div>
                    <div class="upload-input">
                        <input type="file" name="photo" class="form-control" id="photo"  >
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="display-block">Status</label>
        <div class="form-check form-check-inline">
           <input class="form-check-input" type="radio" name="status[]" id="employee_active" value="1" <?php 
            if($Employee_data['active']==1)
              echo "checked";
            ?>>
           <label class="form-check-label" for="employee_active">
               Active
           </label>
       </div>
       <div class="form-check form-check-inline">
           <input class="form-check-input" type="radio" name="status[]" id="employee_inactive" value="0"<?php 
           if($Employee_data['active']==0)
            echo "checked";
            ?>>
           <label class="form-check-label" for="employee_inactive">
               Inactive
           </label>
       </div>
   </div>
   <div class="m-t-20 text-center">
    <button type="submit" class="btn btn-primary submit-btn">Update Employee Information</button><p></p> <a href="<?php echo base_url('Employees')?>" class="btn btn-danger submit-btn">Back</a>
</div>
</form>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
     $("#Employees").addClass('active');
 }); 
</script>          