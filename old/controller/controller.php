<?php

require('../model/model.php');

function index()
{
    require('../view/frontend/indexView.php');
}

function post()
{
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require('../view/frontend/postView.php');
}