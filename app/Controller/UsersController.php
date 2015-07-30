<?php

	/**

	* User Controller class

	* PHP versions 5.1.4

	* @date 20-july-2015

	* @Purpose:This controller handles all the functionalities regarding user management.

	* @filesource

	* @revision

	* @version 0.0.1

	**/
	App::import('Controller', 'Customer');

	App::uses('Sanitize', 'Utility');



class UsersController extends AppController{

    var $name       	=  "Users";



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

    var $uses       	=  array('User','Customer','Driver','Review','Detail'); // For Default Model



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
					$this->redirect(array('controller'=>'users','action'=>'dashboard'));

				}
				 
			}
			
	 #_________________________________________________________________________#
	
	
	
	/**

    * @Date: 20-july-2015

    * @Method : dashboard

    * @Purpose: This page will redirect to home page

    * @Param: none

    * @Return: none 

    **/
	
	
		function dashboard(){
		$users_email=$this->Session->read("email");
			 if (empty($users_email)) {
				$this->redirect(array('controller'=>'users','action'=>'login'));
			 }
			 else
			 {
				if($this->Session->read("User") != ""){
					$this->redirect(array('controller'=>'users','action'=>'dashboard'));

				}
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
			$this -> redirect('/Users/login');

		} 
		
		
	  #_________________________________________________________________________#		

	  
	  
	 
		
	
	
	  
	  
	  /**

    * @Date: 21-july-2015

    * @Method : review_list

    * @Purpose: This function provide the review list

    * @Param: none

    * @Return: none 

    **/
	  
	
		    function review_list()
			{
              $users_email=$this->Session->read("email");
			  if (empty($users_email)) 
			  {
			    $this->redirect(array('controller'=>'users','action'=>'login'));
			  }
			  else
			  {
	            $this->Session->read("SESSION_USER");
				$this->set("title_for_layout", "Reviews");
				$criteria = ""; //All Searching
				$this->Paginator->settings = array(
				'fields' => array(
				'Review.id',
				'Review.customer_id',
				'Review.driver_id',
				'Review.comment',
				'Review.rating',
				'Review.approval',
				'Review.created',
				'Review.modified',
				),
				
				'conditions' => array(),
	
		        );
				$data = $this->Paginator->paginate('Review',$criteria);
				$this->set('resultData', $data);
              } 
	
	        }
			
	   #_________________________________________________________________________#
	 	
		
		
	
	 
	 
	 		
	
	
	     	/**

    * @Date: 21-july-2015

    * @Method : del_review

    * @Purpose: This function delete the review

    * @Param: none

    * @Return: none 

    **/

	
	    function del_review()
		{
			$users_email=$this->Session->read("email");
		    if (empty($users_email)) 
			{
			$this->redirect(array('controller'=>'users','action'=>'login'));
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
				$this->redirect('review_list');
				}
				if(!empty($deleteString))
				{
				$this->Review->deleteAll("Review.id in ('".$deleteString."')");

				//$this->Session->setFlash("<div class='success-message flash notice'>User(s) deleted successfully.</div>", 'layout_success');

				$this->redirect('review_list');

				}

	        }
	
	    }
	
	
	
	
	
	 #_________________________________________________________________________#
	

	      
		  
    
	
	
	
	   	/**

    * @Date: 21-july-2015

    * @Method : disable_driver

    * @Purpose: This function DISABLE the 

    * @Param: none

    * @Return: none 

    **/
	
	
	function disable_driver(){
	
        $id = $_POST["id"];
        $result=$this->Review->updateAll(array("Review.approval" =>"'0'"), array("Review.id"=>$id));
			//pr($result);die;
			$this->redirect('/Users/review_list'); 
	}
		
		
	function enable_driver(){ 
        $id = $_POST["id"];
         
		$result=$this->Review->updateAll(array("Review.approval" =>"'1'"), array("Review.id"=>$id));
         //pr($result);die;
		 $this->redirect('/Users/review_list'); 	
		}
		
					
		
	
	  
	  /**

    * @Date: 22-july-2015

    * @Method : detail_list

    * @Purpose: This function provide the detail list

    * @Param: none

    * @Return: none 

    **/
	  
	
		    function detail_list()
			{
              $users_email=$this->Session->read("email");
			  if (empty($users_email)) 
			  {
			    $this->redirect(array('controller'=>'users','action'=>'login'));
			  }
			  else
			  {
	            $this->Session->read("SESSION_USER");
				$this->set("title_for_layout", "Details");
				$criteria = ""; //All Searching
				$this->Paginator->settings = array(
				'fields' => array(
				'Detail.id',
				'Detail.customer_id',
				'Detail.driver_id',
				'Detail.to',
				'Detail.from',
				'Detail.latitude',
				'Detail.longitude',
				'Detail.distance_covered',
				'Detail.created',
				'Detail.modified',
				),
				'conditions' => array(),
	
		        );
				$data = $this->Paginator->paginate('Detail',$criteria);
				$this->set('resultData', $data);
              } 
	
	        }
			
	   #_________________________________________________________________________#
	
	
	/* * @Date: 21-july-2015

    * @Method : del_review

    * @Purpose: This function delete the review

    * @Param: none

    * @Return: none 

    **/

	
	    function del_detail()
		{
			$users_email=$this->Session->read("email");
		    if (empty($users_email)) 
			{
			$this->redirect(array('controller'=>'users','action'=>'login'));
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
				$this->redirect('detail_list');
				}
				if(!empty($deleteString))
				{
				$this->Review->deleteAll("Detail.id in ('".$deleteString."')");

				//$this->Session->setFlash("<div class='success-message flash notice'>User(s) deleted successfully.</div>", 'layout_success');

				$this->redirect('detail_list');

				}

	        }
	
	    }
		
		 /**

    * @Date: 21-july-2015

    * @Method : customer_edit

    * @Purpose: This function edit the customer

    * @Param: none

    * @Return: none 

    **/  
		  
	
	
	        function detail_edit($id = null) 
			{
				
			 $users_email=$this->Session->read("email");
			 if (empty($users_email)) {
				$this->redirect(array('controller'=>'users','action'=>'login'));
			 }
			 else
			 {
				  $this->Session->read("SESSION_USER");
				  $this->set("title_for_layout", "Edit Customer");
				  $this->set("id",$id); 
				  if($this->data)
				  {
					  $this->Detail->set($this->data['Driver']); 
					  $isValidated = $this->Detail->validates();
					  if($isValidated)
					  {
					  $saveData = $this->data['Detail'];
					  $userData = $this->Detail->save($saveData, array('validate'=>false));
	     			  //$this->uploadPic($userData['Customer']['id'],false);
					  //$this->Session->setFlash("Customer has been updated successfully.",'layout_success');
					  $this->redirect(array('action' => 'detail_list'));
					  }
		          } else if(!empty($id))
				    {
                      $this->set("id",$id); 
			          $this->data = $this->Detail->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));
			          if(!$this->data)
					  {
				      $this->redirect(array('action' => 'detail_list'));
			          }



		            }



	          }
	 
	
			}
	   #_________________________________________________________________________#
	
	
	
	}


