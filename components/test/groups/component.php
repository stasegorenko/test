<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

  
$arDefaultUrlTemplates404 = array(
	"news" => "",
	"detail" => "#ELEMENT_ID#/" 
);

$arDefaultVariableAliases404 = array();

$arDefaultVariableAliases = array();

$arComponentVariables = array( 
	"ELEMENT_ID",
);

$arParams['SET_STATUS_404'] = (string)($arParams['SET_STATUS_404'] ?? 'N');
$arParams['SET_STATUS_404'] = $arParams['SET_STATUS_404'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_404'] = (string)($arParams['SHOW_404'] ?? 'N');
$arParams['SHOW_404'] = $arParams['SHOW_404'] === 'Y' ? 'Y' : 'N';
$arParams['FILE_404'] = trim((string)($arParams['FILE_404'] ?? ''));
$arParams['MESSAGE_404'] = trim((string)($arParams['MESSAGE_404'] ?? ''));

$arParams['VARIABLE_ALIASES'] ??= [];

if($arParams["SEF_MODE"] == "Y")
{
	$arVariables = array();

	$arUrlTemplates = CComponentEngine::makeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
	$arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);

	$engine = new CComponentEngine($this);
	if (CModule::IncludeModule('iblock'))
	{
		$engine->addGreedyPart("#SECTION_CODE_PATH#");
		$engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
	}
	$componentPage = $engine->guessComponentPath(
		$arParams["SEF_FOLDER"],
		$arUrlTemplates,
		$arVariables
	);

	$b404 = false;
	if(!$componentPage)
	{
		$componentPage = "news";
		$b404 = true;
	}


	CComponentEngine::initComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);

	$arResult = array(
		"FOLDER" => $arParams["SEF_FOLDER"],
		"URL_TEMPLATES" => $arUrlTemplates,
		"VARIABLES" => $arVariables,
		"ALIASES" => $arVariableAliases,
	);
}


$arResult["VARIABLES"]["ELEMENT_ID"] ??= '';


$this->includeComponentTemplate($componentPage);
