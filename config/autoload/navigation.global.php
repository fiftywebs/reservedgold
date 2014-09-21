<?php
return array( // ToDO make it dynamic - comes from the DB
     'navigation' => array(
         'default' => array(
             array(
                 'label' => 'Home',
                 'route' => 'home',
             ),
             array(
                 'label' => 'Register', // 'Page #1',
                 'route' => 'home', // 'page-1',
				 'action'     => 'register',
				 'controller' => 'user',
				 //'resource'	=> 'Album\Controller\Album',
				 //'privilege'	=> 'index',
                 /*
                 'pages' => array(
                     array(
                         'label' => 'Add', // 'Child #1',
                         'route' => 'album',
						 'params' => array('action' => 'add'),
						 'resource'	=> 'Album\Controller\Album',
						 'privilege'	=> 'add',
                     ),
                 ),
				  */ 
             ),
         ),		  
     ),
     'service_manager' => array(
         'factories' => array(
             'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
			 // 'secondary_navigation' => 'CsnNavigation\Navigation\Service\SecondaryNavigationFactory',
			 //'secondary_navigation' => 'Csn\Zend\Navigation\Service\SecondaryNavigationFactory',
         ),
     ),
);

/*
action	String	NULL	Action name to use when generating href to the page.
controller	String	NULL	Controller name to use when generating href to the page.
params	Array	array()	User params to use when generating href to the page.
route	String	NULL	Route name to use when generating href to the page.
routeMatch	Zend\Mvc\Router\RouteMatch	NULL	RouteInterface matches used for routing parameters and testing validity.
router	Zend\Mvc\Router\RouteStackInterface	NULL	Router for assembling URLs
*/
?>