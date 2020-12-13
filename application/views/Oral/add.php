<div class="page-wrapper">
            <div class="content">
                <div class="row"><br></div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Oral Diagnosis</h4>
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
                              adsfasd
                          </div>
                      <?php endif; ?>
                  <?php endif; ?>
                        <form role="form" method="post" enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo $patient_data['patid'] ?>">
                            <div class="row">
                                <div class="col-md-6">
                  									<div class="form-group">
                  										<label>Patient Name</label>
                  										<input class="form-control" type="text" value="<?php echo $patient_data['fname']." ".$patient_data['mname']; ?>" readonly="">
                  									</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Doctor</label>
                                        <input class="form-control" type="text" value="<?php echo $this->session->userdata('fname')." ".$this->session->userdata('mname') ?>" readonly="">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date & Time</label>
                                        <div class="time-icon">
                                            <input id="time" type="text" name="time" class="form-control timepicker" value="<?php 
                                            date_default_timezone_set("Africa/Addis_Ababa");
                                            echo date("m/d/Y h:i a");?>" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                    										<label>Diagnosis</label>
                                        <input class="form-control" type="text" name="diagnosis" >
                    										
                  									</div>
                                </div>
                            </div>
                            
                            <div class="row"><br></div>
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Submit Diagnosis</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<script type="text/javascript">
    $(document).ready(function() {
    
   $("#OralHistory").addClass('active');
     }); 
    </script>  