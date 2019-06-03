<?php

    $users = [
        [
            'user_id' => 1,
            'user_name' => 'john',
            'password' => 'john123',
            'first_name' => 'John',
            'last_name' => 'Marshal'
        ],
        [
            'user_id' => 2,
            'user_name' => 'allen',
            'password' => 'allen123',
            'first_name' => 'Allen',
            'last_name' => 'Green'
        ],
        [
            'user_id' => 3,
            'user_name' => 'smith',
            'password' => 'smith123',
            'first_name' => 'Smith',
            'last_name' => 'Wood'
        ],
    ];

    function getUser($by, $value) {
        global $users;
        $user = null;
        foreach ($users as $_user) {
            if ($_user[$by] == $value) {
                $user = $_user;
            }        
        }
        return $user;
    }

?>