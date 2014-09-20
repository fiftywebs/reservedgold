<?php
    namespace Exchanger\Controller;
	
	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\View\Model\ViewModel;
	
	class UserController extends AbstractActionController {
		
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
			if (!$this->request->isPost()) {
				return new ViewModel(array('form' => $this->getServiceLocator()->get('LoginForm')));
			}
			$this->getAuthService()->getAdapter()
										->setIdentity($this->request->getPost('email'))
										->setCredential($this->request->getPost('password'));
			$result = $this->getAuthService()->authenticate();
			if (!$result->isValid()) {
				$form = $this->getServiceLocator()->get('LoginForm')->setData($this->request->getPost());
				$view = new ViewModel(array('error' => true, 'form' => $form));
				return $view;
			}
			$this->getAuthService()->getStorage()->write(array('id' => $this->getServiceLocator()->get('UserTable')->getUserByEmail($this->request->getPost('email'))->id, 'email' => $this->request->getPost('email')));
			return $this->redirect()->toRoute('application/user-panel', array('action' => 'index'));
		}
		
		public function registerAction()
		{
			$sm = $this->getServiceLocator();
			if (!$this->request->isPost()) {
				return new ViewModel(array('form' => $sm->get('RegisterForm')));
			}
			$post = $this->request->getPost();
			$form = $sm->get('RegisterForm');
			$form->setData($post);
			if (!$form->isValid()) {
				$view = new ViewModel(array('error' => true, 'form' => $form));
				$view->setTemplate('application/user/register');
				return $view;
			}
			$this->createUser($form->getData());
			return $this->redirect()->toRoute('application/user', array('action' => 'complete'));
			
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
?>