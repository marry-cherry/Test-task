<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
?>

<?$APPLICATION->IncludeComponent(
    "my_components:section_list",
    "",
    ["IBLOCK_ID" => 2] 
);?>

<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>