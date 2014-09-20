<?php
    namespace Application\Form;
	
	use Zend\Form\Form;
	
	class ProductForm extends Form {
		
		public function __construct($name = null)
		{
			parent::__construct('Product');
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
				),
				'options' => array(
					'label' => 'Product Name',
				),
			));
			
			$this->add(array(
				'name' => 'thumbnail',
				'required' => 'required',
				'attributes' => array(
					'type' => 'file',
				),
				'options' => array(
					'label' => 'Thumbnail',
				),
			));
			
			$this->add(array(
				'name' => 'description',
				'required' => 'required',
				'attributes' => array(
					'type' => 'text',
				),
				'options' => array(
					'label' => 'Product Description',
				),
			));
			
			$this->add(array(
				'name' => 'submit',
				'required' => 'required',
				'attributes' => array(
					'type' => 'submit',
					'label' => 'Add'
				),
			));
		}
		
	}
?>