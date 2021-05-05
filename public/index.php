<?php

use App\models\Article;
use App\models\User;
use App\models\Comment; 
require_once '../vendor/autoload.php';
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


$articleModel = new Article();


$articles = $articleModel->findAll();

foreach( $articles as $article){
    $authorName = ucfirst(($articleModel->getAuthor($article['articleId']))['nom']);
    $authorPrenom = ucfirst(($articleModel->getAuthor($article['articleId']))['prenom']);  ?>
    <h2><?= $article['title'] ?></h2>
    <h5>ecrit par : <?= $authorName. " ". $authorPrenom ?>  </h5>
<?php }
