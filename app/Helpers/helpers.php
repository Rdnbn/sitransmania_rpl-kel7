<?php

function clean($value)
{
    return htmlspecialchars(strip_tags($value));
}