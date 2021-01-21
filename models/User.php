<?php
class User implements JsonSerializable
{
    private $id;
    private $username;
    private $firstName;
    private $lastName;
    private $email;
    private $status;
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
            ->setEmail($params['email'])
            ->setStatus($params['status'])
            ->setRole($params['role']);
    }

    /**
     * @return mixed
     */
    public function getId() : int
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
    public function getUsername() : string
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
    public function getFirstName() : string
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
    public function getLastName() : string
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
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email) : User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus() : bool
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return User
     */
    public function setStatus($status) : User
    {
        $this->status = $status;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getPassword() : string
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
    public function getRole() : string
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
            'email' => $this->getEmail(),
            'status' => $this->getStatus(),
            'role' => $this->getRole(),
        ];
    }
}
