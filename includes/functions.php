<?php
include_once 'config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function login($email, $password, $mysqli){
    //Use of prepared statements to login
        $statement = $mysqli->prepare('SELECT user_id, email, name FROM users where email = ? and password = ?' );
        $statement->bind_param('ss',$email,$password);
        $statement->execute();
        $statement->store_result();
        
        //getting variables from the result
        $statement->bind_result($userid, $email, $name);
        $statement->fetch();
        
        if($statement->num_rows == 1){       
            $_SESSION['name'] = $name;            
            $_SESSION['username'] = $email;
            $statement->close();
            //header("location: user.php");
            return true;
        }else{
            //$error="Invalid username or password";        
            //header("location: ../index.php?login_error=".$error);
            $statement->close();
            return false;
        }
}

function login_check(){
    //TODO: check with password
    if(isset($_SESSION['name'],$_SESSION['username'])){
        //User already logged in
        return true;
    }else {
        //Not logged in
        return false;
    }
}

function register($name, $email, $pass, $mysqli){
    $statement = $mysqli->prepare('INSERT into users (email, name, password) values (?, ?, ?)' );
    $statement->bind_param('sss',$email,$name, $pass);
    $statement->execute();
    
    if($statement->affected_rows == 1){       
        //$_SESSION['name'] = $name;            
        //$_SESSION['username'] = $email;            
        //header("location: user.php");
        $statement->close();
        return true;
    }else{
        //$error="Invalid username or password";        
        //header("location: ../index.php?login_error=".$error);
        $statement->close();
        return false;
    }
}

