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
            $_SESSION['notificationMessage'][] = "Wachtwoord is niet veilig genoeg";
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
        if ($emailDuplicate) {
        $_SESSION['notificationMessage'][] = "Email is al in gebruik";
        header('Location: http://localhost:8000/register.php');
        exit();
        } 
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

    public function loginUsers(string $email, string $password) {
      
        /* Select password and user_id from the table users based on the e-mail the user gives*/
       $sql = "SELECT password, user_id, first_name FROM users WHERE email = ?";
       //prepare the statement*/
        $stmt = $this->pdo->prepare($sql);
        //execute the statement with the e-mail the user gave*/
        $stmt->execute([$email]);
        //fetch the result */
        $result = $stmt->fetch();
        //put the results in a variable
        $passwordDB = $result['password'];
        $userID = $result['user_id'];
        $name = $result['first_name'];
       
        /* PASSWORD VERIFY */
        if(!password_verify($password, $passwordDB)) {
        echo "PASSWORD OR EMAIL IS WRONG";
        exit();
        }
        /* If password is correct make a session using the userID and the user goes to the index.php page */
         $_SESSION['user_id'] = $userID;
         $_SESSION['first_name'] = $name;
      
          header('Location: http://localhost:8000/dashboard.php');
        exit();
       
    
    }
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['first_name']);
        $_SESSION['registerSucces'][] = "Je bent uitgelogd!";
        header('Location: http://localhost:8000/index.php');
        exit();
    }

}
