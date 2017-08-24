<?php

class SiteController {
	
    public function actionIndex()
    {
        require_once(ROOT . '/views/index.php');
        return true;
    }

    public function actionContact()
    {
        require_once(ROOT . '/views/contacts.php');
        return true;
    }
} 