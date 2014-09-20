<?php
    namespace Exchanger\Model;
	
	class User {
		
		public $id;
		public $name;
		public $email;
		public $password;
		
		public function setPassword($p)
		{
			$this->password = md5($p);
		}
		
		public function exchangeArray(array $data)
		{
			$this->id = (isset($data['id'])) ? $data['id'] : null;
			$this->name = (isset($data['name'])) ? $data['name'] : null;
			$this->email = (isset($data['email'])) ? $data['email'] : null;
			(isset($data['password'])) ? $this->setPassword($data['password']) : null;
		}
		
		public function getArrayCopy()
		{
			return get_object_vars($this);
		}
	}
?>