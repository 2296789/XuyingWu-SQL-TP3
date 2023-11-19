<?php
RequirePage::model('CRUD');
RequirePage::model('Article');
RequirePage::model('Categorie');
RequirePage::model('Auteur');
RequirePage::model('Commentaire');
RequirePage::library('Validation');
RequirePage::library('CheckSession');


class ControllerArticle extends controller {
    public function index(){
        $article = new Article;
        $selectCategoriesAuteur = $article->articleCategoriAuteur();
        return Twig::render('article-index.php', [
            'articles'=>$selectCategoriesAuteur
        ]);
    }

    public function show($id){
        $article = new Article;
        $selectId = $article->selectId($id);
        $categorie = new Categorie;
        $selectCategorie = $categorie->selectId($selectId['categorie_id']);
        $auteur = new Auteur;
        $selectAuteur = $auteur->selectId($selectId['auteur_id']);

        return Twig::render('article-show.php', [
            'article'=>$selectId, 
            'categorie'=>$selectCategorie,
            'auteur'=>$selectAuteur
        ]);
    }

    public function edit($id){
        $article = new Article;
        $selectId = $article->selectId($id);
        $categorie = new Categorie;
        $selectCategories = $categorie->select('categorie');
        $auteur = new Auteur;
        $selectAuteurs = $auteur->select('nom');
        
        return Twig::render('article-edit.php', [
            'article'=>$selectId, 
            'categories'=>$selectCategories,
            'auteurs'=>$selectAuteurs
        ]);
    }

    public function create(){
        $categorie = new Categorie;
        $selectCategories = $categorie->select('categorie');
        $auteur = new Auteur;
        $selectAuteurs = $auteur->select('nom');
    
        return Twig::render('article-create.php', [
            'categories'=>$selectCategories,
            'auteurs'=>$selectAuteurs 
        ]);
    }

    public function store(){
        $validation = new Validation;
        extract($_POST);
        $validation->name('titre')->value($titre)->max(200)->min(1);
        $validation->name('texte')->value($texte)->max(1000)->min(1);
        $validation->name('categorie')->value($categorie_id)->pattern('int')->required();
        $validation->name('auteur')->value($auteur_id)->pattern('int')->required();

        if(!$validation->isSuccess()){
            $categorie = new Categorie;
            $selectCategories = $categorie->select('categorie');
            $auteur = new Auteur;
            $selectAuteurs = $auteur->select('nom');

            $errors = $validation->displayErrors();
            return Twig::render('article-create.php', [
                'categories'=>$selectCategories,
                'auteurs'=>$selectAuteurs,
                'errors'=>$errors, 
                'article'=>$_POST
            ]);
            exit();
        }
        $article = new Article;
        $insert = $article->insert($_POST);
        RequirePage::url('article/show/'.$insert);
    }

    public function update(){
        $validation = new Validation;
        extract($_POST);
        $validation->name('titre')->value($titre)->max(200)->min(1);
        $validation->name('texte')->value($texte)->max(1000)->min(1);
        $validation->name('categorie')->value($categorie_id)->pattern('int')->required();
        $validation->name('auteur')->value($auteur_id)->pattern('int')->required();
 
        if(!$validation->isSuccess()){
            $categorie = new Categorie;
            $selectCategories = $categorie->select('categorie');
            $auteur = new Auteur;
            $selectAuteurs = $auteur->select('nom');

            $errors =  $validation->displayErrors();
            return Twig::render('article-edit.php', [
                'categories'=>$selectCategories,
                'auteurs'=>$selectAuteurs,
                'errors'=>$errors, 
                'article'=>$_POST
            ]);
            exit();
        }
         
        $article = new Article;
        $update = $article->update($_POST);

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
        RequirePage::url('article/show/'.$_POST['id']);
    }

    public function destroy(){
        // print_r($_POST);die();
        CheckSession::sessionAuth();
        if($_SESSION['privilege'] == 1){
            $article = new Article;
            $update = $article->delete($_POST['id']);
            RequirePage::url('article/index');
        }else{
            RequirePage::url('login');
        }
    }
}
?>