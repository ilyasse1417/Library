<?php

namespace Application\Controller;
// An abstract class that other controllers will inherit from
abstract class AbstractController
{
    public $httpGet; // $_GET data
    public $httpPost; // $_POST data
    public $httpFiles; // $_FILESs data
    public $httpSession; // $_SESSION data
    public $flashMessages = [];

    public function __construct()
    {
        $this->startSession();
        $this->httpFiles = $_FILES;
        $this->httpGet = $_GET;
        $this->httpPost = $_POST;
        $this->httpSession = $_SESSION;
    }

    public function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }

    public function startSession()
    {
        if (!$this->httpSession) {
            session_start();
        }
    }

    public function destroySession()
    {
        // TODO check if session is already stared
        if ($this->httpSession) {
            session_destroy();
        }
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function getSession($key)
    {
        $value = isset($_SESSION[$key]) ?  $_SESSION[$key] : null;
        return $value;
    }
    public function removeSession($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public function getUser()
    {
        return $this->httpSession['user'] ?? null; // $_SESSION['user']
    }

    public function isAdmin($user)
    {
        return $user->getRole() ?? false;
    }

    public function renderView($view, $vars = [], $layout = 'layout.view.php')
    {
        ob_start();
        extract($vars);
        require $view;
        $content = ob_get_clean();
        extract(
            [
                'content' => $content,
                'user' => $this->getUser()
            ]
        );
        require 'templates/' . $layout;
    }

    public function view()
    {
    }

    public function addFlashMessage($type, $message)
    {
        // TODO user function to get session
        $_SESSION['flashMessages'][] = ['type' => $type, 'message' => $message];
    }

    function printFlashMessages()
    {
        $flashMessages = $this->getSession('flashMessages');
        if (!$flashMessages) return;

        $html = '';
        foreach ($flashMessages as $msg) {
            $class = $msg['type'] == 'error' ? 'danger' : 'success';
            $html .= sprintf(
                '<div class="alert alert-%s">%s</div>',
                $class,
                $msg['message']
            );
        }
        // on affiche le messge puis on le supprime de la session
        $this->removeSession('flashMessages');
        echo $html;
    }
}
