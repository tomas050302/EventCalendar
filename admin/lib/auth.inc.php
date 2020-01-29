<?php
@session_start();

if (!isset($_SESSION['isLogged'])) {
  header('location: login.html');
  exit;
}
