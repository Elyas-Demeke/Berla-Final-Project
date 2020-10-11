         <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Doctors</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="<?php echo base_url('doctors/add')?>" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Doctor</a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="doctorTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Date of birth</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>    
                            <?php if($user_data): ?>
                                <?php foreach ($user_data as $k => $v): ?>
                                    <tr>
                                        <td><img alt="" class="avatar" src="<?php echo $v['user_info']['photo']?>"></td>
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
                                        <td>
                                            <a href="<?php echo base_url('Doctors/edit/'.$v['user_info']['empid']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger" onclick=" removeFunc('<?php echo $v['user_info']['empid']?>')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Remove User </h4>
                </div>


                <div class="modal-body">
                  <p>Do you really want to remove?</p>
              </div>
              <div class="modal-footer">
               <form id="removeForm" action=" <?php echo base_url('Doctors/delete/') ?>" method="post">
                <input type="submit" class="btn btn-danger" name="confirm" value="Remove">
                <a href="#" class="btn btn-default">Cancel</a>
            </form>
        </div>



    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    function removeFunc(id)
    {
        console.log(id);
        document.getElementById('removeForm').action = <?php echo base_url('Doctors/delete/')?> + id;
        console.log(document.getElementById('removeForm').action);
    }
    $(document).ready(function() {
       $("#Doctors").addClass('active');
   }); 

</script>