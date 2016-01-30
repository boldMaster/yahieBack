<?php

namespace App\Http\Model\Ref;

class RefCategoryGroupRead extends RefCategoryGroup
{
    //
    public static function getCategoryGroupInArray() {
        $jsonCategoryGroup = self::all();
        $arrCategoryGroup = array();
        foreach ($jsonCategoryGroup as $categoryGroup) {
            $arrCategoryGroup = array_add($arrCategoryGroup,$categoryGroup['category_group_id'],$categoryGroup['category_group_desc']);
        }
        return $arrCategoryGroup;
    }
}
