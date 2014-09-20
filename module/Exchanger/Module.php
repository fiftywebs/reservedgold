<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Exchanger;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Exchanger\Model\Product;
use Exchanger\Model\ProductTable;

use Exchanger\Model\User;
use Exchanger\Model\UserTable;
use Exchanger\Model\Order;
use Exchanger\Model\OrderTable;

use Exchanger\Form\RegisterForm;
use Exchanger\Form\RegisterFilter;

use Exchanger\Form\LoginForm;
use Exchanger\Form\LoginFilter;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
	
	public function getServiceConfig()
	{
		return array(
			'abstract_factories' => array(),
			'aliases' => array(),
			'factories' => array(
				'ProductTable' => function($sm) {
					return new ProductTable($sm->get('ProductTableGateway'));
				},
				'ProductTableGateway' => function($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Product());
					return new TableGateway('products', $dbAdapter, null, $resultSetPrototype);
				},
				'Product' => function($sm) {
					return new Product();
				},
				'UserTable' => function($sm) {
					return new UserTable($sm->get('UserTableGateway'));
				},
				'UserTableGateway' => function($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new User());
					return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
				},
				'User' => function($sm) {
					return new User();
				},
				'OrderTable' => function($sm) {
					return new OrderTable($sm->get('OrderTableGateway'));
				},
				'OrderTableGateway' => function($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Order());
					return new TableGateway('orders', $dbAdapter, null, $resultSetPrototype);
				},
				'Order' => function($sm) {
					return new Order();
				},
				'Form' => function($sm) {
					$form = new RegisterForm();
					$form->setInputFilter($sm->get('RegisterFilter'));
					return $form;
				},
				'FormFilter' => function($sm) {
					return new RegisterFilter();
				},
				'AuthService' => function($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter ,'users', 'email', 'password', 'MD5(?)');
					$authservice = new AuthenticationService();
					return $authservice->setAdapter($dbTableAuthAdapter);
				},
			),
			'invokables' => array(),
			'services' => array(),
			'shared' => array(),
		);
	}
}
