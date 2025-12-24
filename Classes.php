<?php
class User{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $role;
    private array  $articles= [];
    private DateTime $createAt;
    private DateTime $lastLogin;

    public function __construct($id,$username,$email,$password,$role,$articles,$createAt,$lastLogin)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->articles = $articles;
        $this->createAt = $createAt;
        $this->lastLogin = $lastLogin;

    }
    public function readArticle(Article $article){

    }
    public function writeComment(){
        
    }
}
class Category{
    private int $id;
    private string $name;
    private string $parentCategoryId;
    private array $children = [];

    public function __construct($id,$name,$parentCategoryId,$children)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parentCategoryId = $parentCategoryId;
        $this->children = $children;
    }
    public function addSubCategory($category)
    {
    
    }
    public function getChildren(){
        
    }
}
class Article{
    private int $id;
    private string $title;
    private string $content;
    private DateTime $created_at;
    private DateTime $updated_at;
    private int $author_id;


    public function __construct($id,$title,$content,$created_at,$updated_at,$author_id)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->author_id = $author_id;
    }
    public function addCategory(){
        
    }
    public function removeCategory(){
        
    } 
    public function publish(){
        
    }
    public function unpublish(){
        
    }
    public function archiver(){
        
    }
}
class Moderation extends User{

    public function createAssignrticle(){

    }
    public function deleteArticle(){
        
    }
    public function updateArticle(){
        
    }
    public function publierArticle(){
        
    }
    public function archiveArticle(){
        
    }
    public function createCategory(){
        
    }
    public function deleteCategory(){
        
    }
    public function updateCategory(){
        
    }
    public function updateComment(){
        
    }
    public function deleteComment(){
        
    }
    
}













?>