<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Модуль инфоблоков
if (!CModule::IncludeModule("iblock")) {
    ShowError("Модуль инфоблоков не подключен!");
    return;
}

// Параметры
$arResult["TITLE"] = $arParams["TITLE"] ?: "Тестовое задание для PHP-программиста (Битрикс)"; // Только заголовок
$arResult["SECTIONS"] = [];
$arResult["ELEMENTS"] = [];

$iblockId = (int)$arParams["IBLOCK_ID"]; //  ID инфоблока
$sectionId = (int)$_REQUEST["SECTION_ID"]; // ID раздела из запроса

if ($iblockId > 0) {
    if ($sectionId > 0) {
        $dbElements = CIBlockElement::GetList(
            ["SORT" => "ASC"], 
            ["IBLOCK_ID" => $iblockId, "SECTION_ID" => $sectionId, "ACTIVE" => "Y"], 
            false,
            false,
            ["ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE"] 
        );

        while ($element = $dbElements->GetNext()) {
            if ($element["PREVIEW_PICTURE"]) {
                $resizedPicture = CFile::ResizeImageGet(
                    $element["PREVIEW_PICTURE"],
                    array("width" => 300, "height" => 300), 
                    BX_RESIZE_IMAGE_PROPORTIONAL,
                    true
                );
                $element["PREVIEW_PICTURE"] = $resizedPicture["src"];
            }
            $arResult["ELEMENTS"][] = $element;
        }
    } else {
        $dbSections = CIBlockSection::GetList(
            ["SORT" => "ASC"],
            ["IBLOCK_ID" => $iblockId, "ACTIVE" => "Y"],
            false,
            ["ID", "NAME", "SECTION_PAGE_URL"]
        );

        while ($section = $dbSections->GetNext()) {
            $arResult["SECTIONS"][] = $section;
        }
    }
}

$this->IncludeComponentTemplate();
?>