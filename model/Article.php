<?php
class Article extends CRUD {
    protected $table = 'article';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'titre', 'texte', 'auteur_id', 'categorie_id'];


    public function articleCategoriAuteur(){
        $sql = "SELECT article.id, article.titre, article.texte, auteur.nom AS auteur, categorie.categorie AS categorie
                FROM $this->table 
                JOIN auteur ON auteur.id = $this->table.auteur_id
                JOIN categorie ON categorie.id = $this->table.categorie_id
                ORDER BY article.titre";
        $stmt = $this->query($sql);
        $articleCategoriAuteur = $stmt->fetchAll();
        return $articleCategoriAuteur;
    }
}
?>