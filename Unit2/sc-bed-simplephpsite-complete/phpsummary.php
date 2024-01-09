<!doctype html>
<html lang="en">

<?php include 'includes/head.php' ?>

<body>
        <?php include 'includes/menu.php' ?>

        <div class="container">
           <h1>PHP Summary</h1>
           <?php
           printf('<p>You are running PHP Version %s</p>', phpversion());

           echo '<h4>Loaded extensions</h4>';
           $ext = get_loaded_extensions();
           var_dump($ext);

           echo '<h4>Server environment</h4>';
           var_dump($_SERVER);

           ?>
</div>

<?php include 'includes/footer.php' ?>
</body>

</html>