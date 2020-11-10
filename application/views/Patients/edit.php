        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Patient Profile</h4>
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

                  <form role="form" method="post" enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo base_url('patients/edit/'.$patient_data['patid'])?>">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="fname" name="fname" required value="<?php echo $patient_data['fname']?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Middle Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="mname" required value="<?php echo $patient_data['mname']?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="lname" required value="<?php echo $patient_data['lname']?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" required value="<?php echo $patient_data['email']?>">
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
                                    <input type="date" class="form-control " name="dob" required value="<?php echo $patient_data['dob']?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group gender-select">
                              <label class="gen-label">Gender:</label>
                              <div class="form-check-inline">
                                 <label class="form-check-label">
                                    <input type="radio" name="gender[]" class="form-check-input " value="1"<?php 
                                    if( $patient_data['sex'] == 1):
                                      echo "checked";
                                    endif;
                                    ?>>Male
                                </label>
                            </div>
                            <div class="form-check-inline">
                             <label class="form-check-label">
                                <input type="radio" name="gender[]" class="form-check-input" value="2"<?php 
                                if($patient_data['sex'] == 2):
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
                            <label >Home Number</label>
                            <input type="text" class="form-control" name="home_number" required value="<?php echo $patient_data['home']?>">
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input class="form-control" type="text" name="phone" required value="<?php echo $patient_data['phone']?>">
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
                        if($patient_data['ward_id'] == 1)
                          echo "selected";
                         ?>>Gynecology</option>
                        <option value="2"<?php 
                        if($patient_data['ward_id'] == 2)
                          echo "selected";
                         ?>>Pediatrics</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
               
            <div class="form-group">
                <label class="display-block">Status</label>
                <div class="form-check form-check-inline">
                   <input class="form-check-input" type="radio" name="status[]" id="patient_active" value="1" <?php 
                    if($patient_data['active']==1)
                      echo "checked";
                    ?>>
                   <label class="form-check-label" for="patinet_active">
                       Active
                   </label>
               </div>
               <div class="form-check form-check-inline">
                   <input class="form-check-input" type="radio" name="status[]" id="patient_inactive" value="0"<?php 
                   if($patient_data['active']==0)
                    echo "checked";
                    ?>>
                   <label class="form-check-label" for="patient_inactive">
                       Inactive
                   </label>
               </div>
           </div>
        </div>
    </div>
    
   <div class="m-t-20 text-center">
    <button type="submit" class="btn btn-primary submit-btn">Update Patient Information</button><p></p> <a href="<?php echo base_url('Patients')?>" class="btn btn-danger submit-btn">Back</a>
</div>
</form>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
     $("#Patients").addClass('active');
 }); 
</script>          