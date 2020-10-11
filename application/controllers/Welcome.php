<?php


class Welcome extends Admin_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();

		$this->load->model('model_auth');
	}
	public function index()
	{
		$this->load->view('welcome');
	}
	public function permission()
	{
		$permission = serialize(array(
			'view','update','delete','create'
		));
		$data = array(
			'name' => 'Admin',
			'permission' => $permission,
		);
		$success = $this->model_auth->create_admin($data);
		if($success == true) {
        		echo 'success';
        	}
        	else {
        		echo 'fail';
        	}
	}
	public function photo(){
		$data = array('photo'=>$this->input->post('photo'));
		echo $this->model_auth->insert_photo($data);
	}
	public function getPhoto(){
		$echo = $this->model_auth->get_photo();
		foreach ($echo as $key => $value) {
			echo $key." <img src='".$value['photo']."''><br>";
		}
	}
	// public function do_upload()
 //        {
 //                $config['upload_path']          = base_url('assets');
 //                $config['allowed_types']        = 'gif|jpg|png';
 //                $config['max_size']             = 1000;
 //                $config['max_width']            = 1920;
 //                $config['max_height']           = 1080;

 //                $this->load->library('upload', $config);

 //                if ( ! $this->upload->do_upload('userfile'))
 //                {
 //                        $error = array('error' => $this->upload->display_errors());

 //                        $this->load->view('welcome', $error);
 //                }
 //                else
 //                {
 //                        $data = array('upload_data' => $this->upload->data());

 //                        $this->load->view('response', $data);
 //                }
 //        }
        public function uploadPic(){
        	$config = [
        		'upload_path' => './uploads',
        		'allowed_types' => 'gif|png|jpg|jpeg'
        	];
        	$this->load->library('upload',$config);
        	$this->form_validation->set_error_delimiters();
        	if($this->upload->do_upload()){
        		$data = $this->input->post();
        		$info = $this->upload->data();
        		$image_path = base_url("uploads/".$info['raw_name'].$info['file_ext']);
        		$data['photo'] = $image_path;
        		unset($data['submit']);
        		// $this->load->model('queries');
        		if($this->model_auth->insertImage($data)){
        			echo 'Image uploded succesfully';
        		}
        		else{
        			echo 'Failed';
        		}
        	}
        	else{
        		$this->index();
        	}
        }
        public function viewImages(){
        	$images = $this->model_auth->loadImage();
        	$this->load->view('viewImage',['images'=>$images]);
        }
}
// <?php echo 'data:' . $uploaded->file_type . ';base64,' . base64_encode($uploaded->image_data); ?>
?>
SELECT e.id as empid, a.roleId, e.fname, e.mname, e.dob, e.sex, e.phone, e.officeno, e.email, e.photo, e.ward_id, w.name as wardname  FROM employees as e, accounts as a, ward as w WHERE e.ward_id = w.id AND e.accountid = a.id