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

class AdminController extends AbstractActionController
{
    public function indexAction()
    {
    	$sm = $this->getServiceLocator();
    	//$productTable = $sm->get('ProductTable');
		$orderTable = $this->sm->get('OrderTable');
        return new ViewModel(array('orders' => $orderTable->fetchAll()));
    }
	
	public function productsAction()
	{
		$sm = $this->getServiceLocator();
		$productTable = $sm->get('ProductTable');
        return new ViewModel(array('products' => $productTable->fetchAll()));
	}
}
