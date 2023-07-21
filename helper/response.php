<?php
function addHeader($header,$statusCode,$replace){
    header($header,$replace,$statusCode);
}