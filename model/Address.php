<?php
class Address {
    private $street;
    private $city;
    private $state;
    private $postalCode;

    public function __construct($street, $city, $state, $postalCode) {
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->postalCode = $postalCode;
    }

    public function getStreet() {
        return $this->street;
    }

    public function getCity() {
        return $this->city;
    }

    public function getState() {
        return $this->state;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function setStreet($street) {
        $this->street = $street;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }

    public function __toString() {
        return $this->street . ', ' . $this->city . ', ' . $this->state . ' ' . $this->postalCode;
    }
}

?>
