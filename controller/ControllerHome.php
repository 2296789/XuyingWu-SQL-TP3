<?php
class ControllerHome extends Controller {
    public function index(){
        return Twig::render('home.php', [
            "article" => " Il s'agit d'un site de blog où vous pouvez publier des articles sur divers sujets et ajouter des commentaires.
            Les administrateurs sont divisés en deux catégories : les administrateurs et les employés, qui disposent de droits d'administration différents. L'administrateur peut se connecter et voir les dossiers pertinents en fonction des autorisations, et peut ajouter, modifier ou supprimer des articles.
            Si vous oubliez votre mot de passe, vous pouvez le réinitialiser par courrier électronique.
            Je vous invite à être attentif et à nous donner de précieux conseils. "
        ]);
    }

    public function error($e = null){
        return 'error '.$e;
    }
}
?>