<?php

/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) baserCMS Users Community <https://basercms.net/community/>
 *
 * @copyright       Copyright (c) baserCMS Users Community
 * @link            https://basercms.net baserCMS Project
 * @package         Mail.Config
 * @since           baserCMS v 0.1.0
 * @license         https://basercms.net/license/index.html
 */

// TODO ucmitz 未移行のため暫定措置
return [];

/**
 * システムナビ
 */
$config['BcApp.adminNavigation'] = [
    'Plugins' => [
        'menus' => [
            'MailConfigs' => ['title' => 'メール基本設定', 'url' => ['admin' => true, 'plugin' => 'mail', 'controller' => 'mail_configs', 'action' => 'form']],
        ]
    ]
];
/* @var MailContent $MailContent */
$MailContent = ClassRegistry::init('BcMail.MailContent');
$mailContents = $MailContent->find('all', [
    'conditions' => [
        $MailContent->Content->getConditionAllowPublish()
    ],
    'recursive' => 0,
    'order' => $MailContent->id,
    'cache' => false,
]);
foreach ($mailContents as $mailContent) {
    $mail = $mailContent['MailContent'];
    $content = $mailContent['Content'];
    $config['BcApp.adminNavigation.Contents.' . 'MailContent' . $mail['id']] = [
        'siteId' => $content['site_id'],
        'title' => $content['title'],
        'type' => 'mail-content',
        'icon' => 'bca-icon--mail',
        'menus' => [
            'MailMessages' . $mail['id'] => ['title' => '受信メール', 'url' => ['admin' => true, 'plugin' => 'mail', 'controller' => 'mail_messages', 'action' => 'index', $mail['id']]],
            'MailFields' . $mail['id'] => [
                'title' => 'フィールド',
                'url' => ['admin' => true, 'plugin' => 'mail', 'controller' => 'mail_fields', 'action' => 'index', $mail['id']],
                'currentRegex' => '/\/mail\/mail_fields\/[^\/]+?\/' . $mail['id'] . '($|\/)/s'
            ],
            'MailContents' . $mail['id'] => ['title' => '設定', 'url' => ['admin' => true, 'plugin' => 'mail', 'controller' => 'mail_contents', 'action' => 'edit', $mail['id']]]
        ]
    ];
}

$config['BcContents']['items']['BcMail'] = [
    'MailContent' => [
        'title' => __d('baser', 'メールフォーム'),
        'multiple' => true,
        'preview' => true,
        'icon' => 'bca-icon--mail',
        'routes' => [
            'manage' => [
                'admin' => true,
                'plugin' => 'mail',
                'controller' => 'mail_fields',
                'action' => 'index'
            ],
            'add' => [
                'admin' => true,
                'plugin' => 'mail',
                'controller' => 'mail_contents',
                'action' => 'ajax_add'
            ],
            'edit' => [
                'admin' => true,
                'plugin' => 'mail',
                'controller' => 'mail_contents',
                'action' => 'edit'
            ],
            'delete' => [
                'admin' => true,
                'plugin' => 'mail',
                'controller' => 'mail_contents',
                'action' => 'delete'
            ],
            'view' => [
                'plugin' => 'mail',
                'controller' => 'mail',
                'action' => 'index'
            ],
            'copy' => [
                'admin' => true,
                'plugin' => 'mail',
                'controller' => 'mail_contents',
                'action' => 'ajax_copy'
            ]
        ]
    ]
];

/**
 * ショートコード
 */
$config['BcShortCode']['BcMail'] = [
    'BcMail.getForm'
];
