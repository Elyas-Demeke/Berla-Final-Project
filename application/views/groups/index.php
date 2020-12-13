

  <!-- Content Wrapper. Contains page content -->
  <div class="page-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
      <h1>
        Manage
        <small>Roles</small>
      </h1>
     
    </section> -->

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">

          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <?php //if(in_array('createGroup', $user_permission)): ?>
            <a href="<?php echo base_url('groups/create') ?>" class="btn btn-primary">Add Role</a>
            <br /> <br />
          <?php //endif; ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Roles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="groupTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Role Name</th>
                  <?php// if(in_array('updateGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                    <th>Action</th>
                  <?php// endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php if($role_data): ?>                  
                    <?php foreach ($role_data as $k => $v): ?>
                      <tr>
                        <td><?php echo $v['role_info']['name']; ?></td>

                        <?php //if(in_array('updateGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                        <td>
                          <?php //if(in_array('updateGroup', $user_permission)): ?>
                          <a href="<?php echo base_url('groups/edit/'.$v['role_info']['id']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>  
                          <?php// endif; ?>
                          <?php //if(in_array('deleteGroup', $user_permission)): ?>
                         
                           <button type="button" class="btn btn-danger" onclick="removeFunc('<?php  echo $v['role_info']['id']?>')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>

                          <?php// endif; ?>


                        </td>
                        <?php //endif; ?>
                      </tr>
                    <?php endforeach ?>
                  <?php //endif; ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php if(in_array('deleteRole', $user_permission)): ?>
<!-- remove brand modal -->
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
<?php endif; ?>
<?php endif; ?>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#groupTable').DataTable();

      $("#groups").addClass('active');
    });
     function removeFunc(id)
    {
        console.log(id);
        document.getElementById('removeForm').action = "delete/" + id ;
        console.log(document.getElementById('removeForm').action);
    }

       // remove functions 

  </script>
