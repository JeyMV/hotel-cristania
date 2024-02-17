<?php
session_start();

unset($_SESSION["id_cliente"]);

header("location./");
?>
<script>
    window.location.href = "./"
</script>