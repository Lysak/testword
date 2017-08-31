<?php
    return array(
    	'admin/addNews' => 'admin/addNews', 

    	'admin/login' => 'admin/login',
    	'admin' => 'admin/index',

        'blog/([0-9]+)' => 'blog/view/$1',
        'blog' => 'blog/index',

        'contacts' => 'site/contact',

        'index' => 'site/index', // test

        'login' => 'auth/login',
        'logout' => 'auth/logout',
        'intropage' => 'auth/intropage',
        'register' => 'auth/register',

        '' => 'site/index',
 );