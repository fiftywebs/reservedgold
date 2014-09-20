<?php

namespace Exchanger\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserPanelController extends AbstractActionController
{
	//public function __construct()
	//{
	//	$this->loggedIn();
	//}
    public function indexAction()
    {
    	$this->loggedIn();
    	$userDetails = $this->getServiceLocator()->get('AuthService')->getStorage()->read();
		$obj = $this->getServiceLocator()->get('AuthService')->getIdentity();
        return new ViewModel(array('userDetails' => $userDetails));
    }
	
	public function ordersAction($value='')
	{
		$sm = $this->getServiceLocator();
		$orderTable = $sm->get('OrderTable');
		return new ViewModel(array('orders' => $orderTable->fetchAll()));
	}
	
	public function logoutAction()
	{
		$this->getServiceLocator()->get('AuthService')->getStorage()->clear();
        return $this->redirect()->toRoute('application/user', array('action' => 'login'));
	}
	
	public function loggedIn()
	{
		if(!$this->getServiceLocator()->get('AuthService')->hasIdentity())
		return $this->redirect()->toRoute('application/user', array('action' => 'login'));
	}
}
