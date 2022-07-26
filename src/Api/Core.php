<?php

namespace Api;

use Api\Reqres;

class Core
{

    private $reqres;

    public function __construct()
    {
        $this->reqres = new ReqresUser();

        // Just set some get params if empty
        $this->prepare();

        // Keep it simple but dirty, without routing...
        $userID = $this->sanitize($_GET['user_id']);
        $page   = $this->sanitize($_GET['page']);


        // Single user
        if ( ! empty($userID)) {
            $data =$this->reqres->getUser($userID);

            if (!$data) {
                // Bad JSON or empty
                $this->sendJson(array('msg' => 'user not found', 'status' => 'error'), 201);
            } else {
                // JSON OK
                $this->sendJson($data);
            }

            return;
        }

        // List of users
        if ( ! empty($page)) {
            $data = $this->reqres->getList($page);
            if (empty($data->data) || !$data) {
                // Bad JSON or empty
                $this->sendJson(array('msg' => 'no users on this page', 'status' => 'error'), 201);
            } else {
                // JSON OK
                $this->sendJson($data);
            }


            return;
        }

        $this->sendJson(array('msg' => 'no hook matched', 'status' => 'error'), 201);
    }


    public function sendJson($data, $status = 200) {
        header( 'Content-Type: application/json; charset=utf-8');
        header("HTTP/1.1 {$status}");
        echo json_encode($data);
        die();
    }


    public function prepare()
    {
        if ( ! isset($_GET['user_id'])) {
            $_GET['user_id'] = '';
        }

        if ( ! isset($_GET['page'])) {
            $_GET['page'] = '';
        }
    }


    public function sanitize($string)
    {
        return addslashes(htmlspecialchars(trim($string)));
    }


}