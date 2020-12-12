

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
            <a href="<?php echo base_url('Ward/create') ?>" class="btn btn-primary">Add Ward</a>
            <br /> <br />
          <?php //endif; ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Ward</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="groupTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Ward Name</th>
                  <th>Phone number</th>
                  <?php if(in_array('updateWard', $user_permission) || in_array('deleteWard', $user_permission)): ?>
                    <th>Action</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php if($ward_data): ?>                  
                    <?php foreach ($ward_data as $k => $v): ?>
                      <tr>
                        <td><?php echo $v['ward_info']['name']; ?></td>
                        <td><?php echo $v['ward_info']['phone_num']; ?></td>

                        <?php //if(in_array('updateGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                        <td>
                          <?php //if(in_array('updateGroup', $user_permission)): ?>
                          <a href="<?php echo base_url('Wards/edit/'.$v['ward_info']['id']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>  
                          <?php// endif; ?>
                          <?php //if(in_array('deleteGroup', $user_permission)): ?>
                         
                           <button type="button" class="btn btn-danger" onclick="removeFunc($v['ward_info']['id'])" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>

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


  <?php //if(in_array('deleteGroup', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Group </h4>
      </div>

     
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
         <form action=" <?php echo base_url('Wards/delete/'.$v['ward_info']['id']) ?>" method="post">
            <input type="submit" class="btn btn-danger" name="confirm" value="Remove group">
            <a href="<?php echo base_url('groups') ?>" class="btn btn-default">Cancel</a>
          </form>
        </div>
  


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#groupTable').DataTable();

      $("#Ward").addClass('active');
    });


       // remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { group_id:id }, 
        dataType: 'json',
        success:function(response) {

          userTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+" comes from index "+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong> comes from index '+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}
  </script>
