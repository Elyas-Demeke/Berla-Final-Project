        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Patients</h4>
                    </div>
                    <?php if(in_array('createPatient', $user_permission)): ?>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="<?php echo base_url('Patients/add')?>" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Patient</a>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="box-body">
                    <table id="patientTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Vital Signs</th>
                                <!-- <th>Date of birth</th> -->
                                <th>Oral Diagnosis</th>
                               <!--  <th>Email</th> -->
                                <th>Status</th>
                                <th>Labratory test</th>
                                <th>Appointment</th>
                                <?php if(in_array('update', $user_permission) || in_array('deletePatient', $user_permission)): ?>
                                <th>Action</th>
                            <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>    
                            <?php if($user_data): ?>
                                <?php foreach ($user_data as $k => $v): ?>
                                    <tr>
                                        <td><?php echo $v['user_info']['fname'].' '.$v['user_info']['mname'].' '. $v['user_info']['lname'] ?></td>
                                        <td>
                                            <a href="<?php echo base_url('VitalSigns/add/'.$v['user_info']['patid']) ?>" class="btn btn-default"><i class=" fa fa-plus-square-o"></i> Record</a>
                                        </td>
                                        <!-- <td><?php// echo $v['user_info']['dob'] ?></td> -->
                                        
                                        <td>
                                            <a href="<?php echo base_url('OralHistory/add/'.$v['user_info']['patid']) ?>" class="btn btn-default"><i class=" fa fa-address-book-o"></i> Add</a>
                                        </td>
										<td>
                                            <?php if($v['user_info']['active'] == 0): ?>
                                            <img class="rounded-circle" width ="40" src="<?php echo base_url('assets/img/deactivated transparent sign.png')?>">
                                            <?php elseif ($v['user_info']['active'] == 1):  ?>
                                            <img class="rounded-circle" width="40" src="<?php echo base_url('assets/img/active sign transparent.png')?>">
                                        <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('Laboratories/order/'.$v['user_info']['patid']) ?>" class="btn btn-default"><i class=" fa fa-hospital-o"></i> Order</a>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('Appointments/make/'.$v['user_info']['patid']) ?>" class="btn btn-default"><i class="fa fa-calendar-times-o"></i> Make</a>
                                        </td>
                                        <?php if(in_array('updatePatient', $user_permission) || in_array('deletePatient', $user_permission)): ?>
                                        <td>
                                            <?php if(in_array('updatePatient', $user_permission)): ?>
                                            <a href="<?php echo base_url('Patients/edit/'.$v['user_info']['patid']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <?php endif; ?>
                                            <?php if(in_array('deletePatient', $user_permission)): ?>

                                            <button type="button" class="btn btn-danger" onclick=" removeFunc('<?php echo $v['user_info']['patid']?>')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
                                        <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                    </tr>
                                    
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="see-all">
                            <a class="see-all-btn" href="javascript:void(0);">Load More</a>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- <div id="removeModal" class="modal fade delete-modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img src="assets/img/sent.png" alt="" width="50" height="46">
                            <h3>Are you sure want to delete this Doctor?</h3>
                            <form  id="removeForm" action="<?php echo base_url('Doctors/delete/'.$v['user_info']['empid'])?>" method="post">
                                <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
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

<!-- action=" <?php echo base_url('Doctors/delete/') ?>"  -->

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
        $('#patientTable').DataTable('');
        $("#Patients").addClass('active');
   }); 

</script>