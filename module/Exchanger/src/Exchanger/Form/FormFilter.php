<?php
    namespace Exchanger\Form;
	
	use Zend\InputFilter\InputFilter;
	
	class FormFilter extends InputFilter {
		
		public function __construct()
		{
			$this->add(array(
				'name' => 'name',
				'required' => true,
				'filters' => array(
					array(
						'name' => 'StripTags',
					),
				),
			));
			$this->add(array(
				'name' => 'email',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'EmailAddress',
						'options' => array(
							'domain' => true,
						),
					),
				),
			));
			$this->add(array(
				'name' => 'password',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'StringLength',
						'options' => array(
							'min' => 6
						),
					),
				),
			));
			$this->add(array(
				'name' => 'confirm_password',
				'required' => true,
				'validators' => array(
					array(
						'name' => 'Identical',
						'options' => array(
							'token' => 'password',
						),
					),
				),
			));
		}
		
	}
?>