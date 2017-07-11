<?php
/*
 * https://github.com/shuv1824
 * https://linkedin.com/in/shuv1824
 * Shah Nawaz Shuvo
 * Email: shahnawaz.shuvo1824@gmail.com
 * Skype: shuvo1824@hotmail.com
 */

 class Validator{
   /*
    * Check required fields
    */
    public function isRequired($fields){
      foreach($fields as $field){
        if($_POST[''.$field.''] == ""){
          return false;
        }
      }
      return true;
    }

    /*
     * Email Validation
     */
    public function isValidEmail($email){
      if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
      }else{
        return false;
      }
    }

    /*
     * Check password match
     */
    public function passwordMatch($pw1, $pw2){
      if($pw1 == $pw2){
        return true;
      }else{
        return false;
      }
    }
 }
