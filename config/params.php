<?php

return [
    'workman' => [
        'register' => [
            'address' => '127.0.0.1:1238',
        ],
        'gateway' => [
            'name' => 'jyeduGateway',
            'port' => 7272,
            'count' => 1,
            'internalStartPort' => 4000
        ],
        'worker' => [
            'name' => 'jyeduWork',
            'count' => 1
        ],
        'globaldata' => [
            //'127.0.0.1:2207'
        ]
    ],
    'log4' => [
        'rootLogger' => [
            'appenders' => ['default']
        ],
        'appenders' => [
            'default' => [
                'class' => 'LoggerAppenderDailyFile',
                'layout' => [
                    'class' => 'LoggerLayoutPattern',
                    'conversionPattern' => '%date %logger %msg%newline',
                ],
                'params' => [
                    'file' => 'runtime/logs/business%s.log',
                    'append' => true
                ]
            ]
        ]
    ]
];