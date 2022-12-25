<?php

class Category
{
    private int $id;
    private string $name;
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

    public function getName(): string {
		return $this->name;
	}

	public function setName(string $name) {
		$this->name = $name;
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