<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title>
        <?php echo CHtml::encode($this->pageTitle); ?></title>

    <div  id="language-selector" style="float:right; margin:5px;">
        <?php
        $this->widget('application.components.widgets.LanguageSelector');
        ?>
    </div>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg" alt="">
            <?php echo CHtml::encode(Yii::app()->name); ?>
        </div>
        <div  id="language-selector" style="float:right; margin:5px;">
            <?php
            $this->widget('application.components.widgets.LanguageSelector');
            ?>
        </div>
    </div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>Yii::t('main-ui', 'Home'), 'url'=>array('/deliveyInfo/find')),

				array('label'=>Yii::t('main-ui', 'About'), 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>Yii::t('main-ui', 'Contact'), 'url'=>array('/site/contact')),
                array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
                array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 'visible'=>Yii::app()->user->isGuest),
                array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
                array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),

			),
		)); ?>
	</div><!-- mainmenu -->


	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

    <div class="span-5 last">
        <div id="sidebar" class="menu2">
            <div id="yw2" class="portlet">
                <div class="portlet-content">
                    <ul id="yw3" class="operations">
                        <li><a href="/site/page/view/strahovanie"><?php echo Yii::t('main-ui', 'strahovanie'); ?></a></li>
                        <li><a href="/site/page/view/upakovka"><?php echo Yii::t('main-ui', 'upakovka'); ?></a></li>
                        <li><a href="/site/page/view/feedback"><?php echo Yii::t('main-ui', 'feedback'); ?></a></li>
                        <li><a href="/site/page/view/dostavka"><?php echo Yii::t('main-ui', 'dostavka'); ?></a></li>
                        <li><a href="/site/page/view/kabinet"><?php echo Yii::t('main-ui', 'kabinet'); ?></a></li>
                        <li><a href="/site/page/view/delivery_time"><?php echo Yii::t('main-ui', 'delivery_time'); ?></a></li>
                        <li><a href="/site/page/view/express"><?php echo Yii::t('main-ui', 'express'); ?></a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div><!-- sidebar -->

	<?php echo $content; ?>

	<div class="clear"></div>
</div>
<div class="span-24">
	<div id="footer">
        MaEx Международная служба доставки<br/>
		All Rights Reserved.<br/>

	</div><!-- footer -->
</div>
<!-- page -->

</body>
</html>
