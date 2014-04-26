<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Users extends Eloquent {

    protected $table = 'users';
    protected $guarded = array('id');
    protected $fillable = array('firstname', 'lastname', 'email', 'phone', 'address');
    public static $rules = array('firstname' => 'required|min:5', 'lastname' => 'required|min:5', 'email' => 'required|email');
    private static $headers = array('firstname' => 'First Name', 'lastname' => 'Last Name', 'email' => 'Email', 'phone' => 'Phone', 'address' => 'Address');

    public static function getHeaders() {
        return self::$headers;
    }

    public static function setHeaders($headers) {
        self::$headers = $headers;
    }

}
