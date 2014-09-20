<?php
    namespace Exchanger\Model;
	
	use Zend\Db\TableGateway\TableGateway;
	
	class ProductTable {
		
		protected $tableGateway;
		
		public function __construct(TableGateway $tableGateway)
		{
			$this->tableGateway = $tableGateway;
		}
		
		public function saveProduct(Product $product)
		{
			$data = array(
				'name' => $product->name,
				'thumbnail' => $product->thumbnail,
				'description' => $product->description,
			);
			
			$id = (int) $product->id;
			
			if (condition) {
				
			}
		}
		
		public function fetchAll()
		{
			return $this->tableGateway->select();
		}
		
	}
?>