<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Exchanger\Controller\Index' => 'Exchanger\Controller\IndexController',
            'Exchanger\Controller\Admin' => 'Exchanger\Controller\AdminController',
            'Exchanger\Controller\User' => 'Exchanger\Controller\UserController',
            'Exchanger\Controller\UserPanel' => 'Exchanger\Controller\UserPanelController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type'    => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/[:action[/:id]]',
                    'constraints' => array(
                                //'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]*',
                            ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Exchanger\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Exchanger' => __DIR__ . '/../view',
        ),
    ),
);
