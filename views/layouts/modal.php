<?php
/* @var $content string */

use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<html>
<body>
    <?php $this->beginBody() ?>
        <?= $content ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


