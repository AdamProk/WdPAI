<?php
namespace models;
class Comment
{
    private $comment_id;
    private $recipe_id;
    private $commenter;
    private $comment_description;
    private $date;
    private $commenter_picture;
    public function __construct(int $comment_id, int $recipe_id, string $commenter,string $comment_description,string $date,string $commenter_picture=null){
        $this->comment_id = $comment_id;
        $this->recipe_id = $recipe_id;
        $this->commenter = $commenter;
        $this->comment_description = $comment_description;
        $this->date = $date;
        $this->commenter_picture = $commenter_picture;
    }
    public function getCommentID():int
    {
        return $this->comment_id;
    }
    public function setCommentID(int $comment_id)
    {
        $this->comment_id = $comment_id;
    }


    public function getRecipeID():int
    {
        return $this->recipe_id;
    }
    public function setRecipeID(int $recipe_id)
    {
        $this->recipe_id = $recipe_id;
    }

    public function getCommenter():string
    {
        return $this->commenter;
    }
    public function setCommenter(string $commenter)
    {
        $this->commenter = $commenter;
    }

    public function getComment():string
    {
        return $this->comment_description;
    }
    public function setComment(string $comment_description)
    {
        $this->comment_description = $comment_description;
    }

    public function getDate():string
    {
        return $this->date;
    }
    public function setDate(string $date)
    {
        $this->date = $date;
    }

    public function getProfile_picture():string
    {
        return $this->commenter_picture;
    }
    public function setProfile_picture(string $commenter_picture)
    {
        $this->commenter_picture = $commenter_picture;
    }
}