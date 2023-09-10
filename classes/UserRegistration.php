<?php

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

    /**
     * Affiche les messages d'erreurs s'il y en a à la soumission du formulaire
     *
     * @param [PDO] $pdo
     * @param [array] $formData
     * @return string
     */
    public static function validateForm($pdo, $formData)
    {
        $errors = [];

        if (empty($formData[0])) {
            $errors['firstname'] = "Le prénom est requis.";
        }

        if (empty($formData[1])) {
            $errors['lastname'] = "Le nom est requis.";
        }

        if (!self::validateEmail($formData[2])) {
            $errors['email']['format'] = "L'adresse e-mail n'est pas valide.";
        }
    
        // Vérification de l'existence de l'email
        $email = $formData[2];
        if (self::emailExists($pdo, $email)) {
            $errors['email']['exists'] = "Cette adresse e-mail est déjà utilisée.";
        }

        if (!self::passwordsMatch($formData[3], $formData[4])) {
            $errors['password'] = "Les mots de passe ne correspondent pas.";
        }

        return $errors;
    }
}

