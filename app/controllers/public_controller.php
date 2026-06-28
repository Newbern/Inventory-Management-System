<?php

class Public_Controller {

    // This function just sets up the base with css, js and the layouts needed
    public function setup($page) {
        // Including css & js
        $CSS = "public/assets/css/$page.css";
        $JS = "public/assets/js/$page.js";

        // URL for including HTML content
        $url = "public/pages/$page";

        // Including Html Page Specific Content 
        if (file_exists("$url.php")) {
            $HTML = "$url.php";
        }
        elseif (file_exists("$url.html")) {
            $HTML = "$url.html";
        }
        else {
            $HTML = 'public/pages/404.html';
        }

        // This will return the file locations of the scripts
        return [
            'CSS'=> $CSS,
            'JS' => $JS,
            'HTML'=> $HTML
        ];
    }

    // These are all the callable methods that will run different pages by the router
    public function home() {
        $page = $this->setup("home");
        require ROOT . "public/layouts/base.php";
    }
    public function test(){
        $page = $this->setup("test");
        require ROOT . "public/layouts/base.php";
    }
    public function Error() {
        $page = $this->setup("404");
        require ROOT . "public/layouts/base.php";
    }
    public function login() {
        $page = $this->setup("login");
        require ROOT . "public/layouts/base.php";
    }
    public function signin() {
        $page = $this->setup("signin");
        require ROOT . "public/layouts/base.php";
    }

}