<?php
    namespace Exchanger\Model;
	
	use Zend\Db\TableGateway\TableGateway;
	
	class OrderTable {
		
		protected $tableGateway;
		
		public function __construct(TableGateway $tableGateway)
		{
			$this->tableGateway = $tableGateway;
		}
		
		public function saveOrder(Order $order)
		{
			$data = array(
				'user_id' => $order->user_id,
				'product' => $order->product,
				'quantity' => $order->quantity,
				'status' => $order->status,
				'paymentMethod' => $order->paymentMethod,
				'date' => $order->date,
			);
			
			$id = (int) $order->id;
			
			if ($id == 0) {
				$this->tableGateway->insert($data);
			} else {
				if ($this->getUser($id)) {
					$this->tableGateway->update($data, array('id' => $id));
				} else {
					throw new \Exception("User does not exist!");
				}
			}
		}
		
		public function getOrderDetails($id)
		{
			$rowset = $this->tableGateway->select(array('id' => $id));
			$row = $rowset->current();
			if (!$row) {
				throw new \Exception("Could not find row $id");
			}
			return $row;
		}
		
		public function fetchAll()
		{
			return $this->tableGateway->select();
		}
		
		public function getOrdersByUserId($id)
		{
			$row = $this->tableGateway->select(array('id' => $id))->current();
			if (!$row) {
				throw new \Exception("No Orders Found");
			}
			return $row;
		}
		
		public function deleteOrder($id)
		{
			return $this->tableGateway->delete(array('id' => $id));
		}
	}
?>