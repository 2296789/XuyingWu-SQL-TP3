{{ include('header.php', {title:'Home'}) }}

<?php
if(($_SESSION['lang'] == 'FR')) 
    require_once('./library/FR.php');
else 
    require_once('./library/EN.php');
?>

<body>
    <div class="container">
        <h1><?= $lang['text_home_titre'] ?>Bienvenue dans mon projet MVC !</h1>
        {{ article }}
    </div>
</body>
</html>
