<?php
namespace App\controllers;
use App\models\Category as ModelsCategory;
use Exception;


class Category

{
   public function showCategory()
   {
    $model = new ModelsCategory();
    $categories = $model->findAll();
    if(!$categories){
        throw new Exception("impossible to load data !!");
    }    
    return $categories;
   }

   public function showCategoryById($articleId)
   {
    $model = new ModelsCategory();
    $categories = $model->getCategoryById($articleId);
    if(!$categories){
        throw new Exception("impossible to load data !!");
    }    
    return $categories;
   }
}