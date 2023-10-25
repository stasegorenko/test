<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
  
class UsersTest extends CBitrixComponent
{ 
    public function executeComponent() 
    {
        $result = \Bitrix\Main\GroupTable::getList(array(
            'select'  => array('NAME','ID','STRING_ID','C_SORT'),         
            'filter'  => array('ID'=> $this->arParams["GROUP_ID"])         
        ));        
        $allGroups = [];
        while ($arGroup = $result->fetch()) {        
            $allGroups[] = $arGroup;        
        }        
       
        $this->arResult["GROUP"] = $allGroups;
        $this->includeComponentTemplate();
    }
     
}