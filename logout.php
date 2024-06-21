<?php
    require("./functions/app.php");
    isntAuth();
    $_SESSION = [];
    header("location: /");