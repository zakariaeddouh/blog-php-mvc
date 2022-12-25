<?php

class Comment
{
    private int $id;
    private string $content;
    private int $status;
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

    public function getContent(): string {
		return $this->content;
	}

	public function setContent(string $content) {
		$this->content = $content;
	}

    public function getStatus(): int {
		return $this->$status;
	}

	public function setStatus(int $status) {
		$this->status = $status;
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