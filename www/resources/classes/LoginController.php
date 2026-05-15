<?php

/*
 * Author: Sean Boa
 * Date: April 2026
 */

class LoginController extends DatabaseHandler
{

    private $studentNumber;
    private $password;
    private $pdo;

    public function __construct($studentNumber, $password) {
     $this->studentNumber = $studentNumber;
     $this->password = $password;
     $this->pdo = $this->connect();
    }

    function getUser($studentNumber, $password) {
        $stmt = $this->pdo->prepare('SELECT * FROM `customer` WHERE student_number = :studentNumber');
        $stmt->bindParam(':studentNumber', $studentNumber);

        if (!$stmt->execute()) {
            header('Location:' . __DIR__ . '../../login.php?=stmtfail');
            exit;
        }
        $user = $stmt->fetch();

        if (!$user) {
            $this->generateError('studentNumber','User not found'
            );
            return false;
        }

        $passwordCorrect = password_verify($password, $user->password);

        if (!$passwordCorrect) {
            $this->generateError('password','Password incorrect');
            return false;
        }

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    function login() {
        $result = $this->getUser($this->studentNumber, $this->password);
        if ($result) {
            $_SESSION['user']['name'] = $result->forename . ' ' . $result->surname;
            $_SESSION['user']['studentNumber'] = $result->student_number;
            $_SESSION['user']['uid'] = $result->customer_id;

            // Temporary redirect to homepage with name in the URL for testing purpose.
            header('Location:../../index.php');
            exit();
        } else {
            header('Location:../../login.php?error=1');
        }

    }

    private function generateError($type, $message) {
        if(!isset($_SESSION['errors']['login'][$type])) {
            $_SESSION['errors']['login'][$type] = [$message];
        } else {
            array_push($_SESSION['errors']['login'][$type], $message);
        }

    }

}
