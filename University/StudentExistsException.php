<?php
class StudentExistsException extends Exception{
    public function errorMessage()
    {
        $errorMsg = "Error: the student already exists in this Subject";
        return $errorMsg;
    }
}