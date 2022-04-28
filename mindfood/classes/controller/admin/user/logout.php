<?php
session_start();

if (isset($_SESSION['admin']['id'])) {
  session_destroy();
  $_SESSION['admin'] = null;
  header('Location: ../home/index.php');
}