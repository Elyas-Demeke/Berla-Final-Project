<div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Appointments</h4>
                    </div>
                    
                </div>
				<div class="row">
					<div class="col-md-12">
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
						<div class="table-responsive">
							<!-- <div style="overflow: scroll;">  -->
								<table id="appointmentTable" class="table table-striped custom-table">
									<thead>
										<tr>
											<th class="text-center">Patient Name</th>
											<th class="text-center">Doctor Name</th>
											<th class="text-center">Department</th>
											<th class="text-center">Appointment Date & Time</th>
											<th class="text-center">Reason</th>
											<th class="text-center">Status</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if($appt_data): ?>
	                                <?php foreach ($appt_data as $k => $v): ?>
	                                    <tr>
	                                        <td class="text-center"><?php echo $v['appt_info']['pfname'].' '.$v['appt_info']['pmname'].' '. $v['appt_info']['plname'] ?></td>
	                                        <td class="text-center"><?php echo $v['appt_info']['efname'].' '.$v['appt_info']['emname'].' '. $v['appt_info']['elname'] ?></td>
	                                        <td class="text-center"><?php echo $v['appt_info']['name'] ?></td>
	                                        <td class="text-center"><?php echo $v['appt_info']['appt_date'] ?></td>
	                                        <td class="text-center"><?php echo $v['appt_info']['reason'] ?></td>
	                                        
											<td class="text-center"><?php if($v['appt_info']['status'] == 0): ?>
	                                            <img class="rounded-circle" width ="40" src="<?php echo base_url('assets/img/deactivated transparent sign.png')?>">
	                                            <?php elseif ($v['appt_info']['status'] == 1):  ?>
	                                            <img class="rounded-circle" width="40" src="<?php echo base_url('assets/img/active sign transparent.png')?>">
	                                        <?php endif; ?>
	                                        </td>
	                                        <td class="text-center">
	                                            
	                                            <a href="<?php echo base_url('Appointments/edit/'.$v['appt_info']['apptId']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
	                                            <button type="button" class="btn btn-danger" onclick=" removeFunc('<?php echo $v['appt_info']['apptId']?>')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
	                                        </td>
	                                    </tr>
	                                    
	                                <?php endforeach; ?>
	                            <?php endif; ?>
									</tbody>
								</table>
							<!-- </div> -->
						</div>
					</div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
	                  <div class="modal-header">
	                    <h4 class="modal-title">Remove User </h4>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                 </div>


		                <div class="modal-body">
		                  <p>Do you really want to remove?</p>
		              </div>
		              <div class="modal-footer">
		               <form id="removeForm" method="post">
		                <input type="submit" class="btn btn-danger" name="confirm" value="Remove"><span>    </span>
		                <!-- <a href="doctors" class="btn btn-default">Cancel</a> -->
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
			            </form>
				        </div>



				    </div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div>
<script type="text/javascript">
	function removeFunc(id)
    {
        console.log(id);
        document.getElementById('removeForm').action = "delete/" + id ;
        console.log(document.getElementById('removeForm').action);
    }
    $(document).ready(function() {
   $("#Appointments").addClass('active');
   $('#appointmentTable').DataTable('');
     }); 
    </script>                     