<?php


Route::get('ref/category/{category_group_id}','Ref\RefCategoryController@getCategoryByCategoryGroup');
Route::get('ref/getcategorylist', [
	'as' => 'getCategoryInfoList', 'uses' => 'Ref\RefCategoryController@getCategoryInfoList'
]);
