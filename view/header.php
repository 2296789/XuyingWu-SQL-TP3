<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ title }}</title>
        <link rel="stylesheet" href="{{path}}css/style.css">
    </head>
    <nav>
        <ul>
            <li><a href="{{path}}">Home</a></li>
            <li><a href="{{path}}article">Articles</a></li>
            {% if guest %}
            <li><a href="{{path}}login">Login</a></li>
            {% else %}
            <li><a href="{{path}}article/create">Article Create</a></li>
                {% if session.privilege == 1 %}
                <li><a href="{{path}}user">Users</a></li>
                {% endif %}
            <li><a href="{{path}}login/logout">Logout</a></li>
            {% endif %}
            <a class = 'username'>{{ session.username }}</a>
            {% if session.lang == fr %}
            <a class="btn-lang">FR</a>
            {% else %}
            <a class="btn-lang">EN</a>
            {% endif %}
        </ul>
    </nav>
 