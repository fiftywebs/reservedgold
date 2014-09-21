<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Exchanger\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$productTable = $this->getServiceLocator()->get('ProductTable');
        return new ViewModel(array('products' => $productTable->fetchAll()));
    }
	
	protected $authservice;
		
		public function getAuthService()
		{
			if (!$this->authservice) {
				$this->authservice = $this->getServiceLocator()->get('AuthService');
			}
			return $this->authservice;
		}
		
		public function loginAction()
		{
			$form = $this->getServiceLocator()->get('Form');
			$form->get('submit')->setAttribute('value', 'Login');
			if (!$this->request->isPost() || $this->request->getPost('email') == null) {
				return new ViewModel(array('form' => $form));
			}
			$this->getAuthService()->getAdapter()
										->setIdentity($this->request->getPost('email'))
										->setCredential($this->request->getPost('password'));
			$result = $this->getAuthService()->authenticate();
			if (!$result->isValid()) {
				$form = $this->getServiceLocator()->get('Form')->setData($this->request->getPost());
				$view = new ViewModel(array('error' => true, 'form' => $form));
				return $view;
			}
			$this->getAuthService()->getStorage()->write(array('id' => $this->getServiceLocator()->get('UserTable')->getUserByEmail($this->request->getPost('email'))->id, 'email' => $this->request->getPost('email')));
			return $this->redirect()->toRoute('user-panel', array('action' => 'index'));
		}
		
		public function registerAction()
		{
			$sm = $this->getServiceLocator();
			if (!$this->request->isPost()) {
				return new ViewModel(array('form' => $sm->get('Form')));
			}
			$post = $this->request->getPost();
			$form = $sm->get('Form');
			$form->setData($post);
			if (!$form->isValid()) {
				$view = new ViewModel(array('error' => true, 'form' => $form));
				$view->setTemplate('exchanger/index/register');
				return $view;
			}
			$this->createUser($form->getData());
			return $this->redirect()->toRoute('home', array('action' => 'complete'));
			
		}
		
		public function createUser(array $data)
		{
			$sm = $this->getServiceLocator();
			$userTable = $sm->get('UserTable');
			$user = $sm->get('User');
			$user->exchangeArray($data);
			$userTable->saveUser($user);
		}
		
		public function completeAction()
		{
			return new ViewModel();
		}
}
