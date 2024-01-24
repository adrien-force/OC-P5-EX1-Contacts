<?php

/**
 * Represents a contact with an ID, name, email, and phone number.
 */



class Contact {
    private $id;
    private $name;
    private $email;
    private $phone_number;

    /**
     * Constructs a new Contact object with the specified ID, name, email, and phone number.
     *
     * @param int $id The ID of the contact.
     * @param string $name The name of the contact.
     * @param string $email The email of the contact.
     * @param string $phone_number The phone number of the contact.
     */
    public function __construct($id, $name, $email, $phone_number) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }

    /**
     * Gets the ID of the contact.
     *
     * @return int The ID of the contact.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Gets the name of the contact.
     *
     * @return string The name of the contact.
     */
    public function getName() {
        return $this->name; 
    }

    /**
     * Gets the email of the contact.
     *
     * @return string The email of the contact.
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Gets the phone number of the contact.
     *
     * @return string The phone number of the contact.
     */
    public function getPhoneNumber() {
        return $this->phone_number;
    }

    /**
     * Sets the name of the contact.
     *
     * @param string $name The new name of the contact.
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Sets the email of the contact.
     *
     * @param string $email The new email of the contact.
     */
    public function setEmail($email) {
        $this->email = $email; 
    }

    /**
     * Sets the phone number of the contact.
     *
     * @param string $phone_number The new phone number of the contact.
     */
    public function setPhoneNumber($phone_number) {
        $this->phone_number = $phone_number;
    }

    /**
     * Returns a string representation of the contact.
     *
     * @return string The string representation of the contact.
     */
    public function __toString() {
        return "Contact: $this->id, $this->name, $this->email, $this->phone_number";
    }

    /**
     * Converts the contact object to an array.
     *
     * @return array The contact object as an array.
     */
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email, 
            'phone_number' => $this->phone_number
        ];
    }

}
