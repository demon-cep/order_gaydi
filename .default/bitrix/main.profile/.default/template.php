<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

?>

<div class="data">
<h1>Личные данные</h1>
	<?
	ShowError($arResult["strProfileError"]);

	if ($arResult['DATA_SAVED'] == 'Y')
	{
		ShowNote(Loc::getMessage('PROFILE_DATA_SAVED'));
	}

	?>
	<form method="post" name="form1" action="<?=$APPLICATION->GetCurUri()?>" enctype="multipart/form-data" role="form">
		<?=$arResult["BX_SESSION_CHECK"]?>
		<input type="hidden" name="lang" value="<?=LANG?>" />
		<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
		<input type="hidden" name="LOGIN" value=<?=$arResult["arUser"]["LOGIN"]?> />
<table class="form-table personal-table">
	<tbody>
		<tr>
			<td class=legend>
				<?=Loc::getMessage('NAME')?>
			</td>
			<td>
					<input class="form-control" type="text" name="NAME" maxlength="50" id="main-profile-name" value="<?=$arResult["arUser"]["NAME"]?>" />
			</td>
		</tr>
		<tr>
			<td class=legend>
				<?=Loc::getMessage('LAST_NAME')?>
			</td>
			<td>
					<input class="form-control" type="text" name="LAST_NAME" maxlength="50" id="main-profile-last-name" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
			</td>
		</tr>
		<tr>
			<td class=legend>
				<?=Loc::getMessage('SECOND_NAME')?>
			</td>
			<td>
					<input class="form-control" type="text" name="SECOND_NAME" maxlength="50" id="main-profile-second-name" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" />

			</td>
		</tr>
		<tr style="display:none">
			<td class=legend>
				<?=Loc::getMessage('EMAIL')?>
			</td>
			<td>
					<input class="form-control" type="text" name="EMAIL" maxlength="50" id="main-profile-email" value="<?=$arResult["arUser"]["EMAIL"]?>" />
			</td>
		</tr>
			<?
			if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == '')
			{
				?>
		<!-- <tr>
			<td colspan=2>
						
			</td>
		</tr> -->
		<tr>
			<td class=legend>
				<?=Loc::getMessage('NEW_PASSWORD_REQ')?>
				<br><span style="color: gray; font-size: 11px;"><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></span>
			</td>
			<td>
						<input class=" form-control bx-auth-input main-profile-password" type="password" name="NEW_PASSWORD" maxlength="50" id="main-profile-password" value="" autocomplete="off"/>
			</td>
		</tr>
		<tr>
			<td class=legend>
						<?=Loc::getMessage('NEW_PASSWORD_CONFIRM')?>
			</td>
			<td>
						<input class="form-control" type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" id="main-profile-password-confirm" autocomplete="off" />
			</td>
		</tr>
				<?
			}
			?>
		<tr>
			<td>
			</td>
			<td>
			<input type="submit" name="save" class="bigbutt btn btn_primary-color" value="<?=(($arResult["ID"]>0) ? Loc::getMessage("MAIN_SAVE") : Loc::getMessage("MAIN_ADD"))?>">
			</td>
		</tr>
	</table>
	</form>
</div>