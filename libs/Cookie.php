<?php
function setAlertCookie($alert)
{
    $cookie_name = "alert";
    $cookie_value = $alert;
    setcookie($cookie_name, $cookie_value, time() + 120, "/");
}
function clearAlertCookie()
{
    $cookie_name = "alert";
    setcookie($cookie_name, "", time() - 120, "/");
}
function setLockersCookie($lockers)
{
    $cookie_name = "lockers";
    $cookie_value = $lockers;
    setcookie($cookie_name, $cookie_value, time() + 36000, "/");
}
function clearLockersCookie()
{
    $cookie_name = "lockers";
    setcookie($cookie_name, "", time() - 36000, "/");
}

