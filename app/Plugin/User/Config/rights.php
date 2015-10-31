<?php
$rights = array(
	'plugin' => array(
		'User' => array(
			'name' => 'User',
			'status' => 0,
			'controller' => array(
				'UserController' => array(
					'name' => 'User',
					'status' => 0,
					'action' => array(
						'login' => '*****',
						'register' => array(
							'name' => 'register',
							'status' => 0
						),
						'activate' => array(
							'name' => 'activate',
							'status' => 0
						),
						'view' => array(
							'name' => 'view',
							'status' => 0
						),
						'edit' => array(
							'name' => 'edit',
							'status' => 0
						),
						'edit_with_role' => array(
							'name' => 'edit_with_role',
							'status' => 0
						),
						'delete' => array(
							'name' => 'delete',
							'status' => 0
						),
						'index' => array(
							'name' => 'index',
							'status' => 0
						),
						'forgotPassword' => array(
							'name' => 'forgotPassword',
							'status' => 0
						),
						'myProfile' => array(
							'name' => 'myProfile',
							'status' => 0
						),
						'logout' => array(
							'name' => 'logout',
							'status' => 0
						)
					)
				),
				'UserRoleAccessController' => array(
					'name' => 'UserRoleAccess',
					'status' => 0,
					'action' => array(
						'editUsers' => array(
							'name' => 'editUsers',
							'status' => 0
						),
						'editRoles' => array(
							'name' => 'editRoles',
							'status' => 0
						)
					)
				),
				'UserRoleController' => array(
					'name' => 'UserRole',
					'status' => 0,
					'action' => array(
						'view' => array(
							'name' => 'view',
							'status' => 0
						),
						'edit' => array(
							'name' => 'edit',
							'status' => 0
						),
						'delete' => array(
							'name' => 'delete',
							'status' => 0
						),
						'index' => array(
							'name' => 'index',
							'status' => 0
						)
					)
				),
				'UserRoleRightController' => array(
					'name' => 'UserRoleRight',
					'status' => 0,
					'action' => array(
						'generate' => array(
							'name' => 'generate',
							'status' => 0
						),
						'edit' => array(
							'name' => 'edit',
							'status' => 0
						)
					)
				)
			)
		)
	),
	'controller' => array(
		'CalendarController' => array(
			'name' => 'Calendar',
			'status' => 0,
			'action' => array(
				'edit' => array(
					'name' => 'edit',
					'status' => 0
				),
				'delete' => array(
					'name' => 'delete',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				),
				'feed' => array(
					'name' => 'feed',
					'status' => 0
				)
			)
		),
		'CostingController' => array(
			'name' => 'Costing',
			'status' => 0,
			'action' => array(
				'edit' => array(
					'name' => 'edit',
					'status' => 0
				),
				'delete' => array(
					'name' => 'delete',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				),
				'getCostingRecord' => array(
					'name' => 'getCostingRecord',
					'status' => 0
				)
			)
		),
		'CustomerController' => array(
			'name' => 'Customer',
			'status' => 0,
			'action' => array(
				'edit' => array(
					'name' => 'edit',
					'status' => 0
				),
				'delete' => array(
					'name' => 'delete',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				)
			)
		),
		'DashboardController' => array(
			'name' => 'Dashboard',
			'status' => 0,
			'action' => array(
				'display' => array(
					'name' => 'display',
					'status' => 0
				)
			)
		),
		'FileController' => array(
			'name' => 'File',
			'status' => 0,
			'action' => array(
				'edit' => array(
					'name' => 'edit',
					'status' => 0
				),
				'delete' => array(
					'name' => 'delete',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				)
			)
		),
		'LeadController' => array(
			'name' => 'Lead',
			'status' => 0,
			'action' => array(
				'edit' => array(
					'name' => 'edit',
					'status' => 0
				),
				'delete' => array(
					'name' => 'delete',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				)
			)
		),
		'ProductController' => array(
			'name' => 'Product',
			'status' => 0,
			'action' => array(
				'edit' => array(
					'name' => 'edit',
					'status' => 0
				),
				'delete' => array(
					'name' => 'delete',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				),
				'view' => array(
					'name' => 'view',
					'status' => 0
				)
			)
		),
		'PurchaseOrderController' => array(
			'name' => 'PurchaseOrder',
			'status' => 0,
			'action' => array(
				'edit' => array(
					'name' => 'edit',
					'status' => 0
				),
				'delete' => array(
					'name' => 'delete',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				),
				'view' => array(
					'name' => 'view',
					'status' => 0
				)
			)
		),
		'PurchaseRequestController' => array(
			'name' => 'PurchaseRequest',
			'status' => 0,
			'action' => array(
				'edit' => array(
					'name' => 'edit',
					'status' => 0
				),
				'delete' => array(
					'name' => 'delete',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				),
				'view' => array(
					'name' => 'view',
					'status' => 0
				)
			)
		),
		'SalaryController' => array(
			'name' => 'Salary',
			'status' => 0,
			'action' => array(
				'edit' => array(
					'name' => 'edit',
					'status' => 0
				),
				'delete' => array(
					'name' => 'delete',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				)
			)
		),
		'SettingsController' => array(
			'name' => 'Settings',
			'status' => 0,
			'action' => array(
				'edit' => array(
					'name' => 'edit',
					'status' => 0
				),
				'delete' => array(
					'name' => 'delete',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				)
			)
		),
		'VendorController' => array(
			'name' => 'Vendor',
			'status' => 0,
			'action' => array(
				'edit' => array(
					'name' => 'edit',
					'status' => 0
				),
				'delete' => array(
					'name' => 'delete',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				)
			)
		),
		'WorksSheetController' => array(
			'name' => 'WorksSheet',
			'status' => 0,
			'action' => array(
				'edit' => array(
					'name' => 'edit',
					'status' => 0
				),
				'delete' => array(
					'name' => 'delete',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				),
				'report' => array(
					'name' => 'report',
					'status' => 0
				)
			)
		),
		'FacsimileMassageController' => array(
			'name' => 'FacsimileMassage',
			'status' => 0,
			'action' => array(
				'view' => array(
					'name' => 'view',
					'status' => 0
				),
				'edit' => array(
					'name' => 'edit',
					'status' => 0
				),
				'delete' => array(
					'name' => 'delete',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				),
				'report' => array(
					'name' => 'report',
					'status' => 0
				)
			)
		)
	)
);