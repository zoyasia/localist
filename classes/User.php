<?php

/*
class UserRegistration
{
    private array $formData;
    private array $formErrors = [];

    public function __construct($formData)
    {
        $this->formData = $formData;
    }

    public function isValidEmail()
    {
        $email = $this->formData['email'];
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function passwordsMatch($pwd, $pwdConfirm)
    {
        $pwd = $this->formData['pwd'];
        $pwdConfirm = $this->formData['pwdConfirm'];
        return $pwd === $pwdConfirm;
    }

    public function validateForm()
    {
        if (!$this->isValidEmail($this->formData['email'])) {
            $this->formErrors['email'] = "L'adresse e-mail n'est pas valide.";
        }

        if (!$this->passwordsMatch($this->formData['pwd'], $this->formData['pwdConfirm'])) {
            $this->formErrors['password'] = "Les mots de passe ne correspondent pas.";
        }
    }

    public function hasErrors()
    {
        return !empty($this->formErrors);
    }

    public function getErrors()
    {
        return $this->formErrors;
    }
}

*/
class UserRegistration
{
    public static function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function passwordsMatch($pwd, $pwdConfirm)
    {
        return $pwd === $pwdConfirm;
    }

    public static function emailExists($pdo, $email)
    {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public static function validateForm($formData)
    {
        $errors = [];

        if (empty($formData[0])) {
            $errors['firstname'] = "Le prénom est requis.";
        }

        if (empty($formData[1])) {
            $errors['lastname'] = "Le nom est requis.";
        }

        if (!self::validateEmail($formData[2])) {
            $errors['email'] = "L'adresse e-mail n'est pas valide.";
        }

        if (!self::passwordsMatch($formData[3], $formData[4])) {
            $errors['password'] = "Les mots de passe ne correspondent pas.";
        }

        return $errors;
    }
}

