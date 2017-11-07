<?php

/* @var $this \yii\web\View */
/* @var $content string */

\humhub\assets\AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <title><?= strip_tags($this->pageTitle); ?></title>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?php $this->head() ?>
        <?= $this->render('head'); ?>
    </head>

    <body>
	<script src="<?= $this->theme->getBaseUrl().'/js/lightbox-plus-jquery.min.js'; ?>"></script>
    <?php $this->beginBody() ?>

    <!-- start: first top navigation bar -->
    <div id="topbar-first" class="topbar">
        <div class="container">

            <div class="topbar-brand hidden-xs">
                <?= \humhub\widgets\SiteLogo::widget(); ?>
            </div>

            <div class="topbar-actions pull-right">
				<div class="no-icons">
					<?= \humhub\modules\user\widgets\AccountTopMenu::widget(); ?>
				</div>
				<form id="switchform">
					<a href="javascript:chooseStyle('none', 60)" checked="checked"><i class="fa fa-sun-o"></i></a>
					<a href="javascript:chooseStyle('night-theme', 60)"<i class="fa fa-moon-o"></i></a>
				</form>
            </div>

            <div class="notifications pull-right">
                <?=
	\humhub\widgets\NotificationArea::widget(['widgets' => [
                    [\humhub\modules\notification\widgets\Overview::className(), [], ['sortOrder' => 10]],
                ]]);
                ?>
            </div>
        </div>
    </div>
    <!-- end: first top navigation bar -->

    <!-- start: second top navigation bar -->
        <div id="topbar-second" class="topbar">
            <div class="container">
                <ul class="nav" id="top-menu-nav">
                    <!-- load space chooser widget -->
                    <?= \humhub\modules\space\widgets\Chooser::widget(); ?>

                    <!-- load navigation from widget -->
                    <?= \humhub\widgets\TopMenu::widget(); ?>
                </ul>

                <ul class="nav pull-right" id="search-menu-nav">
                    <?= \humhub\widgets\TopMenuRightStack::widget(); ?>
                </ul>
            </div>
        </div>
        <!-- end: second top navigation bar -->

    <?= \humhub\modules\tour\widgets\Tour::widget(); ?>

    <!-- start: show content (and check, if exists a sublayout -->
    <?php if (isset($this->context->subLayout) && $this->context->subLayout != "") : ?>
        <?= $this->render($this->context->subLayout, array('content' => $content)); ?>
    <?php else : ?>

        <?= $content; ?>

    <?php endif; ?>
    <!-- end: show content -->

    <!-- start: Modal (every lightbox will/should use this construct to show content)-->
    <div class="modal" id="globalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <?= \humhub\widgets\LoaderWidget::widget(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Modal -->

    <?php $this->endBody() ?>

	<script>
	$(document).ready(function() {
		try {
			$.browserSelector();
			if($("html").hasClass("chrome")) {
				$.smoothScroll();
			}
		} catch(err) {
		};
	});
	</script>

    </body>
</html>
<?php $this->endPage() ?>
