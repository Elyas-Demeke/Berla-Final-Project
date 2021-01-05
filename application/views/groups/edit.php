
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
              <h3 class="box-title">Edit Role</h3>
            </div>
            <form role="form" action="<?php base_url('groups/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group required">
                  <label for="group_name" class="control-label">Role Name</label>
                  <input type="text" class="control-label" class="form-control" id="group_name" name="group_name" placeholder="Enter group name" required value="<?php echo $group_data['name']; ?>">
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>
                  <input type="checkbox" style="margin-left: 6%; " onClick="toggle(this)" /> Check All<br/>
                  <?php $serialize_permission = unserialize($group_data['permission']); ?>
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
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPatient" class="minimal" <?php if($serialize_permission) {
                          if(in_array('createPatient', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updatePatient" class="minimal" <?php if($serialize_permission) {
                          if(in_array('updatePatient', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewPatient" class="minimal" <?php if($serialize_permission) {
                          if(in_array('viewPatient', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deletePatient" class="minimal" <?php if($serialize_permission) {
                          if(in_array('deletePatient', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                      </tr>                     
                      <tr>
                        <td>Appointments</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createAppointment" class="minimal"<?php if($serialize_permission) {
                          if(in_array('createAppointment', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateAppointment" class="minimal"<?php if($serialize_permission) {
                          if(in_array('updateAppointment', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewAppointment" class="minimal"<?php if($serialize_permission) {
                          if(in_array('viewAppointment', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteAppointment" class="minimal"<?php if($serialize_permission) {
                          if(in_array('deleteAppointment', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                      </tr>
                      <tr>
                        <td>Employees</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createEmployee" class="minimal"<?php if($serialize_permission) {
                          if(in_array('createEmployee', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateEmployee" class="minimal"<?php if($serialize_permission) {
                          if(in_array('updateEmployee', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewEmployee" class="minimal" <?php if($serialize_permission) {
                          if(in_array('viewEmployee', $serialize_permission)) { echo "checked"; } 
                        } ?> > </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteEmployee" class="minimal" <?php if($serialize_permission) {
                          if(in_array('deleteEmployee', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                      </tr>
                      <tr>
                        <td>Roles</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createRole" class="minimal" <?php if($serialize_permission) {
                          if(in_array('createRole', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateRole" class="minimal" <?php if($serialize_permission) {
                          if(in_array('updateRole', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewRole" class="minimal" <?php if($serialize_permission) {
                          if(in_array('viewRole', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteRole" class="minimal" <?php if($serialize_permission) {
                          if(in_array('deleteRole', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                      </tr>
                      <tr>
                        <td>Laboratory test</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createLabTest" class="minimal" <?php if($serialize_permission) {
                          if(in_array('createLabTest', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateLabTest" class="minimal" <?php if($serialize_permission) {
                          if(in_array('updateLabTest', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewLabTest" class="minimal" <?php if($serialize_permission) {
                          if(in_array('viewLabTest', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteLabTest" class="minimal" <?php if($serialize_permission) {
                          if(in_array('deleteLabTest', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                      </tr>
                      <tr>
                        <td>Labratory result</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createLabResult" class="minimal" <?php if($serialize_permission) {
                          if(in_array('createLabResult', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateLabResult" class="minimal" <?php if($serialize_permission) {
                          if(in_array('updateLabResult', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewLabResult" class="minimal" <?php if($serialize_permission) {
                          if(in_array('viewLabResult', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteLabResult" class="minimal" <?php if($serialize_permission) {
                          if(in_array('deleteLabResult', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                      </tr>
                      <tr>
                        <td>Bed</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="creatBed" class="minimal" <?php if($serialize_permission) {
                          if(in_array('creatBed', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateBed" class="minimal" <?php if($serialize_permission) {
                          if(in_array('updateBed', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewBed" class="minimal" <?php if($serialize_permission) {
                          if(in_array('viewBed', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteBed" class="minimal" <?php if($serialize_permission) {
                          if(in_array('deleteBed', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                      </tr>
                      <tr>
                        <td>Sick Leave</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSickLeave" class="minimal" <?php if($serialize_permission) {
                          if(in_array('createSickLeave', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSickLeave" class="minimal" <?php if($serialize_permission) {
                          if(in_array('updateSickLeave', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSickLeave" class="minimal" <?php if($serialize_permission) {
                          if(in_array('viewSickLeave', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSickLeave" class="minimWard" <?php if($serialize_permission) {
                          if(in_array('deleteSickLeave', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                      </tr>
                      <tr>
                        <td>Ward</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createWard" class="minimal" <?php if($serialize_permission) {
                          if(in_array('createWard', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateWard" class="minimal" <?php if($serialize_permission) {
                          if(in_array('updateWard', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewWard" class="minimal" <?php if($serialize_permission) {
                          if(in_array('viewWard', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteWard" class="minimal" <?php if($serialize_permission) {
                          if(in_array('deleteWard', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                      </tr>
                      <tr>
                        <td>Oral History</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createOralHistory" class="minimal" <?php if($serialize_permission) {
                          if(in_array('createOralHistory', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateOralHistory" class="minimal" <?php if($serialize_permission) {
                          if(in_array('updateOralHistory', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewOralHistory" class="minimal" <?php if($serialize_permission) {
                          if(in_array('viewOralHistory', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteOralHistory" class="minimal" <?php if($serialize_permission) {
                          if(in_array('deleteOralHistory', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                      </tr>
                      <tr>
                        <td>Vital Signs</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createVitalSigns" class="minimal" <?php if($serialize_permission) {
                          if(in_array('createVitalSigns', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateVitalSigns" class="minimal" <?php if($serialize_permission) {
                          if(in_array('updateVitalSigns', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewVitalSigns" class="minimal" <?php if($serialize_permission) {
                          if(in_array('viewVitalSigns', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteVitalSigns" class="minimal" <?php if($serialize_permission) {
                          if(in_array('deleteVitalSigns', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                      </tr>
                      <tr>
                        <td>Profile</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createProfile" class="minimal" <?php if($serialize_permission) {
                          if(in_array('createVitalSigns', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateProfile" class="minimal" <?php if($serialize_permission) {
                          if(in_array('updateVitalSigns', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProfile" class="minimal" <?php if($serialize_permission) {
                          if(in_array('viewVitalSigns', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteProfile" class="minimal" <?php if($serialize_permission) {
                          if(in_array('deleteVitalSigns', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
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

