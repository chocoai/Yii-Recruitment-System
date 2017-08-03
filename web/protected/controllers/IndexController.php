<?php

class IndexController extends Controller
{

    public function filters()
    {
        return array('rights');
    }

    /**
     * 控制台首页
     */
    public function actionIndex()
    {
        $this->render('index');
    }
}