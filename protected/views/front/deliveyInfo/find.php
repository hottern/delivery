<?php
/* @var $this DeliveyInfoController */
/* @var $model DeliveyInfo */
?>
<h3><?php echo Yii::t('main-ui', 'tracking'); ?></h3>

<p>
    <style type="text/css">
        P { margin-bottom: 0.21cm; direction: ltr; color: rgb(0, 0, 0); widows: 2; orphans: 2; }A:link { color: rgb(0, 0, 255); }	</style>
    Уважаемые отправители и получатели отправлений!<br />
    &nbsp;<br />
    Современная технология пересылки подразумевает присвоение регистрируемым почтовым отправлениям (заказным или с объявленной ценностью) уникального почтового идентификатора. На каждом этапе пересылки информация почтового идентификатора заносится в единую систему учёта и контроля, благодаря чему возможно отследить прохождение вашего почтового отправления через Интернет.<br />
    &nbsp;<br />
    Описание всех статусов данной системы (на примере входящего международного почтового отправления) представлено в специальной инструкции<br />
    &nbsp;<br />
    Все еще остались вопросы?<br />
    Звоните на горячую линию по номеру 8-800-2222-333<br />
    &nbsp;<br />
    Поиск по почтовому идентификатору<br />
    &nbsp;<br />
    Отслеживание операций обработки MaEx (в том числе международных) по почтовому идентификатору (либо внутрироссийскому 14-символьному, либо международному).<br />
    &nbsp;<br />
    Почтовый идентификатор находится в чеке, выдаваемом при приеме почтового отправления. Вид номера: CN492B9 0000 31. Следует вводить: &nbsp;<br />
    Почтовый идентификатор: CN492B9000031 (весь номер без скобок и пробелов).<br />
    &nbsp;<br />
    В случае отслеживания международного почтового отправления. Буквы вводятся обязательно ЗАГЛАВНЫЕ и в латинском алфавите.<br />
    Пример: YF123456789RU (весь номер без пробелов).</p>
<p style="margin-bottom: 0.35cm">
    &nbsp;</p>


<div id="info"></div>
<p>
    <input id="word" type="text" name="word" />
    <input id="YII_CSRF_TOKEN" type="hidden" name="YII_CSRF_TOKEN" />
    <?php echo CHtml::link(Yii::t('main-ui', 'search'),'#',array('class'=>'search-button')); ?>
</p>
<div id="result"></div
<?php    $this->menu=array(
    array('label'=>'Create DeliveyInfo', 'url'=>array('create')),
    array('label'=>'Manage DeliveyInfo', 'url'=>array('admin')),
    ); ?>




<?php
Yii::app()->clientScript->registerScript('find', "

$('.search-button').click(function(){
    var url = '/deliveyInfo/UpdateAjax';
    var word = $('#word').val();
    $.ajax({
        url: url,

        type: 'POST',
        data: {
            word: word,
            'YII_CSRF_TOKEN' : '" . Yii::app()->request->csrfToken . "'
        },
       cache: false,
                                success: function(r){
                                       $('#result').html(r);
                                }

     })
    });
");

?>
