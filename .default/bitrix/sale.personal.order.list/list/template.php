<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
?>

<div class="data">
<h1>Мои заказы </h1>
<?
//	print_r($arResult);
?>
			<?
			$bNoOrder = true;
			foreach($arResult["ORDER_BY_STATUS"] as $key => $val)
			{
				$bShowStatus = true;
				foreach($val as $vval)
				{
					$bNoOrder = false;
					if($bShowStatus)
					{
						?><h2><?echo GetMessage("STPOL_STATUS")?> "<?=$arResult["INFO"]["STATUS"][$key]["NAME"] ?>"</h2>
						<small><?=$arResult["INFO"]["STATUS"][$key]["DESCRIPTION"] ?></small>
					<?
					}
					$bShowStatus = false;
					?>
					<table class="sale_personal_order_list" style="border-bottom:2px solid #eee">
						<tr>
						
							<td>
								<h3 class="order-number">
								<a class="btn btn_primary-color" href="javascript:" onClick="$('#vv<?=$vval["ORDER"]["ACCOUNT_NUMBER"]?>').toggle()">

<?echo GetMessage("STPOL_ORDER_NO")?>
								<!--a title="<?echo GetMessage("STPOL_DETAIL_ALT")?>" href="<?=$vval["ORDER"]["URL_TO_DETAIL"] ?>"><?=$vval["ORDER"]["ACCOUNT_NUMBER"]?></a -->
								<?=$vval["ORDER"]["ACCOUNT_NUMBER"]?>
								<?echo GetMessage("STPOL_FROM")?>
								<?= $vval["ORDER"]["DATE_INSERT"]; ?></a>
								</h3>
								
								<?
								if ($vval["ORDER"]["CANCELED"] == "Y")
									echo GetMessage("STPOL_CANCELED")."<br>";
								?>
											<?
									if ($vval["ORDER"]['STATUS_ID']=="N") {
										if ($vval['ORDER']['PAY_SYSTEM_ID']!=3) {
										?>
											<div class="oplata"  style="display: inline-block;">
												<a class="btn btn_oplata btn_secondary-color" href="/personal/order/payment/?ORDER_ID=<?=$vval["ORDER"]["ACCOUNT_NUMBER"]?>&oplata=da"><i class="fa fa-credit-card" aria-hidden="true"></i>
Оплатить заказ</a>
											</div>
										<?
										}
									}
									// print_r($vval["ORDER"]['STATUS_ID']);
									?>

								<br><b class="order-price">
								<?echo GetMessage("STPOL_SUM")?>
								<?=$vval["ORDER"]["FORMATED_PRICE"]?>
								</b>
<!--
								<?if($vval["ORDER"]["PAYED"]=="Y")
									echo GetMessage("STPOL_PAYED_Y");
								else
									echo GetMessage("STPOL_PAYED_N");
								?>
								<?if(IntVal($vval["ORDER"]["PAY_SYSTEM_ID"])>0)
									echo GetMessage("P_PAY_SYS").$arResult["INFO"]["PAY_SYSTEM"][$vval["ORDER"]["PAY_SYSTEM_ID"]]["NAME"]?>
-->
								<br />
								<b><?echo GetMessage("STPOL_STATUS_T")?></b>
								<?
								if ($vval["ORDER"]['STATUS_ID']=="N" && $vval['ORDER']['PAY_SYSTEM_ID']==2) {
										echo "Заказ принят, оплата при получении товара";
										}else{
											echo $arResult["INFO"]["STATUS"][$vval["ORDER"]["STATUS_ID"]]["NAME"];
										}

								?>
								
								
								<br />




<!--
								<?if(IntVal($vval["ORDER"]["DELIVERY_ID"])>0)
								{
									echo "<b>".GetMessage("P_DELIVERY")."</b>".$arResult["INFO"]["DELIVERY"][$vval["ORDER"]["DELIVERY_ID"]]["NAME"];
								}
								elseif (strpos($vval["ORDER"]["DELIVERY_ID"], ":") !== false)
								{
									echo "<b>".GetMessage("P_DELIVERY")."</b>";
									$arId = explode(":", $vval["ORDER"]["DELIVERY_ID"]);
									echo $arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["NAME"]." (".$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["PROFILES"][$arId[1]]["TITLE"].")";
								}
								?>
-->
							</td>

						</tr>
						<tr>
								<td>
							<b>Стоимость доставки: </b><?=CurrencyFormat($vval['ORDER']['PRICE_DELIVERY'], 'RUB');?>
						</td>
						</tr>
							<tr>
								<td>
								<b>Способ оплаты: </b>
									<?
									$pay = CSalePaySystemAction::GetByID($vval['ORDER']['PAY_SYSTEM_ID']);
										if ($pay)
										{
										  echo $pay["NAME"];
										}
									?>
									
								</td>
							</tr>

							<tr>
								<td>
								<b>Способ доставки: </b><?
									$arDeliv = CSaleDelivery::GetByID($vval['ORDER']['DELIVERY_ID']);
										if ($arDeliv)
										{
										  echo $arDeliv["NAME"];
										}
									?>
								</td>
							</tr>
							<tr>
								<td><b>Количество товаров: </b><?=count($vval["BASKET_ITEMS"])?></td>
							</tr>
						
						<tr>
							<td>
								<table class="sale_personal_order_list_table" style="display:none;" id=vv<?=$vval["ORDER"]["ACCOUNT_NUMBER"]?>>
									<tr>
										<td width="100%">
											<b><?echo GetMessage("STPOL_CONTENT")?> </b>

										</td>

										
										<td width="0%">Количество</td>
										<td width="0%">Цена</td>
										<td width="0%">&nbsp;</td>
										<!-- <td width="0%">&nbsp; </td> -->
									</tr>
									<?
									$allsum=0;
									foreach ($vval["BASKET_ITEMS"] as $vvval)
									{
										$measure = (isset($vvval["MEASURE_TEXT"])) ? $vvval["MEASURE_TEXT"] :GetMessage("STPOL_SHT");
										?>
										<tr>
											<td nowrap>

												<?
												if (strlen($vvval["DETAIL_PAGE_URL"]) > 0)
													echo "<a href=\"".$vvval["DETAIL_PAGE_URL"]."\">";
												echo $vvval["NAME"];
												if (strlen($vvval["DETAIL_PAGE_URL"]) > 0)
													echo "</a>";
												?>
											</td>
											<?

											$count_prise=$vvval['BASE_PRICE']*$vvval["QUANTITY"];
											$allsum=$count_prise+$allsum;
											?>
											<td nowrap><?=$vvval["QUANTITY"]?> <?=$vvval['MEASURE_TEXT'];?> </td>
											<td nowrap><?=CurrencyFormat($vvval["BASE_PRICE"], 'RUB');?> за <?=$vvval['MEASURE_TEXT'];?></td>											
											<td  nowrap>Итого: <?=CurrencyFormat($count_prise, 'RUB');?></td>
											
										</tr>
										<?
									}?>
									<tr>
											<td></td>
											<td></td>
											<td></td>
											<td  nowrap><strong>Итого: <?=CurrencyFormat($allsum, 'RUB');?></strong></td>
											<!-- <td width="0%">&nbsp;</td> -->
											
										</tr>
									
								</table>
							</td>
						</tr>
						<!-- tr>
							<td align="right">
								<a title="<?= GetMessage("STPOL_DETAIL_ALT") ?>" href="<?=$vval["ORDER"]["URL_TO_DETAIL"]?>"><?= GetMessage("STPOL_DETAILS") ?></a>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<a title="<?= GetMessage("STPOL_REORDER") ?>" href="<?=$vval["ORDER"]["URL_TO_COPY"]?>"><?= GetMessage("STPOL_REORDER1") ?></a>
								<?if ($vval["ORDER"]["CAN_CANCEL"] == "Y"):?>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a title="<?= GetMessage("STPOL_CANCEL") ?>" href="<?=$vval["ORDER"]["URL_TO_CANCEL"]?>"><?= GetMessage("STPOL_CANCEL") ?></a>
								<?endif;?>
							</td>
						</tr -->
					</table>
				<?
				}
				?>
				<br />
				<?
			}

			if ($bNoOrder)
			{
				?><center><?echo GetMessage("STPOL_NO_ORDERS")?></center><?
			}
			?>

			</div>
