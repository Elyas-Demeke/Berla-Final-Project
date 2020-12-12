         <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Employees</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <?php if(in_array('createEmployee', $user_permission)): ?>
                        <a href="<?php echo base_url('Employees/add')?>" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Employee</a>
                        <?php endif; ?>
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
                <div class="box-body">
                    <table id="employeeTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Role</th>
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
                                        <td><img alt="" class="avatar" src="<?php echo base_url($v['user_info']['photo'])?>"></td>
                                        <td><?php echo $v['user_info']['fname'].' '.$v['user_info']['mname'].' '. $v['user_info']['lname'] ?></td>
                                        <td><?php 
                                        if($v['user_info']['sex'] == 1)
                                            echo 'Male';
                                        else
                                            echo 'Female'; 
                                        ?></td>
                                        <td><?php echo $v['user_info']['rolename'] ?></td>
                                        <td><?php echo $v['user_info']['phone'] ?></td>
                                        <td><?php echo $v['user_info']['email'] ?></td>
                                        <td><?php if($v['user_info']['active'] == 0): ?>
                                            <img alt="0" class="rounded-circle" width ="40" src="<?php echo base_url('assets/img/deactivated transparent sign.png')?>">
                                            <?php elseif ($v['user_info']['active'] == 1):  ?>
                                            <img alt="1" class="rounded-circle" width="40" src="<?php echo base_url('assets/img/active sign transparent.png')?>">
                                        <?php endif; ?>
                                        </td>
                                        <td>
                                             <?php if(in_array('updateEmployee', $user_permission)): ?>
                                            <a href="<?php echo base_url('Employees/edit/'.$v['user_info']['empid']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <?php endif; ?>
                                             <?php if(in_array('deleteEmployee', $user_permission)): ?>
                                            <button type="button" class="btn btn-danger" onclick=" removeFunc('<?php echo $v['user_info']['empid']?>')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
                                            <?php endif; ?>
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
        document.getElementById('removeForm').action = "Employees/delete/" + id ;
        console.log(document.getElementById('removeForm').action);
    }
    $(document).ready(function() {
        $('#employeeTable').DataTable('');
        $("#Employees").addClass('active');
   }); 

</script>