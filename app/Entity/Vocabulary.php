<?php

namespace App\Entity;

class Vocabulary {

    /**
     * @var mixed
     */
    private $id;
    /**
     * @var mixed
     */
    private $text;

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return Vocabulary
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param mixed $text
     *
     * @return Vocabulary
     */
    public function setText($text) {
        $this->text = $text;

        return $this;
    }

    /**
     * Vocabulary constructor.
     *
     * @param array $data
     */
    public function __construct(array $data) {
        $this->id   = $data['id'];
        $this->text = $data['text'];
    }
}
