<?php

class SignupController extends DatabaseHandler
{
    private $pdo;
    private $forename;
    private $surname;
    private $email;
    private $studentNumber;
    private $house;
    private $street;
    private $town;
    private $postcode;
    private $password;
    private $confirmPassword;

    public function __construct($forename, $surname,$email, $studentNumber, $house, $street, $town, $postcode, $password, $confirmPassword) {
        $this->pdo = $this->connect();
        $this->forename = $forename;
        $this->surname = $surname;
        $this->email = $email;
        $this->studentNumber = $studentNumber;
        $this->house = $house;
        $this->street = $street;
        $this->town = $town;
        $this->postcode = $postcode;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function signup() {
        if ($this->passwordsMatch()
        && !$this->userExists()
        && $this->isValidEmail()
        && $this->isValidStudentNumber()) {
            $this->addUser();
            return true;
        }
        return false;
    }

    private function addUser() {
        $stmt = $this->pdo->prepare('INSERT INTO customer (forename, surname, email, student_number, house, street, town, postcode, password) 
                                            VALUES (:forename, :surname, :email, :student_number, :house, :street, :town, :postcode, :password)');

        $stmt->bindParam(':forename', $this->forename);
        $stmt->bindParam(':surname', $this->surname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':student_number', $this->studentNumber);
        $stmt->bindParam(':house', $this->house);
        $stmt->bindParam(':street', $this->street);
        $stmt->bindParam(':town', $this->town);
        $stmt->bindParam(':postcode', $this->postcode);

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    private function userExists() {
        $stmt = $this->pdo->prepare("SELECT * FROM customer WHERE email = :email OR student_number = :studentNumber");
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":studentNumber", $this->studentNumber);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $this->generateError("exists", "Student number or email already in use");
            return true;
        }

        return false;
    }

    private function passwordsMatch() {
        if ($this->password === $this->confirmPassword) {
            return true;
        }
        $this->generateError("password", "Passwords do not match");
        return false;
    }

    private function isValidEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->generateError("email", "Invalid email format");
            return false;
        }
        return true;
    }

    private function isValidStudentNumber() {
        if (preg_match("/^[0-9]+$/", $this->studentNumber) && strlen($this->studentNumber) == 8) {
            return true;
        }
        $this->generateError("studentNumber", "Invalid student number format");
        return false;
    }

    private function generateError($type, $message) {
        $_SESSION['errors']['signup'][$type][] = $message;
    }


}
