{{ include('header.php', {title:'Article'}) }}

<body>
    <div class="container">
        <h1>Liste D'Aritcle</h1>
        <table>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Categorie</th>
                <th></th>
            </tr>
            {% for article in articles %}
            <tr>
                <td><a href="{{path}}article/show/{{ article.id }}">{{ article.titre }}</a></td>
                <td>{{ article.auteur }}</td>
                <td>{{ article.categorie }}</td>
                {% if guest==false %}
                <td>
                    <form action="{{path}}article/destroy" method="post">
                        <input type="hidden" name="id" value="{{ article.id }}">
                        <input type="submit" value="Delete" class="btn-danger" {% if session.privilege != 1 %} disabled {% endif %}>
                    </form>
                </td>
                {% endif %}
            </tr>
            {% endfor %}
        </table>
        <br><br>
        {% if session.privilege == 1 or session.privilege == 2 %}
        <a href="{{path}}article/create" class="btn">Ajouter</a>
        {% endif %}
    </div>   
</body>
</html>