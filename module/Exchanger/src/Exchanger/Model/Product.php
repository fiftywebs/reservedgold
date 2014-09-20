<?php
    namespace Exchanger\Model;
	
	class Product {
		
		public $id;
		public $name;
		public $description;
		public $thumbnail;
		
		public function exchangeArray(array $data)
		{
			$this->id = (isset($data['id'])) ? $data['id'] : null;
			$this->name = (isset($data['name'])) ? $data['name'] : null;
			$this->description = (isset($data['description'])) ? $data['description'] : null;
			$this->thumbnail = (isset($data['thumbnail'])) ? $data['thumbnail'] : null;
		}
		
		public function getArrayCopy()
		{
			return get_object_vars($this);
		}
		
	}
?>