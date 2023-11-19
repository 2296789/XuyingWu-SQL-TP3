{{ include('header.php', {title:'Article'}) }}

<body>
    <div class="container">
        <h1>Liste d'Articles</h1>
        
        <p><strong>Titre : </strong>{{ article.titre }}</p>
        <p><strong>Categorie : </strong>{{ categorie.categorie }}</p>
        <p><strong>Auteur : </strong>{{ auteur.nom }}</p>
        <p>{{ article.texte }}</p>
        <br><br>
        <a href="{{path}}article/edit/{{ article.id }}" class="btn">Modifier</a>
    </div>
</body>
</html>