<?php
namespace repository;
use models\Comment;
use PDO;
use \DateTime;
require_once 'Repository.php';
require_once __DIR__.'/../models/Comment.php';

class CommentRepository extends Repository
{
    public function getCommentsByRecipeID(int $search){
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT 
                com."ID_comments",
                com."ID_recipe",
                u."name",
                com."comment",
                com."comment_date",
                u."profile_picture"

            FROM public."Comments" com 
            JOIN "Users" u ON u."ID_user"=com."ID_user"
            JOIN "Recipes" rec ON rec."ID_recipe" = com."ID_recipe"
            WHERE com."ID_recipe" = :search
        ');
        $stmt->bindParam(':search', $search, PDO::PARAM_INT);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($comments as $comment){
            $result[] = new Comment(
                $comment['ID_comments'],
                $comment['ID_recipe'],
                $comment['name'],
                $comment['comment'],
                $comment['comment_date'],
                $comment['profile_picture'],
            );
        }
        return $result;
    }
    public function addComment(array $values)
    {
        $date = new DateTime();
        $dbh = $this->database->connect();
        $stmt = $dbh->prepare('
        INSERT INTO "Comments" ("ID_user", "ID_recipe", comment, comment_date) VALUES (?,?,?,?)
        ');
        try{
            $dbh->beginTransaction();
            $stmt->execute([
                $values['user_id'],
                $values['recipe_id'],
                $values['comment'],
                $date->format('Y-m-d'),
            ]);
            $dbh->commit();
        }catch (\PDOException $exception){
            return null;
        }
        return true;
    }
}