{{ include('header.php', {title: 'Login'}) }}
<body>
    <div class="container">
        <form action="{{path}}login/tempPass" method="post">
            <h3>Mot de passe oublié</h3>
            <span class="text-danger">{{ errors | raw }}</span>
            <label>Utilisateur
                <input type="text" name="username" value="{{user.username}}">
            </label>
            <input type="submit" value="Reset" class="btn">
        </form>
    </div>
</body>
</html>