<?php

	/**

	* Drivers Controller class

	* PHP versions 5.1.4

	* @date 20-july-2015

	* @Purpose:This controller handles all the functionalities regarding user management.

	* @filesource

	* @revision

	* @version 0.0.1

	**/
	App::import('Controller', 'Driver');

	App::uses('Sanitize', 'Utility');



class DriversController extends AppController{

    var $name       	=  "Drivers";



   /*

    *

	* Specifies helpers classes used in the view pages

	* @access public

	*/

    

    public $helpers    	=  array('Html', 'Form', 'Session','Paginator');



    /**

	* Specifies components classes used

	* @access public

    */



    var $components 	=  array('RequestHandler','Session','Email','Paginator');

    var $paginate		  =  array();

    var $uses       	=  array('User','Customer','Driver','Review'); // For Default Model



	/******************************* START FUNCTIONS **************************/







	#_________________________________________________________________________#



    /**

    * @Date: 20-july-2015

    * @Method : beforeFilter

    * @Purpose: This function is called before any other function.

    * @Param: none

    * @Return: none 

    **/



    function beforeFilter(){

		
		

    }



    #_________________________________________________________________________#



    /**

    * @Date: 20-july-2015

    * @Method : index

    * @Purpose: This page will render user page

    * @Param: none

    * @Return: none 

    **/



			function index() 
			{
				if($this->Session->read("SESSION_USER") != "")
				{
					$this->redirect(array('controller'=>'Drivers','action'=>'dashboard'));

				}
				 
			}
			
	 #_________________________________________________________________________#
	
	
	
	
	
	
	 /**

    * @Date: 21-july-2015

    * @Method : login

    * @Purpose: This page will render login page

    * @Param: none

    * @Return: none 

    **/
	 
	 
			function login()
			{
			    if($this->Session->read("SESSION_USER") != "")
				{
				$this->redirect(array('controller'=>'Users','action'=>'dashboard'));
				}
				else
				{
					if($this->data)
				    {
						$isValidated = $this->User->validates();
						if($isValidated)
						{
						$email    = ($this->data['User']['email']);
						$password    =md5($this->data['User']['password']);
						$condition = "email='".$email."' AND password='".$password."'";
						$results = $this->User->find('first', array("conditions" => $condition, "fields" => array("id","email","password")));
						}
						if ($results && $results['User']['password'] == md5($this->data['User']['password']))
						{
						$this->Session->write('email', $this->data['User']['email']); 
						$this->redirect('/Users/dashboard'); 
						}
						else 
						{   
						$this->redirect('/Users/login');
						}			
				    } 
			    }
			}
			
			
	  #_________________________________________________________________________#	
	

     
	 /**

    * @Date: 21-july-2015

    * @Method : logout

    * @Purpose: This function is used to destroy User session.

    * @Param: none

    * @Return: none 

    **/	
			
		function logout()
		{
			if ($this->Session->valid('User')) //Checks if there is a session active
			{
			$this -> Session -> delete('User'); //if there is, destroy it
			$this -> Session -> destroy('User');
			}
			$this -> redirect('/Drivers/login');

		} 
		
		
	  #_________________________________________________________________________#
	  /**

    * @Date: 21-july-2015

    * @Method : driver_list

    * @Purpose: This function provide the driver list

    * @Param: none

    * @Return: none 

    **/
	
	    function driver_list()
		{
		  $users_email=$this->Session->read("email");
		  if (empty($users_email)) 
		  {
			$this->redirect(array('controller'=>'Drivers','action'=>'login'));
		  }
		  else
		  {
		   $this->Session->read("SESSION_USER");
		   $this->set("title_for_layout", "Customer Listing");
		   $criteria = ""; //All Searching
		   $this->Paginator->settings = array(
		   'fields' => array(
			'Driver.id',
			'Driver.firstname',
			'Driver.lastname',
			'Driver.email',
			'Driver.contact',
			'Driver.created',
			'Driver.modified',
			),
			'conditions' => array(),
			);
			  $data = $this->Paginator->paginate('Driver',$criteria);
			  $this->set('resultData', $data);
		   }
		
		}	 
		
		
	  #_________________________________________________________________________# 
		
		

	 
	 
	 
	 	/**

    * @Date: 21-july-2015

    * @Method : del_driver

    * @Purpose: This function delete the driver

    * @Param: none

    * @Return: none 

    **/
	 
	        function del_driver()
		{
			$users_email=$this->Session->read("email");
		    if (empty($users_email)) 
			{
			$this->redirect(array('controller'=>'Drivers','action'=>'login'));
		    }
	        else
	        {
				if(isset($this->params['form']['IDs']))
				{
				$deleteString = implode("','",$this->params['form']['IDs']);
				}
				elseif(isset($this->params['pass'][0]) && $this->params['pass'][0] != ADMIN_ID)
				{
				$deleteString = $this->params['pass'][0];
				}
				else
				{
				$this->redirect('driver_list');
				}
				if(!empty($deleteString))
				{
				$this->Driver->deleteAll("Driver.id in ('".$deleteString."')");

				//$this->Session->setFlash("<div class='success-message flash notice'>User(s) deleted successfully.</div>", 'layout_success');

				$this->redirect('driver_list');

				}

	        }
	
	    }

       #_________________________________________________________________________#
	 
	 
	 
	 
	    /**

    * @Date: 21-july-2015

    * @Method : driver_edit

    * @Purpose: This function edit the driver

    * @Param: none

    * @Return: none 

    **/  
		  
	
	
	        function driver_edit($id = null) 
			{ 
			$users_email=$this->Session->read("email");
		    if (empty($users_email)) 
			{
			$this->redirect(array('controller'=>'Drivers','action'=>'login'));
		    }
	        else
	        {
				  $this->set("title_for_layout", "Edit Driver");
				  $this->set("id",$id); 
				  if($this->data)
				  {
					  $this->Driver->set($this->data['Driver']); 
					  $isValidated = $this->Driver->validates();
					  if($isValidated)
					  {
					  $saveData = $this->data['Driver'];
					  $userData = $this->Driver->save($saveData, array('validate'=>false));
					  //$this->uploadPic($userData['Driver']['id'],false);
					  //$this->Session->setFlash("Driver has been updated successfully.",'layout_success');
					  $this->redirect(array('action' => 'driver_list'));
					  }
		          } else if(!empty($id))
				    {
                      $this->set("id",$id); 
			          $this->data = $this->Driver->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));
			          if(!$this->data)
					  {
				      $this->redirect(array('action' => 'driver_list'));
			          }



		            }



	        }
			}
	
	
	   #_________________________________________________________________________#
	   
	   
}