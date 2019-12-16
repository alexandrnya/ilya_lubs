<?php


namespace DB;


use mysqli;

class Users
{
    var $DB;
    var $user = [];
    var $messages = [];

    public function __construct()
    {
        global $mysqli;
        $this->DB = $mysqli;
    }

    function ValidationLogin($login)
    {

        if (strlen($login) < $len = 6) {
            $this->messages["LOGIN"][] = "Логие должен быть не менее $len символов";
        }

        if (!$login == preg_replace('/[^a-zA-Z0-9_\-*]/ui', '', $login)) {
            $this->messages["LOGIN"][] = "Логин содержит недопустимые символы. Должен содержать только [a-z], [A-Z], [0-9], [_], [-], [*]";
        }

        if (empty($this->messages["LOGIN"])) {
            return $login;
        }
    }

    function ValidationPassword($password)
    {
        if (strlen($password) < $len = 6) {
            $this->messages["PASSWORD"][] = "Пароль должен быть больше $len символов";
        }
        if (empty($this->messages["PASSWORD"])) {
            return $password = md5($password);
        }

    }

    function ValidationEmail($email)
    {
        $email = trim($email);

        if (stripos($email, "@") === false) {
            $this->messages["EMAIL"][] = "eMail должен содержать символ @";
        }
        if (strlen($email) < $len = 4) {
            $this->messages["EMAIL"][] = "eMail должен быть больше $len символов";
        }

        if (empty($this->messages["EMAIL"])) {
            return $email;
        }
    }

    public function AddUser($arUser)
    {
        $arUser["LOGIN"] = $this->ValidationLogin($arUser["LOGIN"]);

        if ($arUser["PASSWORD"] !== $arUser["CONFIRM_PASSWORD"]) {
            $this->messages["PASSWORD"][] = "неверный повтор пароля";
        }
        $arUser["PASSWORD"] = $this->ValidationPassword($arUser["PASSWORD"]);

        $arUser["EMAIL"] = $this->ValidationEmail($arUser["EMAIL"]);

        if (empty($this->messages)) {
            if ($this->DB->query("INSERT INTO users(users_login, users_email, users_password, users_first_name, users_last_name, themes_id) VALUE('$arUser[LOGIN]', '$arUser[EMAIL]', '$arUser[PASSWORD]', '$arUser[FIRST_NAME]', '$arUser[LAST_NAME]', '1')")) {
                return $this->DB->insert_id;
            }
        }
        return false;
    }

    public function LogIn($arUser)
    {
        $arData["LOGIN"] = $this->ValidationLogin($arUser["LOGIN_OR_EMAIL"]);
        $arData["EMAIL"] = $this->ValidationEmail($arUser["LOGIN_OR_EMAIL"]);
        $arData["PASSWORD"] = $this->ValidationPassword($arUser["PASSWORD"]);

        if (!empty($arData["PASSWORD"]) && (!empty($arData["LOGIN"])) || !empty($arData["EMAIL"])) {
            $res = $this->DB->query("SELECT USERS_ID FROM users WHERE (users_login = '$arData[LOGIN]' OR users_email = '$arData[EMAIL]') AND users_password = '$arData[PASSWORD]'");
            if ($res) {
                $rows = $res->fetch_assoc();
                if (!empty($rows)) {
                    return $rows["USERS_ID"];
                }
            }
        }
        return false;
    }

    public function GetMessages()
    {
        return $this->messages;
    }

    public static function checkLogin()
    {
        if ($users_id = $_SESSION["USER_ID"]) {
            return true;
        }
        return false;
    }

    public function getByLogin($login)
    {
        $res = $this->DB->query("SELECT USERS_ID, USERS_LOGIN, USERS_EMAIL, USERS_FIRST_NAME, USERS_LAST_NAME, THEMES_ID FROM users WHERE users_login = '$login'");
        if ($res) {
            $arUser = $res->fetch_assoc();
            return $arUser;
        }
        return false;
    }

    public function getArCurrentUser()
    {
        $users_id = self::getCurrentUserID();
        $arUser = $this->getArUserByID($users_id);
        return $arUser;
    }
    
    public function getArUserByID(int $idUser = null) {
        if($idUser !== null) {
            $res = $this->DB->query("SELECT USERS_ID, USERS_LOGIN, USERS_EMAIL, USERS_FIRST_NAME, USERS_LAST_NAME, THEMES_ID FROM users WHERE users_id = $idUser");
            if($res) {
                $arUser = $res->fetch_assoc();
                return $arUser;
            }
        }
        return false;
    }

    public static function getCurrentUserID()
    {
        if ($users_id = $_SESSION["USER_ID"]) {
            return $users_id;
        }
        return false;
    }

    public function getTheme() {
        $users_id = self::getCurrentUserID();
        $res = $this->DB->query("SELECT t.THEMES_PATH FROM users u LEFT JOIN themes t ON u.themes_id = t.themes_id WHERE u.users_id = $users_id");
        if ($res) {
            $theme = $res->fetch_assoc();
        } else {
            $theme = array("THEMES_PATH" => "styles/themes/red.css");
        }
        return $theme;
    }

    public function updateUser($arUser)
    {
        $arUser["LOGIN"] = $this->ValidationLogin($arUser["LOGIN"]);

        if ($arUser["PASSWORD"] !== $arUser["CONFIRM_PASSWORD"]) {
            $this->messages["PASSWORD"][] = "неверный повтор пароля";
        }
        $arUser["PASSWORD"] = $this->ValidationPassword($arUser["PASSWORD"]);

        $arUser["EMAIL"] = $this->ValidationEmail($arUser["EMAIL"]);

        if (empty($this->messages)) {
            if ($this->DB->query("UPDATE users SET
                 users_login = '$arUser[LOGIN]',
                 users_email = '$arUser[EMAIL]',
                 users_password = '$arUser[PASSWORD]', 
                 users_first_name = '$arUser[FIRST_NAME]', 
                 users_last_name = '$arUser[LAST_NAME]',
                 themes_id = '$arUser[THEME]'")) {

                return true;
            }
        }
        return false;
    }
}