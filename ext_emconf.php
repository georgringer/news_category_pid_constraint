<?php

$EM_CONF['news_category_pid_constraint'] = [
    'title' => 'News pid check',
    'description' => 'Check if record is allowed on current page by comparing current page to category category',
    'category' => 'fe',
    'author' => 'Georg Ringer',
    'author_email' => 'mail@ringer.it',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.13-11.9.99',
            'news' => '8.3.0-9.99.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
