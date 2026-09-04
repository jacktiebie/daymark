<?php

class Auth
{

    //Property waarin we de PDO databaseverbinding bewaren.
    //Priavte = alleen binnen deze Auth class te gebruiken.
    // PDO = This property has to include a PDO object.
    private PDO $pdo;

    //Constructur will be automatically be used.
    //When we use "new Auth(...)".
    public function __construct(PDO $pdo)
    //De meegegeven $pdo opslaan in dit Auth object.
    {
        $this->pdo = $pdo;
    }

    public function register(string $firstName, string $lastName, string $email, string $password)
    {
        //1. Clean Data
        $firstName = trim($firstName);
        $lastName = trim($lastName);
        $email = trim($email);


        //2. Checks
        $this->validatePassword($password);
        $this->validateEmail($email);


        //3. Password Hashing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //4. Create User
        $this->createUser($firstName, $lastName, $email, $hashedPassword);
    }


    //Validating Password Minimum 6 Characters, One Number and One Special Character
    private function validatePassword(string $password)
    {
        if (!preg_match("/^(?=.*\d)(?=.*[^a-zA-Z0-9]).{6,}$/", $password)) {
            $_SESSION['registerErrors'][] = "Wachtwoord is niet veilig genoeg";
            header('Location: http://localhost:8000/register.php');
            exit();
        }
    }



    //Checking if email already exists in DB
    private function validateEmail(string $email)
    {
        $sql = "SELECT email from users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $emailDuplicate = $stmt->fetch();
         $_SESSION['registerErrors'][] = "Email is dubbel";
        header('Location: http://localhost:8000/register.php');
        exit();
    }

    //pasword hash

    //uploading registration data to database
    private function createUser($firstName, $lastName, $email, $hashedPassword) {
    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$firstName, $lastName, $email, $hashedPassword]);

        $_SESSION['registerSucces'][] = "Je account is aangemaakt!";
        header('Location: http://localhost:8000/index.php');
        exit();
    }


}
