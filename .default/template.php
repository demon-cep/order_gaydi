<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

$APPLICATION->SetTitle(Loc::getMessage("SPS_TITLE_MAIN"));
$APPLICATION->AddChainItem(Loc::getMessage("SPS_CHAIN_MAIN"), $arResult['SEF_FOLDER']);


$availablePages = array();

if ($arParams['SHOW_ORDER_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_ORDERS'],
		// "name" => Loc::getMessage("SPS_ORDER_PAGE_NAME"),
		"name" => "Мои заказы",
		"icon" => '<i class="fa fa-calculator"></i>'
	);
}

if ($arParams['SHOW_ACCOUNT_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_ACCOUNT'],
		"name" => Loc::getMessage("SPS_ACCOUNT_PAGE_NAME"),
		"icon" => '<i class="fa fa-credit-card"></i>'
	);
}

if ($arParams['SHOW_PRIVATE_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_PRIVATE'],
		// "name" => Loc::getMessage("SPS_PERSONAL_PAGE_NAME"),
		"name" => "Личные данные",
		"icon" => '<i class="fa fa-user-secret"></i>'
	);
}


if ($arParams['SHOW_PROFILE_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_PROFILE'],
		"name" => Loc::getMessage("SPS_PROFILE_PAGE_NAME"),
		"icon" => '<i class="fa fa-list-ol"></i>'
	);
}

if ($arParams['SHOW_BASKET_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arParams['PATH_TO_BASKET'],
		// "name" => Loc::getMessage("SPS_BASKET_PAGE_NAME"),
		"name" => "Корзина",
		"icon" => '<i class="fa fa-shopping-cart"></i>'
	);
}

if ($arParams['SHOW_SUBSCRIBE_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_SUBSCRIBE'],
		"name" => Loc::getMessage("SPS_SUBSCRIBE_PAGE_NAME"),
		"icon" => '<i class="fa fa-envelope"></i>'
	);
}

if ($arParams['SHOW_CONTACT_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arParams['PATH_TO_CONTACT'],
		"name" => Loc::getMessage("SPS_CONTACT_PAGE_NAME"),
		"icon" => '<i class="fa fa-info-circle"></i>'
	);
}

$customPagesList = json_decode(htmlspecialchars_decode($arParams['CUSTOM_PAGES']));
if ($customPagesList)
{
	foreach ($customPagesList as $page)
	{
		$availablePages[] = array(
			"path" => $page[0],
			"name" => $page[1],
			"icon" => (strlen($page[2])) ? '<i class="fa '.htmlspecialcharsbx($page[2]).'"></i>' : ""
		);
	}
}

if (empty($availablePages))
{
	ShowError(Loc::getMessage("SPS_ERROR_NOT_CHOSEN_ELEMENT"));
}
else
{
	global $USER;
	//
	$rsUser = CUser::GetByID($USER->GetID());
	$arUser = $rsUser->Fetch();

	?>

	<div class="data">
<h1>Личный кабинет</h1>
<!-- h2><?=$arUser['NAME']?> <?=$arUser['SECOND_NAME']?> <?=$arUser['LAST_NAME']?></h2 -->

			<div class="cabinet cabinet-btns">
				<?
				foreach ($availablePages as $blockElement)
				{
					?>
					<div class="cabinet-item">
						<a href="<?=htmlspecialcharsbx($blockElement['path'])?>">
							<div class="sale-personal-section-index-block-ico">
								<?=$blockElement['icon']?>
							</div>
							<div class="sale-personal-section-index-block-name">
								<?=htmlspecialcharsbx($blockElement['name'])?>
							</div>
							<div class="clear"></div>
						</a>
					</div>
					<?
				}
				?>
	<?
}
?>
			</div>
				
<div class="clear"></div>

</div>
