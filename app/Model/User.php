<?php

/**
* User Model class
*/
App::uses('AuthComponent', 'Controller/Component');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('AppModel', 'Model');
class User extends AppModel {
public $session_id;
    var $name = 'User';
	
    public $validate = array(
			/*'user_name' => array(
			   'ruleName' => array(
				'rule' => 'notEmpty',
				'message' => "Enter user name."
				),
				'ruleName2' => array(
				'rule' => 'isUnique',
				'message' => "user name already exists."
				)
            ),*/
			
			'email' => array(
			   'ruleName' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Email Id"
				),
				'ruleName2' => array(
				'rule' => 'isUnique',
				'message' => "Email Id already exists."
				),
            ),
			'email' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => "Enter Your Email.",
					'last' => true
				),
				'ruleName2' => array(
					'rule' => array('email'),
					'message' => "Enter Valid Email Address."
				),
				'isUnique' => array(
					'rule' => 'isUnique',
					'message' => "Email Address Already Exists."
				)
            ),
				
				
			'old_password' => array(
				'ruleName' => array(
				'rule' => 'notEmpty',
				'message' => "Enter old password."
				),
				'ruleName2' => array(
				'rule' => array('oldPassword'),
				'message' => "Old passwords do not match."
				)
            ),
			
			
			/* 'password' => array(

				'rule' => 'notEmpty',

				'message' => "Enter your password.",
				//'allowEmpty' => true

			), */

			'confirm_password' => array(
				'ruleName' => array(
				'rule' => 'notEmpty',
				'message' => "Enter confirm password."
				),
				'ruleName2' => array(
				'rule' => array('matchPasswords','password'),
				'message' => "Passwords do not match."
				)
            ),
			
			'phone' => array(
				'ruleName' => array(
				'rule' => 'notEmpty',
				'message' => "Enter phone number.",
				'last' => true
				),
				'ruleName2' => array(
				'rule' => 'isUnique',
				'message' => "Phone number already exists."
				)
            ),
			
			 'country_code' => array(
				'rule' => 'notEmpty',
				'message' => "Enter country code."
			), 
			/*'Username' => array(
				'rule' => 'notEmpty',
				'message' => "Enter username."
			),*/
			 'Email' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Email Id."
			)  
			
    );
	
    /**
    * @Date: 14-Aug-2010
    * @Method : matchPasswords
    * @Purpose: Check if password entered by User is equal to confirm password
    * @Param: $field, $compare_field
    * @Return: boolean
    **/
	function matchPasswords($field = array(),$compare_field = null) {
        foreach($field as $key => $value){
        $v1 = trim($value);
		$v2 = trim($this->data[$this->name][ $compare_field ]);
        if($v1 != "" && $v2 !="" && $v1 != $v2){
            return false; 
        }
         return true;
    }
   }
    function oldPassword($field = array()) {
  // pr($field ); die;
         foreach($field as $key => $value){
        $v1 = trim($value);	
        $v1 = md5($v1);		
		$v2=$this->find('list',array("conditions" => array('id'=> $this->session_id),'fields'=>array('password')));
		if($v1 != $v2[$this->session_id]){
            return false; 
        }
         return true;
    } 
	
	
	
    
   }
}
 
 
/* class User extends AppModel {
     
    public $avatarUploadDir = 'img/avatars';
     
    public $validate = array(
        'user_name' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required',
                'allowEmpty' => false
            ),
            /* 'between' => array( 
                'rule' => array('between', 5, 15), 
                'required' => true, 
                'message' => 'Usernames must be between 5 to 15 characters'
            ), */
            /*  'unique' => array(
                'rule'    => array('isUniqueUsername'),
                'message' => 'This username is already in use'
            ), */
            /* 'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'Username can only be letters, numbers and underscores'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            ), */
            /* 'min_length' => array(
                'rule' => array('minLength', '6'),  
                'message' => 'Password must have a mimimum of 6 characters'
            ) */
       /*  ),
         
        'password_confirm' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please confirm your password'
            ),
             'equaltofield' => array(
                'rule' => array('equaltofield','password'),
                'message' => 'Both passwords must match.'
            )
        ), */
         
        /* 'email' => array(
            'required' => array(
                'rule' => array('email', true),    
                'message' => 'Please provide a valid email address.'   
            ), */
             /* 'unique' => array(
                'rule'    => array('isUniqueEmail'),
                'message' => 'This email is already in use',
            ), */
   /*          'between' => array( 
                'rule' => array('between', 6, 60), 
                'message' => 'Usernames must be between 6 to 60 characters'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('king', 'queen', 'bishop', 'rook', 'knight', 'pawn')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        ),
         
         
        'password_update' => array(
            'min_length' => array(
                'rule' => array('minLength', '6'),   
                'message' => 'Password must have a mimimum of 6 characters',
                'allowEmpty' => true,
                'required' => false
            )
        ),
		
        'password_confirm_update' => array(
             'equaltofield' => array(
                'rule' => array('equaltofield','password_update'),
                'message' => 'Both passwords must match.',
                'required' => false,
            )
        )
 
         
    ); */
     
        /**
     * Before isUniqueUsername
     * @param array $options
     * @return boolean
     */
    /* function isUniqueUser_name($check) {
 
        $user_name = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id',
                    'User.user_name'
                ),
                'conditions' => array(
                    'User.user_name' => $check['user_name']
                )
            )
        );
 
        
    } */
 
    /**
     * Before isUniqueEmail
     * @param array $options
     * @return boolean
     */
   /*  function isUniqueEmail($check) {
 
        $email = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id'
                ),
                'conditions' => array(
                    'User.email' => $check['email']
                )
            )
        );
 
        if(!empty($email)){
            if($this->data[$this->alias]['id'] == $email['User']['id']){
                return true; 
            }else{
                return false; 
            }
        }else{
            return true; 
        }
    }
     
    public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    } */
	
	/* public function equaltofield($check,$otherfield) 
    { 
        //get name of field 
        $fname = ''; 
        foreach ($check as $key => $value){ 
            $fname = $key; 
            break; 
        } 
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname]; 
    } */ 
	/**
	 * Before Save
	 * @param array $options
	 * @return boolean
	 */
/* 	public function beforeSave($options = array()) {
if (!parent::beforeSave($options)) {
return false;
}
if (isset($this->data[$this->alias]['password'])) {
$hasher = new SimplePasswordHasher();
$this->data[$this->alias]['password'] = $hasher->hash($this->data[$this->alias]['password']);
}
return true;
} */
		
		
	
 
?>