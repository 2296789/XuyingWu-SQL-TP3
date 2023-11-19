{{ include('header.php', {title:'Article Create'}) }}

<body>
    <div class="container">
        <form action="{{path}}article/store" method="post">
            <label>Titre
                <textarea class="titre" type="text" name="titre" value="">{{ article.titre }}</textarea>
            </label>

            <label>Texte
                <textarea class="texte" type="text" name="texte" value="">{{ article.texte }}</textarea>
            </label>

            <label>Categorie
                <select name="categorie_id">
                    <option value="">Selcectionner un categorie</option>
                    {% for categorie in categories %}
                    <option value="{{ categorie.id }}" {% if categorie.id== article.categorie_id %} selected {% endif %}>{{ categorie.categorie }}</option>
                    {% endfor %}
                </select>
            </label>

            <label>Auteur
                <select name="auteur_id">
                    <option value="">Selcectionner un auteur</option>
                    {% for auteur in auteurs %}
                    <option value="{{ auteur.id }}" {% if auteur.id== article.auteur_id %} selected {% endif %}>{{ auteur.nom }}</option>
                    {% endfor %}
                </select>
            </label>

            <span class="text-danger">{{ errors | raw }}</span>
            <input type="submit" value="save" class="btn">
        </form>
    </div>
</body>
</html>