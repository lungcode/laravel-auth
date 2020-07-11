<?php 
	return [
		[
			'label' => 'Category',
			'route' => 'admin.category.index',
			'items' => [
				[
					'label' => 'List Category',
					'route' => 'admin.category.index'
				],
				[
					'label' => 'Add Category',
					'route' => 'admin.category.create'
				],
			]
		],
		[
			'label' => 'Users',
			'route' => 'admin.user.index',
			'items' => [
				[
					'label' => 'List Users',
					'route' => 'admin.user.index'
				],
				[
					'label' => 'Add Users',
					'route' => 'admin.user.create'
				],
			]
		],
		[
			'label' => 'Post',
			'route' => 'admin.post.index',
			'items' => [
				[
					'label' => 'List Post',
					'route' => 'admin.post.index'
				],
				[
					'label' => 'Add Post',
					'route' => 'admin.post.create'
				],
			]
		],
		[
			'label' => 'Roles',
			'route' => 'admin.role.index',
			'items' => [
				[
					'label' => 'List Roles',
					'route' => 'admin.role.index'
				],
				[
					'label' => 'Add Roles',
					'route' => 'admin.role.create'
				],
			]
		],
	];
?>