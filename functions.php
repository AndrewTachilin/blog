<?php

function addUser($email, $firstName, $lastName, $password) {
        $id = rand(1,1000);
        $line = json_encode([
        'id' => $id,
        'Email' => $email,
        'FirstName' => $firstName,
        'LastName' => $lastName,
        'Password' => sha1( $password ),
    ]);
    $id++;

    $usersDb = fopen("db/users.db", "a+");
    if($usersDb) {
        fwrite($usersDb, $line . PHP_EOL);
        fclose($usersDb);
        return true;
    }

    return false;
}

function userExist($email){
    $usersDb = fopen("db/users.db", "r");
    if(!$usersDb) {
        return false;
    } else {
        while(!feof($usersDb)) {
            $line = fgets($usersDb);
            if($line) {
                $line = json_decode($line, true);
                if($email == $line['email']) {
                    fclose($usersDb);
                    return true;
                }
            }
        }

        fclose($usersDb);
        return false;
    }
}

function checkUser($email, $password) {
    $password = sha1($password);
    $usersDb = fopen("db/users.db", "r");
    if(!$usersDb) {
        return false;
    } else {
        while(!feof($usersDb)) {
            $line = fgets($usersDb);
            if($line) {
                $line = json_decode($line, true);
                if(
                    $line["email"] == $email &&
                    $line["password"] == $password
                ) {
                    fclose($usersDb);
                    return $line;
                }
            }
        }

        fclose($usersDb);
        return false;

    }
}

function addPost($userId, $title, $body, $filePath = false) {
    $userDb = fopen("db/$userId.db", "a+");
    if(!$userDb) {
        return false;
    }
    $name = false;
    if(
        $filePath &&
        is_uploaded_file($filePath)
    ) {
        //TODO: check image (getimagesize)

        if(isset($_POST['submit2']) && isset($_POST['file'])) {
            $name = $_FILES['file']['name'];
            $tmp  = $_FILES['file']['tmp_name'];
            echo $tmp;
            echo $name;
            $allowed = array("jpg", "png", "gif", "jpeg");
            $exts = explode('.', $name);
            if (!in_array($exts[1], $allowed)) {
                echo 'only jpg, png and gif file!';
            } else {
                $info = getimagesize($tmp);
                if (!empty($info)) {
                    if (move_uploaded_file($tmp, $name)) {
                        echo 'uploaded =>' . $name;
                    } else {
                        echo 'uploaded failed!';
                    }
                } else {
                    echo 'invalid image';
                }

            }
        }else{
            echo 'error';
        }

        $pathInfo = pathinfo($filePath);
        $name = "img_" .
            time() . "." .
            $pathInfo['extension'];

        move_uploaded_file(
            $filePath, "img/" . $name
        );
    }

    fwrite($userDb, json_encode([
        'title' => $title,
        'body' => $body,
        'image' => $name,
        'createdAt' => date("d.m.Y H:i:s"),
    ]));
    fclose($userDb);
    return true;
}