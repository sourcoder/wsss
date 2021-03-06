<?php

include_once 'server.php';

$GLOBALS['RESTmap'] = [];

$GLOBALS['RESTmap']['GET'] = [
    'user' => function() {
        return [
            'name'    => 'davert',
            'email'   => 'davert@mail.ua',
            'aliases' => [
                'DavertMik',
                'davert.ua'
            ],
            'address' => [
                'city'    => 'Kyiv',
                'country' => 'Ukraine',
            ]];
    },
    'zeroes' => function() {
        return [
            'responseCode' => 0,
            'message' => 'OK',
            'data' => [
                9,
                0,
                0
            ],
        ];
    },
    'http-host' => function() {
        return 'host: "' . $_SERVER['HTTP_HOST'] . '"';
    }

];

$GLOBALS['RESTmap']['POST'] = [
    'user' => function() {
        $name = $_POST['name'];
        return ['name' => $name];
    },
    'file-upload' => function() {
        return [
            'uploaded' => isset($_FILES['file']['tmp_name']) && file_exists($_FILES['file']['tmp_name']),
        ];
    }
];

$GLOBALS['RESTmap']['PUT'] = [
    'user' => function() {
        $name = $_REQUEST['name'];
        $user = ['name' => 'davert', 'email' => 'davert@mail.ua'];
        $user['name'] = $name;
        return $user;
    }
];

$GLOBALS['RESTmap']['DELETE'] = [
    'user' => function() {
        header('error', false, 404);
    }
];

RESTServer();
