<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<link rel="stylesheet" href="<?= $this->GetFolder() ?>/styles.css">

<div class="my-component">
    <h1><?= htmlspecialchars($arResult["TITLE"]) ?></h1>
</div>

<?php if (!empty($arResult["SECTIONS"])): ?>
    <ul class="sections-list">
        <?php foreach ($arResult["SECTIONS"] as $section): ?>
            <li>
                <a href="?SECTION_ID=<?= $section["ID"] ?>">
                    <?= htmlspecialchars($section["NAME"]) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php elseif (!empty($arResult["ELEMENTS"])): ?>
    <h2>Элементы раздела</h2>
    <ul class="elements-list">
        <?php foreach ($arResult["ELEMENTS"] as $element): ?>
            <li>
                <div class="element-content">
                    <div class="element-title">
                        <strong><?= htmlspecialchars($element["NAME"]) ?></strong>
                    </div>
                    <?php if (!empty($element["PREVIEW_PICTURE"])): ?>
                        <img src="<?= $element["PREVIEW_PICTURE"] ?>" alt="<?= htmlspecialchars($element["NAME"]) ?>" class="element-image">
                    <?php endif; ?>
                    <p class="element-description"><?= htmlspecialchars($element["PREVIEW_TEXT"]) ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="?" class="back-link">← Назад к разделам</a>
<?php else: ?>
    <p>Данные не найдены.</p>
<?php endif; ?>