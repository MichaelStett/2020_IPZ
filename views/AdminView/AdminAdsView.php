<?php
require_once __DIR__ . '/../../autoload.php';


class AdminAdsView
{
    public static function render()
    {
        ob_start();
        ?>
        <?= Layout::header() ?>
        <?= Layout::navbar(['userType' => "admin"])  ?>

        <?= Layout::footer() ?>
        <?php
        $html = ob_get_clean();
        return $html;
    }
}
?>