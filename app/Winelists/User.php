<?php

namespace Winelists;

use PDO;
use Winelists\BaseService;

class User extends BaseService{

    const TOKEN_KEY = 'asfdhkgjlr;ofijhgbfdklfsadf';

    private static $currentUserId;

    public function getByEmail($email) {

        $parameters = [
            ':email' => $email,
        ];

        return $this->fetch('SELECT * FROM users_tbl WHERE user_email = :email', $parameters);

    }

    public function insertData($name, $email, $passwordHash){

        //Hash Password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        //Prepare parameters
        $parameters = [
            ':name' => $name,
            ':email' => $email,
            ':password' => $passwordHash,
        ];

        $rows = $this->execute('INSERT INTO users_tbl (user_name, user_email, user_password) VALUES(:name, :email, :password)', $parameters);
        
        return $rows == 1;
    }

    public function verifyUser($email, $passwordHash){

        //Step 1 - Retrieve email
        $user = $this->getByEmail($email);

        //Step 2 - Verify user password
        return password_verify($passwordHash, $user['user_password']);

    }

    public function generateToken($userId){

        // Create token payload
        $payload = [
            'user_id' => $userId,
        ];
        $payloadEncoded = base64_encode(json_encode($payload));
        $signature = hash_hmac('sha256', $payloadEncoded, self::TOKEN_KEY);

        return sprintf('%s.%s', $payloadEncoded, $signature);
    }

    public function getTokenPayload($token){
        // Get payload and signature
        [$payloadEncoded] = explode('.', $token);

        // Get payload
        return json_decode(base64_decode($payloadEncoded), true);
    }

    public function verifyToken($token){
        // Get payload
        $payload = $this->getTokenPayload($token);
        $userId = $payload['user_id'];

        // Generate signature and verify
        return $this->generateToken($userId) == $token;
    }

    public static function getCurrentUserId(){
        return self::$currentUserId;
    }

    public static function setCurrentUserId($userId){
        self::$currentUserId = $userId;
    } 
}
?>