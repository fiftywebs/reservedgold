<?php
    namespace Exchanger\Form;
	
	use Zend\Form\Form;
	
	class FormFields extends Form {
		
		public function __construct($name = null)
		{
			parent::__construct('Register');
			$this->setAttribute('method', 'post');
			
			$this->add(array(
				'name' => 'id',
				'attributes' => array(
					'type' => 'hidden',
				),
			));
			$this->add(array(
				'name' => 'name',
				'required' => 'required',
				'attributes' => array(
					'type' => 'text',
					'class' => 'form-control',
				),
				'options' => array(
					'label' => 'Full Name',
				),
			));
			$this->add(array(
				'name' => 'email',
				'required' => 'required',
				'attributes' => array(
					'type' => 'text',
					'class' => 'form-control',
				),
				'options' => array(
					'label' => 'Email',
				),
			));
			$this->add(array(
				'name' => 'password',
				'required' => 'required',
				'attributes' => array(
					'type' => 'password',
					'class' => 'form-control',
				),
				'options' => array(
					'label' => 'Password',
				),
			));
			$this->add(array(
				'name' => 'confirm_password',
				'required' => 'required',
				'attributes' => array(
					'type' => 'password',
					'class' => 'form-control',
				),
				'options' => array(
					'label' => 'Confirm Password',
				),
			));
			$this->add(array(
				'name' => 'submit',
				'attributes' => array(
					'type' => 'submit',
					'value' => 'Register',
					'class' => 'btn btn-primary',
				),
			));
		}
		
	}
?>