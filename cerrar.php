<?php

if(SESSION_STATUS()== PHP_SESSION_NONE){
    session_start();
}
session_destroy();
header("Location:login.html");
exit();