<?php
$rights = array(
	'plugin' => array(
		'File' => array(
			'name' => 'File',
			'status' => 0,
			'controller' => array(
				'FileController' => array(
					'name' => 'File',
					'status' => 0,
					'action' => array(
						'choose_file_url' => array(
							'name' => 'choose_file_url',
							'status' => 0
						),
						'choose_files' => array(
							'name' => 'choose_files',
							'status' => 0
						),
						'edit_model_info' => array(
							'name' => 'edit_model_info',
							'status' => 0
						),
						'edit_file_model_ajax' => array(
							'name' => 'edit_file_model_ajax',
							'status' => 0
						),
						'manage' => array(
							'name' => 'manage',
							'status' => 0
						),
						'upload' => array(
							'name' => 'upload',
							'status' => 0
						),
						'ajax_upload' => array(
							'name' => 'ajax_upload',
							'status' => 0
						),
						'update' => array(
							'name' => 'update',
							'status' => 0
						),
						'destroy' => array(
							'name' => 'destroy',
							'status' => 0
						),
						'update_file_model' => array(
							'name' => 'update_file_model',
							'status' => 0
						),
						'delete_file_model' => array(
							'name' => 'delete_file_model',
							'status' => 0
						),
						'listing' => array(
							'name' => 'listing',
							'status' => 0
						),
						'addDir' => array(
							'name' => 'addDir',
							'status' => 0
						),
						'editDir' => array(
							'name' => 'editDir',
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
						'delete' => array(
							'name' => 'delete',
							'status' => 0
						),
						'search' => array(
							'name' => 'search',
							'status' => 0
						)
					)
				),
			)
		),
		'FileManager' => array(
			'name' => 'FileManager',
			'status' => 0,
			'controller' => array(
				'FilesController' => array(
					'name' => 'Files',
					'status' => 0,
					'action' => array(
						'listing' => array(
							'name' => 'listing',
							'status' => 0
						),
						'upload' => array(
							'name' => 'upload',
							'status' => 0
						),
						'destroy' => array(
							'name' => 'destroy',
							'status' => 0
						),
						'filter_by_filename' => array(
							'name' => 'filter_by_filename',
							'status' => 0
						),
						'link' => array(
							'name' => 'link',
							'status' => 0
						)
					)
				),
				'UploadsController' => array(
					'name' => 'Uploads',
					'status' => 0,
					'action' => array(
						'upload' => array(
							'name' => 'upload',
							'status' => 0
						),
						'delete' => array(
							'name' => 'delete',
							'status' => 0
						)
					)
				)
			)
		),
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
						'forgotPassword' => array(
							'name' => 'forgotPassword',
							'status' => 0
						),
						'activate' => array(
							'name' => 'activate',
							'status' => 0
						),
						'loginViaFacebook' => array(
							'name' => 'loginViaFacebook',
							'status' => 0
						),
						'loginViaTwitter' => array(
							'name' => 'loginViaTwitter',
							'status' => 0
						),
						'loginViaGoogle' => array(
							'name' => 'loginViaGoogle',
							'status' => 0
						),
						'logout' => array(
							'name' => 'logout',
							'status' => 0
						),
						'updateProfile' => array(
							'name' => 'updateProfile',
							'status' => 0
						)
					)
				),
				'UserAdminController' => array(
					'name' => 'UserAdmin',
					'status' => 0,
					'action' => array(
						'login' => '*****',
						'index' => array(
							'name' => 'index',
							'status' => 0
						),
						'logout' => array(
							'name' => 'logout',
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
						'delete' => array(
							'name' => 'delete',
							'status' => 0
						),
						'search' => array(
							'name' => 'search',
							'status' => 0
						)
					)
				),
				'UserController' => array(
					'name' => 'User',
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
						'search' => array(
							'name' => 'search',
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
						'index' => array(
							'name' => 'index',
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
						'delete' => array(
							'name' => 'delete',
							'status' => 0
						),
						'search' => array(
							'name' => 'search',
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
		'DashboardController' => array(
			'name' => 'Dashboard',
			'status' => 0,
			'action' => array(
				'display' => array(
					'name' => 'display',
					'status' => 0
				),
				'index' => array(
					'name' => 'index',
					'status' => 0
				)
			)
		),
		'UsersController' => array(
			'name' => 'Users',
			'status' => 0,
			'action' => array(
				'login' => '*****',
				'index' => array(
					'name' => 'index',
					'status' => 0
				),
				'logout' => array(
					'name' => 'logout',
					'status' => 0
				)
			)
		)
	)
);