<?php

namespace Fdvice\Services;

class PasswordGenerator
{

    protected $length;

    // Constructor to set the length of the generated password
    public function __construct($length = 32)
    {

        if ($length < 32) {
            
            throw new Exception("length must be greater than 32");
            
        }
        $this->length = $length;
    }


    /**
     * Generate a random password using plain PHP functions.
     * 
     * @return string
     */
    public function generate()
    {
        // Generate a random password using random_bytes() (strong cryptographic random data)
        $bytes = random_bytes($this->length);
        return bin2hex($bytes); // Convert to hexadecimal representation
    }

    /**
     * Generate a complex password using numbers, letters, and symbols.
     * 
     * @return string
     */
    public function generateComplex()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+-=[]{}|;:,.<>?';
        $password = '';
        $max = strlen($alphabet) - 1;

        for ($i = 0; $i < $this->length; $i++) {
            // Randomly pick a character from the $alphabet string
            $password .= $alphabet[random_int(0, $max)];
        }

        return $password;
    }

    /**
     * Generate a password based on a policy (complex password in this case).
     * 
     * @param int $length
     * @return string
    */
    public function generatePolicyBased($length = 32)
    {
        return $this->generateComplex(); // You can refine this to meet specific policies
    }

}