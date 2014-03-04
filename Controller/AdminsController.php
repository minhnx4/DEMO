<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ManagerController
 *
 * @author Tha
 */
class AdminsController extends AppController {

    //put your code here
    public function beforeFilter() {
        
    }

    public function index() {
        
    }

    public function admin() {
        $this->loadModel('admin');
        $res = $this->admin->find('all');
        $this->set("res", $res);
        $notify = $this->request->params["named"]["notify"];
        if ($notify != null)
            echo $notify;
    }

    public function add_admin() {
        $this->loadModel('admin');
        $this->loadModel('user');
        $params = $this->data["Admin"];
        var_dump($params);
        $username = $params["username"];
        $password = $params["password"];
        $repassword = $params["repassword"];
        $email = $params["email"];
        $ip_address = $params["ip_address"];

        if ($repassword != $password) {
            $notify = "パスワードとリパスワードは違がいました";
            $this->redirect(array("controller" => "admins",
                "action" => "admin",
                "notify" => "パスワードとリパスワードは違った",
            ));
        } else {
            $count = $this->admin->find('count', array('conditions' => array("admin.username " => $username)));
            echo "count = " . $count;
            if ($count > 0)
                $notify = "このユーザ名が存在していました";
            else {
                $notify = "アカウントが作成されました";
                $this->admin->save(array("username" => $username, "password" => $password, "email" => $email, "ip_address" => $ip_address));
                $this->user->save(array("username" => $username, "password" => $password, "salt" => "0000", "active" => "1", "role" => "admin"));
            }
        }

        $this->redirect(array("controller" => "admins",
            "action" => "admin",
            "notify" => $notify,
        ));
    }

}
?>



