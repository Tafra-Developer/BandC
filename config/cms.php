<?php

return [
    'modules_activation' => [
        'home'                  => false,
        'categories'            => false,
        'contacts'              => false,
        'customers'             => false,
        'developer_settings'    => false,
        'features'              => false,
        'job_type'              => false,
        'jobs'                  => false,
        'projects'              => false,
        'sliders'               => false,
        'posts'                 => false,
        'pages'                 => false,
        'products'              => true,
        'services'              => false,
        'tags'                  => false,
        'testimonials'              => false,
    ],
    'active_theme' => env('ACTIVE_THEME'),
    'viewDomain' => 'front.' . env('ACTIVE_THEME') . '.',
    'themes' => [
        'marketing' =>
        [
            'prefix' => 'marketing',
            'namespace' => 'marketing',
            'views_path' => 'marketing'
        ],
        'wow' =>
        [
            'prefix' => 'wow',
            'namespace' => 'wow',
            'views_path' => 'wow'
        ],

    ]
];
