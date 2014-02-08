<?php
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        'defaultController' => 'DeliveyInfo',
        // Put back-end settings there.
        // компоненты
        'components'=>array(

            // пользователь

            'urlManager'=>array(
                'urlFormat'=>'path',
                'showScriptName'=>false,
                'rules'=>array(
                    'backend'=>'DeliveyInfo/index',
                    'backend/<_c>'=>'<_c>',
                    'backend/<_c>/<_a>'=>'<_c>/<_a>',
                ),
            ),
            // mailer
            'mailer'=>array(
                'pathViews' => 'application.views.backend.email',
                'pathLayouts' => 'application.views.email.backend.layouts'
            ),

        ),
    )
);