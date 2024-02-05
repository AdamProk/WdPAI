<?php
namespace models;
class User{
    private $id_user;
    private $email;
    private $password;
    private $name;
    private $profile_picture;
    private $role;

    public function __construct(int $id_user, string $email,string $password,string $name,string $profile_picture, string $role = null){
        $this->id_user = $id_user;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->profile_picture = $profile_picture;
        $this->role= $role;
    }
    public function getID(): int{
        return $this->id_user;
    }
    public function getEmail():string
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword():string
    {
        return $this->password;
    }
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getName():string
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getProfile_picture():string
    {
        return $this->profile_picture;
    }
    public function setProfile_picture(string $profile_picture)
    {
        $this->profile_picture = $profile_picture;
    }
    public function getRole(): string{
        return $this->role;
    }

}