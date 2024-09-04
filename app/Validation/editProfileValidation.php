<?php
namespace editProfileValidation; 

class profileValidation{

function validateProfile($data) {
    $errors = [];

    

    if (strlen($data['username']) > 50) {
        $errors['username'] = "Profile name must be less than 50 characters.";
    }

    if (strlen($data['bio']) > 150) {
        $errors['bio'] = "Bio must be less than 150 characters.";
    }

    
    if (!empty($data['website']) && !filter_var($data['website'], FILTER_VALIDATE_URL)) {
        $errors['website'] = "Please enter a valid URL.";
    }


    if (strlen($data['location']) > 100) {
        $errors['location'] = "Location must be less than 100 characters.";
    }

    
    if (!empty($data['img']['name'])) {
        $profileImage = $data['img'];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $profileImageExtension = pathinfo($profileImage['name'], PATHINFO_EXTENSION);
        
        if (!in_array(strtolower($profileImageExtension), $allowedExtensions)) {
            $errors['img'] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
        
        if ($profileImage['size'] > 2 * 1024 * 1024) { // 2MB limit
            $errors['img'] = "Profile image must be less than 2MB.";
        }
    }

    // Validate backCoverImage
    if (!empty($data['imgCover']['name'])) {
        $coverImage = $data['imgCover'];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $coverImageExtension = pathinfo($coverImage['name'], PATHINFO_EXTENSION);
        
        if (!in_array(strtolower($coverImageExtension), $allowedExtensions)) {
            $errors['imgCover'] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
        
        if ($coverImage['size'] > 2 * 1024 * 1024) { // 2MB limit
            $errors['imgCover'] = "Back cover image must be less than 2MB.";
        }
    }

    return $errors;
}

}
?>
