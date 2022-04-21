<?php
session_start();

if (isset($_SESSION['id'])) {
  session_destroy();
  header('Location: ../home/index.php');
}