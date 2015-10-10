<?php

namespace App\Http\Model\Ref;

class RefCategoryRead extends RefCategory
{
    //
    public static function getCategoryInArray() {
        $jsonCategory = self::all();
        $arrCategory = array();
        foreach ($jsonCategory as $category) {
            $arrCategory = array_add($arrCategory,$category['category_id'],$category['category_desc']);
        }
        return $arrCategory;
    }

    public static function getCategoryInArrayByCategoryGroup($intCategoryGroupId) {
        $jsonCategory = self::select('category_id','category_desc')->where('category_group_id',$intCategoryGroupId)->get();
        $arrCategory = array();
        foreach ($jsonCategory as $category) {
            $arrCategory = array_add($arrCategory,$category['category_id'],$category['category_desc']);
        }
        return $arrCategory;
    }

}
