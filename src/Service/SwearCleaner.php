<?php 

namespace App\Service;
use App\Entity\Article;


class SwearCleaner
{
    const insults = ["pute"," con ","salope", "enfoiré"];

    public function CleanSwear(Article $article) {  
     $cleanedcontent = str_ireplace(self::insults, '#', $article->getContent()); 
        $article->setContent($cleanedcontent);
        return $article;
    }
}

?>