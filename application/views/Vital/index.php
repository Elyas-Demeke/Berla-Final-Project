<div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Vital Signs</h4>
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
                            
                          </div>
                      <?php endif; ?>
                      <?php endif; ?>
						<div class="table-responsive">
							<!-- <div style="overflow: scroll;">  -->
								<table id="vitalTable" class="table table-striped custom-table">
									<thead>
										<tr>
											<th class="text-center">Patient Name</th>
											<th class="text-center">Doctor Name</th>
										
											<th class="text-center">Date of recording</th>
											<th class="text-center">Temprature</th>
											<th class="text-center">Blood Pressure</th>
											<th class="text-center">Pulse</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if($vital_data): ?>
	                                <?php foreach ($vital_data as $k => $v): ?>
	                                    <tr>
	                                        <td class="text-center"><?php echo $v['vital_info']['pfname'].' '.$v['vital_info']['pmname'].' '. $v['vital_info']['plname'] ?></td>
	                                        <td class="text-center"><?php echo $v['vital_info']['efname'].' '.$v['vital_info']['emname'].' '. $v['vital_info']['elname'] ?></td>
	                                        
	                                        <td class="text-center"><?php echo $v['vital_info']['date'] ?></td>
	                                        <td class="text-center"><?php echo $v['vital_info']['temp'] ?></td>
	                                        <td class="text-center"><?php echo $v['vital_info']['bp'] ?></td>
	                                        <td class="text-center"><?php echo $v['vital_info']['pulse'] ?></td>
	                                        
											
	                                        <td class="text-center">
	                                            
	                                            <a href="<?php echo base_url('VitalSigns/edit/'.$v['vital_info']['vitalId']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
	                                            <button type="button" class="btn btn-danger" onclick=" removeFunc('<?php echo $v['vital_info']['vitalId']?>')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
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
   $("#VitalSigns").addClass('active');
   $('#vitalTable').DataTable('');
     }); 
    </script>                     