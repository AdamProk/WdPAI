<?php


namespace repository;

use models\User;
use PDO;

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
        SELECT 
            u."ID_user",
            u."email",
            u."password",
            u."name",
            u."profile_picture",
            r."role"
        FROM public."Users" u 
        JOIN "User_role" ur ON ur."ID_user" = u."ID_user"
        JOIN "Roles" r ON r."ID_role" = ur."ID_role"
        WHERE u."email" = :email
        ');
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        #var_dump(getUser());
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user == false){
            return null;
        }

        return new User(
            $user['ID_user'],
            $user['email'],
            $user['password'],
            $user['name'],
            $user['profile_picture'],
            $user['role'],
        );
    }
    public function getUserOnRegistration(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
        SELECT 
            "ID_user",
            "email",
            "password",
            "name",
            "profile_picture"
        FROM public."Users" WHERE "email" = :email
        ');
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        #var_dump(getUser());
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user == false){
            return null;
        }

        return new User(
            $user['ID_user'],
            $user['email'],
            $user['password'],
            $user['name'],
            $user['profile_picture'],
        );
    }
    public function getUserByID(int $id): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT 
                u."ID_user",
                u."email",
                u."password",
                u."name",
                u."profile_picture",
                r."role"
            FROM public."Users" u 
            JOIN "User_role" ur ON ur."ID_user" = u."ID_user"
            JOIN "Roles" r ON r."ID_role" = ur."ID_role"
            WHERE u."ID_user" = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user == false){
            return null;
        }

        return new User(
            $user['ID_user'],
            $user['email'],
            $user['password'],
            $user['name'],
            $user['profile_picture'],
            $user['role']
        );

    }
    public function addUser(array $values): ?User
    {
        $dbh = $this->database->connect();
        $stmt = $dbh->prepare('
        INSERT INTO "Users" (email, password, name, profile_picture) VALUES (?,?,?,?)
        ');
        try{
            $dbh->beginTransaction();
            $stmt->execute([
                $values['email'],
                $values['password_hash'],
                $values['username'],
                "sample.png",
            ]);
            $dbh->commit();
        }catch (\PDOException $exception){
            return null;
        }
        $stmt2 = $dbh->prepare('
        INSERT INTO "User_role" ("ID_user", "ID_role") VALUES (?, ?)
        ');
        $fetcheduser = $this->getUserOnRegistration($values['email']);
        #var_dump($fetcheduser);
        try{
            $dbh->beginTransaction();
            $stmt2->execute([
                $fetcheduser->getID(),
                2
            ]);
            $dbh->commit();
        }catch (\PDOException $exception){
            return null;
        }
        return $this->getUser($values['email']);
    }
}