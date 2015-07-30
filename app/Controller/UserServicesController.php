<?php
	/**	_@BQo-~0Ctda
	* User Controller class
	* PHP versions 5.1.4
	* @date 27-july-2015
	* @Purpose:This controller handles all the functionalities regarding user management.
	* @filesource
	* @revision
	* @version 0.0.1
	**/
	App::uses('Sanitize', 'Utility');
class UserServicesController extends AppController
	{
    var $name       	=  "Users";

   /*
    *
	* Specifies helpers classes used in the view pages
	* @access public

	*/
    
    public $helpers    	=  array();

    /**
	* Specifies components classes used
	* @access public
    */

    var $components 	=  array('RequestHandler','Email','Paginator');
    var $paginate		  =  array();
    var $uses       	=  array('User','Device','School'); // For Default Model

	#_________________________________________________________________________#

    /**
    * @Date: 27-july-2014
    * @Method : beforeFilter
    * @Purpose: This function is called before any other function.
    * @Param: none
    * @Return: none 
    **/

    function beforeFilter(){
		if(!empty($this->data) && trim($this->data['auth_key']) == API_AUTH_KEY){
			$method = $this->data['method'];
			$this->$method();
		}else{
			$result = array('status'=>'0','message'=>"Authenticated key not matched");
			echo json_encode($result);
			die;
		}
    }

	function index(){
	
	}
	 #_________________________________________________________________________#
	 
	 function signup(){
		$saveArray=$this->data;
		$this->User->set($saveArray);
		$isValidated=$this->User->validates();
		if($isValidated){
		$email_exist=$this->User->query("select * from users where email='".$saveArray['email']."'");
		//pr($email_exist);die;
		
		
		
		if(empty($email_exist )){
			
			
		
		$saveArray['password']=md5($saveArray['password']);
			$device_exist=$this->Device->query("insert into devices (device_id,device_token) VALUES ('".$saveArray['device_id']."' , '".$saveArray['device_token']."')");
			
			$savedata=$this->User->save($saveArray);
			
			$userId=$savedata['User']['id'];
			
				if($_FILES){
					
					
					$this->uploadPic($userId);
				} else{
					
					$this->User->saveField('image',"no image");
				} 
			$result=array('status'=>'1','result'=>'Signup Successfully','User Id'=>$userId);
			
		
		}else{
		$result=array('status'=>'0','message'=>'Email already exist');
		}
		}else{
		$erros=$this->errorValidation('User');
		$result=array('status'=>'0','message'=>$erros);
		}
		echo json_encode($result);
		die;
	}
	
       
	 /**

    * @Date: 27-july-2015

    * @Method : uploadPic

    * @Purpose: This function is used to upload pic

    * @Param: $id,$destination,$file

    * @Return: none

    **/

	function uploadPic($id = null){
	
	
		if (!empty($_FILES)) {
           $file = $_FILES['profile_image'];
		    $filen = $_FILES['profile_image']['name'];//name of the image..
			//pr($file);die;
			
			if($file['size']!=0){
			$destination = realpath('../../app/webroot/img/profile_pic'). DS;					
			
			$ext = $this->Common->file_extension($file['name']);

			$filename = $id.'_'.time().$filen;
			
			$size=$file['size'];

			if($size>0){

				$files = $this->Common->get_files($destination,"/^".$id."_/i");
              
				if(preg_match("/gif|jpg|jpeg|png/i", $ext) > 0){

					$result = $this->Upload->upload($file, $destination, $filename, array('type' => 'resize','size' =>'190'));
					
					$path=BASE_URL."img/profile_pic/".$filename;
					//pr($path);die;
					$this->User->saveField('profile_image',$path);

				}

			}
			}

		}
	}
	 
	 
	 
	 
	 
    #_________________________________________________________________________#

		 /**

    * @Date: 28-july-2015

    * @Method : signin

    * @Purpose: This function is used to signin

    * @Param: $id,$destination,$file

    * @Return: none

    **/
		
		function signin(){
		$saveArray=$this->data;
		if(!empty($saveArray['email']) && !empty($saveArray['password']) && !empty($saveArray['device_id']) && !empty($saveArray['device_token'])){
			$password=md5($saveArray['password']);
			//$condition="Device.device_id='".$saveArray['device_id']."' AND Device.device_token='".$saveArray['device_token']."' ";
			$device_exist=$this->Device->query("select * from devices where device_id='".$saveArray['device_id']."' AND device_token='".$saveArray['device_token']."'");
			//pr($device_exist);die;
			if($device_exist){
			$userExist=$this->User->find('first',array('conditions'=>array("User.email='".$saveArray['email']."' AND User.password='".$password."'")));
			//pr($userExist);die;
			if($userExist){ 
				$result=array('status'=>'1','data'=> $userExist['User']);
			}
			
			else{
			$result=array('status'=>'0','message'=>'Username or Password is incorrect');
			}}else{
				$result=array('status'=>'0','message'=>'device id and device token does not exist');
			}
		}else{
		$result=array('status'=>'0','message'=>'Please fill all fields');
		}
		echo json_encode($result);
		die;
	} 
	
	
/*
	
    * @Date: 28-july-2015

    * @Method : RandomString

    * @Purpose: generate randomstring...

    * @Param:none

    * @Return: none

   */
	#_________________________________________________________________________#
	
	function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
     $randstring = $randstring.$characters[rand(0, strlen($characters))];
    }
    return $randstring;
} 

     #_________________________________________________________________________#

	/**

    * @Date: 28-july-2015

    * @Method : forgot_password

    * @Purpose: This function is used send mail to user

    * @Param: $id

    * @Return: none

    **/


   function forgot_password(){
	$saveArray=$this->data;
	
	$check_email=$this->User->find('first',array('conditions'=>array('User.email'=>$saveArray['email'])));
       //pr($check_email);die;
       if(!empty($check_email)){
       	$password =$this->RandomString();
	
	$Email = new CakeEmail();
	$Email->from(array('info@cofetch.com' => 'http://cofetch/'));
	//pr($Email);die;
	$Email->to($saveArray['email']);
	$Email->subject('Forgot Password');
	$Email->send('your new password is '.$password);
	
      
        $get_password['id']=$check_email['User']['id'];
        $get_password['password']=md5($password);
       // $get_password['password']=$check_email['User']['password'];
        $update_password=$this->User->save($get_password);
	 $result = array('status'=>'1','message'=>'Reset password link sent');
	 }else{
	  $result = array('status'=>'0','message'=>"Email id doesn't exist");
	 }
	  echo json_encode($result);
		die;
	} 
	
	
	#_________________________________________________________________________#
	/**

    * @Date: 28-july-2015

    * @Method : update_device

    * @Purpose: This function is used update the devices

    * @Param: $id

    * @Return: none

    **/
	
         function update_device(){
			 //echo "hii";die;
			 $saveArray=$this->data;
			 if(!empty($saveArray['id']) && !empty($saveArray['device_id']) && !empty($saveArray['device_token'])){
		$device_exist=$this->Device->find('first',array('conditions'=>array('Device.id'=>$saveArray['id'])));
		//pr($device_exist);die;
			 if(!empty($device_exist)){
				 $id=$saveArray['id'];
				$device_id=$saveArray['device_id'];
				$device_token=$saveArray['device_token'];
				
				$query=$this->Device->updateAll(array('device_id'=>"'$device_id'",'device_token'=>"'$device_token'"),array('id'=>$id));
				
				  if($query){
				  $result = array('status'=>'1','message'=>'successfully updated device');
			 }
			 }
			 else{
				  $result = array('status'=>'0','message'=>'id does not exist');
			 }}
			 else{
				 $result = array('status'=>'0','message'=>'plz fill all the field');
			 }
			 
			  echo json_encode($result);
		die;
		 }
	
	#_________________________________________________________________________#
	
	
	/**

    * @Date: 28-july-2015

    * @Method : update_device

    * @Purpose: This function is used update the devices

    * @Param: $id

    * @Return: none

    **/
	
	function school_list(){
		
		$school_list=$this->School->find("all");
		if(!empty($school_list)){
			$record=array();
	   foreach($school_list as $value){
       // pr($all_services);
	    $record[]=$value['School']['id'];
	    $record[]=$value['School']['name'];
			$result=array('status'=>'1','message'=>'school list','data'=>$record);
			
		}}
		else{
			$result=array('status'=>'0','message'=>'empty  list');
		}
		
			  echo json_encode($result);
		die;
	}
	
	
	}
	
	 
	 
	