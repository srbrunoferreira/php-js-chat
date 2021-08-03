<?php

require_once('config.php');

class Messager
{
    private string $driver = DATABASE['DRIVER'];
    private string $host = DATABASE['HOST'];
    private string $dbname = DATABASE['DBNAME'];
    private string $user = DATABASE['USER'];
    private string $password = DATABASE['PASSWORD'];

    private array $ALLOWED_REQUEST_TYPES = ['GET_MESSAGES', 'PUT_MESSAGE'];

    private object $conn;

    public function __construct()
    {
        $this->conn = new PDO($this->driver . ':host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->password);

        $request = json_decode(file_get_contents('php://input', FILE_TEXT));

        if (
            isset($request->type) && isset($request->nickname) && isset($request->userId) &&
            !empty($request->type) && !empty($request->nickname) && !empty($request->userId) && $request->type === $this->ALLOWED_REQUEST_TYPES[0]
            ||
            isset($request->type) && isset($request->msg) && isset($request->nickname) && isset($request->userId) &&
            !empty($request->type) && !empty($request->msg) && !empty($request->nickname) && !empty($request->userId) && $request->type === $this->ALLOWED_REQUEST_TYPES[1]
        ) {
            // echo 'ALL OK<hr>';
            switch ($request->type) {
                case $this->ALLOWED_REQUEST_TYPES[0]:
                    // echo 'GET_MESSAGES<hr>';
                    $this->getAllMessages($request->userId, $request->nickname);
                    break;
                
                default:
                    // echo 'PUT_MESSAGE<hr>';
                    $this->putMessage($request->msg, $request->nickname, $request->userId);
                    break;
            }
        }
    }

    private function getAllMessages(string $userId, string $nickname): void
    {
        $userId = filter_var($userId, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nickname = filter_var($nickname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $query = $this->conn->prepare('SELECT msg, _user_id, user_nickname FROM _message');
        $query->execute();
        // echo 'GET_ALL_MESSAGES<hr>';
        echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));

        // foreach($query->fetchAll(PDO::FETCH_ASSOC) as $message) {
        //     if ($message['_user_id'] === $userId) {
        //         $msg = 
        //         "<div class='msg current-user-msg'>" .
        //             "<p>" . $message['msg'] . "</p>" .
        //         "</div>";
        //     } else {
        //         $msg =
        //         "<div class='msg another-user-msg'>" .
        //             "<p>" . $message['msg'] . "</p>" .
        //         "</div>";
        //     }

        //     echo $msg;
        // }
    }

    private function putMessage(string $msg, string $nickname, string $userId): void
    {
        $msg = filter_var($msg, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nickname = filter_var($nickname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $userId = filter_var($userId, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $query = $this->conn->prepare('INSERT INTO _message(msg, _user_id, user_nickname) VALUES(:msg, :userId, :nickname)');
        $query->bindValue(':msg', $msg, PDO::PARAM_STR);
        $query->bindValue(':userId', $userId, PDO::PARAM_STR);
        $query->bindValue(':nickname', $nickname, PDO::PARAM_STR);
        $query->execute();
        // echo 'PUT_MESSAGE<hr>';
    }
}

new Messager();