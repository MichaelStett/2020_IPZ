<?php
class User implements JsonSerializable
{
    private $id;
    private $username;
    private $firstName;
    private $lastName;
    private $role;
    private $password;

    public function __construct($params)
    {
        if ($params) {
            $this->fromArray($params);
        }
    }

    private function fromArray($params) {
        $this
            ->setId($params['id'])
            ->setUsername($params['username'])
            ->setFirstName($params['firstName'])
            ->setLastName($params['lastName'])
            ->setRole($params['role']);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id) : User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return User
     */
    public function setUsername($username) : User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     * @return User
     */
    public function setFirstName($firstName) : User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     * @return User
     */
    public function setLastName($lastName) : User
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return User
     */
    public function setPassword($password) : User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     * @return User
     */
    public function setRole($role) : User
    {
        $this->role = $role;
        return $this;
    }


    public function getFullName() : string
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    public function __toString() : string
    {
        return $this->getId() . ' ' . $this->getUsername() . ' ' .$this->getFirstName() . ' ' . $this->getLastName() ;
    }

    public function jsonSerialize(): array
    {
        header('Content-type:application/json;charset=utf-8');
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'role' => $this->getRole(),
        ];
    }
}
