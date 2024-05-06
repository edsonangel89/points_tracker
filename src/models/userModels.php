<?php

    class User {

        public $fname;
        public $lname;
        public $email;
        public $password;
        public $role;
        public $points;
        public $prizes;

        public function __construct($fname, $lname, $email, $password, $role, $points, $prizes) {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
            $this->points = $points;
            $this->prizes = $prizes;
        }

    }
?>