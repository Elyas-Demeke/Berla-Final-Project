<div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li id="Dashboard">
                            <a href="<?php echo base_url('Dashboard')?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                    <?php if($user_permission): ?>
						<?php if(in_array('createDoctor', $user_permission) || in_array('updateDoctor', $user_permission) || in_array('viewDoctor', $user_permission) || in_array('deleteDoctor', $user_permission) ): ?>
                        <li id="Doctors">
                            <a href="<?php echo base_url('Doctors')?>"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                        </li>
                        <?php endif; ?>
                        <?php if(in_array('createPatient', $user_permission) || in_array('updatePatient', $user_permission) || in_array('viewPatient', $user_permission) || in_array('deletePatient', $user_permission) ): ?>
                        <li id="Patients">
                            <a href="<?php echo base_url('Patients')?>"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                        </li>
                        <?php endif; ?>
                        <?php if(in_array('createLabTest', $user_permission) || in_array('updateLabTest', $user_permission) || in_array('viewLabTest', $user_permission) || in_array('deleteLabTest', $user_permission) || in_array('createLabResult', $user_permission) || in_array('updateLabResult', $user_permission) || in_array('viewLabResult', $user_permission) || in_array('deleteLabResult', $user_permission) ): ?>
                        <li id="LaboratoryTest">
                            <a href="<?php echo base_url('Laboratories')?>"><i class="fa fa-thermometer-full"></i> <span>Laboratory Tests</span></a>
                        </li>
                        <?php endif; ?>
                        <?php if(in_array('createAppointment', $user_permission) || in_array('updateAppointment', $user_permission) || in_array('viewAppointment', $user_permission) || in_array('deleteAppointment', $user_permission) ): ?>
                        <li id="MedicalHistory">
                            <a href="<?php echo base_url('MedicalHistory')?>"><i class="fa fa-history"></i> <span>Medical History</span></a>
                        </li>
                        <?php endif; ?>
                        <?php if(in_array('createAppointment', $user_permission) || in_array('updateAppointment', $user_permission) || in_array('viewAppointment', $user_permission) || in_array('deleteAppointment', $user_permission) ): ?>
                        <li id="Appointments">
                            <a href="<?php echo base_url('Appointments')?>"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
                        </li>
                        <?php endif; ?>
                        <?php if(in_array('createAppointment', $user_permission) || in_array('updateAppointment', $user_permission) || in_array('viewAppointment', $user_permission) || in_array('deleteAppointment', $user_permission) ): ?>
                        <li id="Appointments">
                            <a href="<?php echo base_url('Vitals')?>"><i class="fa fa-stethoscope"></i> <span>Vital Signs</span></a>
                        </li>
                        <?php endif; ?>
                        <?php if(in_array('createWard', $user_permission) || in_array('updateWard', $user_permission) || in_array('viewWard', $user_permission) || in_array('deleteWard', $user_permission) ): ?>
                        <li id="Ward">
                            <a href="<?php echo base_url('Wards')?>"><i class="fa fa-calendar-check-o"></i> <span>Ward</span></a>
                        </li>
                        <?php endif; ?>
                        <?php if(in_array('createEmployee', $user_permission) || in_array('updateEmployee', $user_permission) || in_array('viewEmployee', $user_permission) || in_array('deleteEmployee', $user_permission) ): ?>
						<li id="Employees" >
							<a href="<?php echo base_url('Employees')?>"><i class="fa fa-user"></i> <span> Employees </span> </a>
							
						</li>
                        <?php endif; ?>
                        <?php if(in_array('createRole', $user_permission) || in_array('updateRole', $user_permission) || in_array('viewRole', $user_permission) || in_array('deleteRole', $user_permission) ): ?>						
						<li id="groups">
							<a href="<?php echo base_url('groups')?>"><i class="fa fa-book"></i> <span> Roles </span> </span></a>
							
						</li>
                        <?php endif; ?>
                        <li id="groups">
                            <a href="<?php echo base_url('Auth/logout')?>"><i class="fa fa-sign-out"></i> <span> Log Out </span> </span></a>
                            
                        </li>
                        <?php endif; ?>                        
                    </ul>
                </div>
            </div>
        </div>
