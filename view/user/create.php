{{ include('header.php', {title: 'User Create'}) }}
<body>
    <div class="container">
        <form action="{{path}}user/store" method="post">
            <span class="text-danger">{{ errors | raw }}</span>
            <label>Utilisateur
                <input type="text" name="username" value="{{user.username}}">
            </label>
            <label>Mot de passe
                <input type="password" name="password" value="">
            </label>
            <label>Privilege
                <select name="privilege_id">
                    <option value="">Selectionner un privilege</option>
                    {%  for privilege in privileges %} 
                    <option value="{{ privilege.id}}" {% if privilege.id == user.privilege_id %} selected {% endif %}>{{ privilege.privilege }}</option>
                    {% endfor %} 
                </select>
            </label>
            <input type="submit" value="sauvegarder" class="btn">
        </form>
    </div>
</body>
</html>