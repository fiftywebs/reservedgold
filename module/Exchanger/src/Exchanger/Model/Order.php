<?php
    namespace Exchanger\Model;
	
	class Order {
		
		public $id;
		public $user_id;
		public $product;
		public $quantity;
		public $status;
		public $paymentMethod;
		public $date;
		
		
		public function exchangeArray(array $data)
		{
			$this->id = (isset($data['id'])) ? $data['id'] : null;
			$this->user_id = (isset($data['user_id'])) ? $data['user_id'] : null;
			$this->product = (isset($data['product'])) ? $data['product'] : null;
			$this->quantity = (isset($data['quantity'])) ? $data['quantity'] : null;
			$this->status = (isset($data['status'])) ? $data['status'] : null;
			$this->paymentMethod = (isset($data['paymentMethod'])) ? $data['paymentMethod'] : null;
			$this->date = (isset($data['date'])) ? $data['date'] : null;
		}
		
		public function getArrayCopy()
		{
			return get_object_vars($this);
		}
	}
?>