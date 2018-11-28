<?php
/**
 * Created by PhpStorm.
 * User: andingLJ
 * Date: 2018/3/19
 * Time: 12:05
 */

namespace App\Libraries\Util;

class PageUtil
{
    public static function getCommonPage($pageData){
        $pageRet = array();
        if($pageData){
            $pageRet['currentPage'] = $pageData->currentPage();
            $pageRet['totalPage'] = $pageData->lastPage();
            $pageRet['total'] = $pageData->total();
            $pageRet['list'] = $pageData->items();
        }
        return $pageRet;
    }
}