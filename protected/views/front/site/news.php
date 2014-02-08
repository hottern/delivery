<!-- Feed widget -->
<?php
$this->widget(
    'ext.yii-feed-widget.YiiFeedWidget',
    array('url'=>'http://feeds.mashable.com/Mashable','limit'=>3)
);
$this->render('news2');
?>