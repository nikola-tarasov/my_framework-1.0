<?php


class Posts {
    public function indexAction()
    {
        echo "Posts::index";
    }


    
    public function testAction()
    {
        echo "Posts::test";
    }
    public function testPageAction()
    {
        echo "Posts::testPage";
    }

    public function before()
    {
        echo "Posts::before";
    }
}