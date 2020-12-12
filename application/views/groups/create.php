
<style> 
	.form-group.required .control-label:after{
		content: " * ";
		color: red;
	}

</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="page-wrapper">
    <!-- Content Header (Page header) -->
    
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

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Role</h3>
            </div>
            <form role="form" action="<?php base_url('groups/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group required">
                  <label for="group_name" class="control-label">Role Name</label>
                  <input type="text" class="control-label" class="form-control" id="group_name" name="group_name" placeholder="Enter group name" required>
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>
                  <input type="checkbox" style="margin-left: 6%; " onClick="toggle(this)" /> Check All<br/>
                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>View</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                      <tr>
                        <td>Patients</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPatient" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updatePatient" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewPatient" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deletePatient" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Appointments</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createAppointment" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateAppointment" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewAppointment" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteAppointment" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Employees</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createEmployee" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateEmployee" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewEmployee" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteEmployee" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Roles</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createRole" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateRole" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewRole" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteRole" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Laboratory test</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createLabTest" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateLabTest" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewLabTest" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteLabTest" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Labratory result</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createLabResult" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateLabResult" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewLabResult" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteLabResult" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Bed</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="creatBed" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateBed" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewBed" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteBed" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Sick Leave</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSickLeave" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSickLeave" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSickLeave" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSickLeave" class="minimWard"></td>
                      </tr>
                      <tr>
                        <td>Ward</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createWard" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateWard" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewWard" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteWard" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Oral History</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createOralHistory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateOralHistory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewOralHistory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteOralHistory" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Vital Signs</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createVitalSigns" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateVitalSigns" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewVitalSigns" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteVitalSigns" class="minimal"></td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('groups/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
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

<script type="text/javascript">
  $(document).ready(function() {
    $("#groups").addClass('active');
    

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
  });
  function toggle(source) {
    $('input:checkbox').attr('checked', source.checked);
  // checkboxes = document.getElementsByTagName('input:checkbox');
  // for(var checkbox in checkboxes)
  //   checkbox.checked = source.checked;
  }
</script>

