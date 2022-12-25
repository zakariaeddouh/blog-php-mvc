<?php

class User
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private int $role;
    private string $picture;
    private DateTime $dateCreated;
    private DateTime $dateUpdated;

    public function __construct($value = array())
    {
        if(!empty($value)) {
            $this->hydrate($value);
        }
    }

    public function hydrate($data)
    {
        foreach ($data as $attribut => $value) {
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));
            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }

	public function getId(): int {
		return $this->$id;
	}

	public function setId(int $id) {
		$this->id = $id;
	}

	public function getFirstName(): string {
		return $this->firstName;
	}

	public function setFirstName(string $firstName) {
		$this->firstName = $firstName;
	}

	public function getLastName(): string {
		return $this->lastName;
	}

	public function setLastName(string $lastName) {
		$this->lastName = $lastName;
	}

	public function getEmail(): string {
		return $this->email;
	}

	public function setEmail(string $email) {
		$this->email = $email;
	}

	public function getPassword(): string {
		return $this->password;
	}

	public function setPassword(string $password) {
		$this->password = $password;
	}

	public function getRole() {
		return $this->role;
	}

	public function setRole(int $role): int {
		$this->role = $role;
	}

    public function getPicture(): string {
		return $this->picture;
	}

	public function setPicture(string $picture) {
		$this->picture = $picture;
	}

	public function getDateCreated(): DateTime{
		return $this->dateCreated;
	}

	public function setDateCreated(DateTime $dateCreated) {
		$this->dateCreated = $dateCreated;
	}

	public function getDateUpdated(): DateTime {
		return $this->$dateUpdated;
	}

	public function setDateUpdated(DateTime $dateUpdated) {
		$this->dateUpdated = $dateUpdated;
	}
}