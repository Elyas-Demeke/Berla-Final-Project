         <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Patients</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="<?php echo base_url('Patients/add')?>" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Patient</a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="doctorTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Date of birth</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>    
                            <?php if($user_data): ?>
                                <?php foreach ($user_data as $k => $v): ?>
                                    <tr>
                                        <td><?php echo $v['user_info']['fname'].' '.$v['user_info']['mname'].' '. $v['user_info']['lname'] ?></td>
                                        <td><?php 
                                        if($v['user_info']['sex'] == 1)
                                            echo 'Male';
                                        else
                                            echo 'Female'; 
                                        ?></td>
                                        <td><?php echo $v['user_info']['dob'] ?></td>
                                        <td><?php echo $v['user_info']['phone'] ?></td>
                                        <td><?php echo $v['user_info']['email'] ?></td>
                                        <td><?php if($v['user_info']['in_patient'] == 0): ?>
                                            <img class="rounded-circle" width ="40" src="<?php echo base_url('assets/img/deactivated transparent sign.png')?>">
                                            <?php elseif ($v['user_info']['in_patient'] == 1):  ?>
                                            <img class="rounded-circle" width="40" src="<?php echo base_url('assets/img/active sign transparent.png')?>">
                                        <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('Patients/edit/'.$v['user_info']['empid']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger" onclick=" removeFunc('<?php echo $v['user_info']['id']?>')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
                                        </td>
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
        document.getElementById('removeForm').action = "Doctors/delete/" + id ;
        console.log(document.getElementById('removeForm').action);
    }
    $(document).ready(function() {
        $('#doctorTable').DataTable('');
        $("#Doctors").addClass('active');
   }); 

</script>