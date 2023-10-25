<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
 
use Bitrix\Main\Error;
use Bitrix\Main\Result;  

class UsersTest extends CBitrixComponent
{ 
    public function executeComponent() 
    {
        $result = \Bitrix\Main\GroupTable::getList(array(
            'select'  => array('NAME','ID','STRING_ID','C_SORT') 
        ));        
        $allGroups = [];
        while ($arGroup = $result->fetch()) {        
            $allGroups[] = $arGroup;        
        }        
       
        $this->arResult["GROUPS"] = $allGroups;
        $this->includeComponentTemplate();
    }
     
}