<?php
return [
    'data_types' => [
        'invokables' => [
            'rights_statement' => 'RightsStatements\DataType\RightsStatement',
        ],
    ],
    'csv_import' => [
        'data_types' => [
            'rights_statement' => [
                'label' => 'Rights Statement',
                'adapter' => 'uri',
            ],
        ],
    ],
];
