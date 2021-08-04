<?php

use Monolog\Logger;


return ['database' =>
    ['name' => 'proyecto',
        'username' => 'userProyecto',
        'password' => 'userProyecto',
        'connection' => 'mysql:host=dwes.local',
        'options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        ]
    ],
    'swiftmail' => [
        'smtp_server' => 'smtp.gmail.com',
        'smtp_port' => '587',
        'smtp_security' => 'tls',
        'username' => 'YOUR_USERNAME_HERE OR YOUR_EMAIL_HERE',
        'password' => 'YOUR_PASSWORD_HERE',
        'email' => 'YOUR_EMAIL_HERE',
        'name' => 'Proyecto DWES'
    ],
    'logs' => [
        'filename' => 'proyecto.log',
        'level' => Logger::WARNING
    ],
    'routes' => [
        'filename' => 'routes.php'
    ],
    'project' => [
        'namespace' => 'proyecto'
    ],
    'security' => [
        'roles' => [
            'ROLE_ADMIN' => 3,
            'ROLE_USER' => 2,
            'ROLE_ANONYMOUS' => 1
        ]
    ]
];