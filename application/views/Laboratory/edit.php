<div class="page-wrapper">
            <div class="content">
                <div class="row"><br></div>
                
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
                        <form role="form" method="post" enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo $test_data['testId'] ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Patient Name</label>
                                        <input class="form-control" type="text" value="<?php echo $test_data['pfname']." ".$test_data['pmname']; ?>" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Doctor</label>
                                        <input class="form-control" type="text" value="<?php echo $test_data['efname']." ".$test_data['emname'] ?>" readonly="">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Laboratory Test Name</label>
                                        <input class="form-control" name="test_name" value="<?php echo $test_data['test_name'] ?>" type="text" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>test order time</label>
                                        <div class="time-icon">
                                            <input type="datetime-local" name="time" value="<?php echo date("Y-m-d\TH:i:s", strtotime($test_data['test_order_time'])) ?>" class="form-control timepicker" readonly>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                
                                </div>
                                <div class="col-md-12">
                                    
                                    <div class="form-group">
                                        <label>Test Result</label>
                                        <input class="form-control" name="result" type="textarea" value="<?php echo $test_data['result'] ?>" >
                                        <!-- <textarea class="form-control" name="result" value="<?php echo $test_data['result'] ?>" readonly=""></textarea> -->
                                    </div>
                                      
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Test result submission time</label>
                                            <div class="time-icon">
                                                <input type="datetime-local" name="time" value="<?php echo date("Y-m-d\TH:i:s", strtotime($test_data['completion_date'])) ?>" class="form-control timepicker" readonly>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row"><br></div>
                            
                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                <a href="<?php echo base_url('Laboratories')?>" class="btn btn-danger submit-btn">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<script type="text/javascript">
    $(document).ready(function() {
   $("#LaboratoryTest").addClass('active');
     }); 
    </script>  