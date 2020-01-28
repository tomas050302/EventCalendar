<?php
session_start();
session_unset();

header("Refresh:0.5; url=../index.html");
