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
     * @var mixed
     */
    private $flag;
    /**
     * @var mixed
     */
    private $romazi;
    /**
     * @var mixed
     */
    private $similarsound;
    /**
     * @var mixed
     */
    private $sample;
    /**
     * @var mixed
     */
    private $example;
    /**
     * @var mixed
     */
    private $meaning;
    /**
     * @var mixed
     */
    private $img;
    /**
     * @var mixed
     */
    private $audio;

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
     * @return mixed
     */
    public function getFlag() {
        return $this->flag;
    }

    /**
     * @param mixed $flag
     *
     * @return Vocabulary
     */
    public function setFlag($flag) {
        $this->flag = $flag;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRomazi() {
        return $this->romazi;
    }

    /**
     * @param mixed $romazi
     *
     * @return Vocabulary
     */
    public function setRomazi($romazi) {
        $this->romazi = $romazi;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSimilarsound() {
        return $this->similarsound;
    }

    /**
     * @param mixed $similarsound
     *
     * @return Vocabulary
     */
    public function setSimilarsound($similarsound) {
        $this->similarsound = $similarsound;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSample() {
        return $this->sample;
    }

    /**
     * @param mixed $sample
     *
     * @return Vocabulary
     */
    public function setSample($sample) {
        $this->sample = $sample;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExample() {
        return $this->example;
    }

    /**
     * @param mixed $example
     *
     * @return Vocabulary
     */
    public function setExample($example) {
        $this->example = $example;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMeaning() {
        return $this->meaning;
    }

    /**
     * @param mixed $meaning
     *
     * @return Vocabulary
     */
    public function setMeaning($meaning) {
        $this->meaning = $meaning;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImg() {
        return $this->img;
    }

    /**
     * @param mixed $img
     *
     * @return Vocabulary
     */
    public function setImg($img) {
        $this->img = $img;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAudio() {
        return $this->audio;
    }

    /**
     * @param mixed $audio
     *
     * @return Vocabulary
     */
    public function setAudio($audio) {
        $this->audio = $audio;

        return $this;
    }

    /**
     * Vocabulary constructor.
     *
     * @param array $data
     */
    public function __construct(array $data) {
        $this->id           = $data['id'] ?? null;
        $this->text         = $data['text'] ?? null;
        $this->flag         = $data['flag'] ?? null;
        $this->romazi       = $data['romazi'] ?? null;
        $this->example      = $data['example'] ?? null;
        $this->meaning      = $data['meaning'] ?? null;
        $this->img          = $data['img'] ?? null;
        $this->audio        = $data['audio'] ?? null;
        $this->sample       = $data['sample'] ?? null;
        $this->similarsound = $data['similarsound'] ?? null;
    }
}
