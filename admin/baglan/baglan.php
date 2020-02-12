<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=mediawbh;charset=utf8", "root", "12345678");
    
} catch ( PDOException $e ){
     print $e->getMessage();
}
?>