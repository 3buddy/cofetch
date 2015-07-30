<?php

	/**

	* Customer Controller class

	* PHP versions 5.1.4

	* @date 20-july-2015

	* @Purpose:This controller handles all the functionalities regarding user management.

	* @filesource

	* @revision

	* @version 0.0.1

	**/
	App::import('Controller', 'Customer');

	App::uses('Sanitize', 'Utility');



class CustomersController extends AppController{

    var $name       	=  "Customers";



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
					$this->redirect(array('controller'=>'Customers','action'=>'dashboard'));

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
				$this->redirect(array('controller'=>'Customers','action'=>'dashboard'));
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
						$this->redirect('/Customers/dashboard'); 
						}
						else 
						{   
						$this->redirect('/Customers/login');
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
			$this -> redirect('/Customers/login');

		} 
		
		
	  #_________________________________________________________________________#
		  /**

    * @Date: 21-july-2015

    * @Method : customer_list

    * @Purpose: This function provide the customer list

    * @Param: none

    * @Return: none 

    **/	
	  
	  
	    function customer_list()
		{
		  $users_email=$this->Session->read("email");
		  if (empty($users_email)) 
		  {
			$this->redirect(array('controller'=>'Customers','action'=>'login'));
		  }
		  else
		  {
		   $this->Session->read("SESSION_USER");
		   $this->set("title_for_layout", "Customer Listing");
		   $criteria = ""; //All Searching
		   $this->Paginator->settings = array(
		    'fields' => array(
			'Customer.id',
			'Customer.firstname',
			'Customer.lastname',
			'Customer.email',
			'Customer.contact',
			'Customer.created',
			'Customer.modified',
			),
			'conditions' => array(),
			);
		   $data = $this->Paginator->paginate('Customer',$criteria);
		   $this->set('resultData', $data);
		   }
		
		}	 
		
		
	 #_________________________________________________________________________#
	 
	 
	 
	 	
		/**

    * @Date: 21-july-2015

    * @Method : del_customer

    * @Purpose: This function delete the customer

    * @Param: none

    * @Return: none 

    **/
	          function del_customer()
			{
				$users_email=$this->Session->read("email");
				if (empty($users_email)) 
				{
				$this->redirect(array('controller'=>'Customers','action'=>'login'));
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
		           }else
				   {
			       $this->redirect('customer_list');
		           }
		           if(!empty($deleteString))
				   {
					$this->Customer->deleteAll("Customer.id in ('".$deleteString."')");

					//$this->Session->setFlash("<div class='success-message flash notice'>User(s) deleted successfully.</div>", 'layout_success');

				    $this->redirect('customer_list');

		           }

	            }
	
	        }
			
	 #_________________________________________________________________________#
	 
	 
	 
	 
	  /**

    * @Date: 21-july-2015

    * @Method : customer_edit

    * @Purpose: This function edit the customer

    * @Param: none

    * @Return: none 

    **/  
		  
	
	
	        function customer_edit($id = null) 
			{
				
			 $users_email=$this->Session->read("email");
			 if (empty($users_email)) {
				$this->redirect(array('controller'=>'Customers','action'=>'login'));
			 }
			 else
			 {
				  $this->Session->read("SESSION_USER");
				  $this->set("title_for_layout", "Edit Customer");
				  $this->set("id",$id); 
				  if($this->data)
				  {
					  $this->Customer->set($this->data['Customer']); 
					  $isValidated = $this->Customer->validates();
					  if($isValidated)
					  {
					  $saveData = $this->data['Customer'];
					  $userData = $this->Customer->save($saveData, array('validate'=>false));
	     			  //$this->uploadPic($userData['Customer']['id'],false);
					  //$this->Session->setFlash("Customer has been updated successfully.",'layout_success');
					  $this->redirect(array('action' => 'customer_list'));
					  }
		          } else if(!empty($id))
				    {
                      $this->set("id",$id); 
			          $this->data = $this->Customer->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));
			          if(!$this->data)
					  {
				      $this->redirect(array('action' => 'customer_list'));
			          }



		            }



	          }
	 
	
			}
	   #_________________________________________________________________________#
	   
	   
}