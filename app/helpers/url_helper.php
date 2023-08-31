<?php
//Simple Page Redirect
function redirect($pageLocation){
    header('location: ' . URLROOT . '/' . $pageLocation);
}