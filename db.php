<?php
session_start();

$db = mysqli_connect('MySQL-8.4', 'root', '', 'Home');

if (!$db) exit('MySQL Error');