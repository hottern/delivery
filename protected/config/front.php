<?php
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        'defaultController' => 'DeliveyInfo',
        // Put front-end settings there
        // (for example, url rules).
        'components'=>array(

    'request'=>array(
    'enableCookieValidation'=>true,
    'enableCsrfValidation'=>true,
),
    'urlManager'=>array(
    'class'=>'application.components.UrlManager',
    'urlFormat'=>'path',
    'showScriptName'=>false,
    'rules'=>array(
        '<language:(ru|zh_cn|en)>/' => 'site/index',
        '<language:(ru|zh_cn|en)>/<action:(contact|login|logout)>/*' => 'site/<action>',
        '<language:(ru|zh_cn|en)>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
        '<language:(ru|zh_cn|en)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
        '<language:(ru|zh_cn|en)>/<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',
    ),
),
),
'params'=>array(
    'languages'=>array('ru'=>'Русский', 'zh_cn'=>'Chinese', 'en'=>'English'),
),
    )

);