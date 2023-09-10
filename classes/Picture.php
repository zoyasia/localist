<?php

class Picture
{
    private array $file;
    private array $allowedExtensions = ['jpg', 'png', 'jpeg'];
    private int $maxSize = 3 * 1024 * 1024; // 3 Mo

    
    public function getFileName():string
    {
        return $this->file['name'];
    }

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function isValidPic()
    {
        $filename = $this->file['name'];
        $fileType = pathinfo($filename, PATHINFO_EXTENSION);
        $fileSize = $this->file['size'];

        if ($fileSize > $this->maxSize) {
            http_response_code(415);
            return "Le fichier est trop volumineux.";
        } elseif (!in_array($fileType, $this->allowedExtensions)) {
            return "Le format du fichier n'est pas compatible.";
        }

        return true;
    }

    public function moveUploadedFile($destination)
    {
        if ($this->isValidPic() === true) {
            if (move_uploaded_file($this->file['tmp_name'], $destination)) {
                return $this->file['name'] . " téléchargé avec succès";
            } else {
                return "Erreur lors du téléchargement du fichier.";
            }
        } else {
            return $this->isValidPic();
        }
    }
}
