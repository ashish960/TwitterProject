<?php
namespace tweetValidation;

class tweetValidation {

    function validateTweet($data) {
        $errors = [];
       

        if (empty($data['status'])) {
            $errors['status'] = "Text input is required.";
        } elseif (strlen($data['status']) < 3 || strlen($data['status']) > 500) {
            $errors['status'] = "Text input must be between 3 and 500 characters.";
        }

     //   if (empty($data['img']['name'])) {
         //   $errors['img'] = "media is required";
       // } 
        if(!empty($data['img']['name'])) {
            $file = $data['img'];
            $allowedImageTypes = ['jpg', 'jpeg', 'png', 'gif'];
            $allowedVideoTypes = ['mp4', 'avi', 'mpeg'];
            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowedExtensions = array_merge($allowedImageTypes, $allowedVideoTypes);

            
            if (!in_array($fileExtension, $allowedExtensions)) {
                $errors['img'] = "Invalid file type. Only JPG, JPEG, PNG, GIF images and MP4, AVI, MPEG videos are allowed.";
            }

        
            if ($file['size'] > 5 * 1024 * 1024) { 
                $errors['img'] = "File must be less than 5MB.";
            }
        } 
        return $errors;
    }
}
?>
