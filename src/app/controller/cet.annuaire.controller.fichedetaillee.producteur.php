<?php
require_once('cet.annuaire.annuaire.controller.php');

/**
 *
 */
class CETCALAnnuaireFicheDetailleController extends AnnuaireController
{
    function __construct() { }

    public function fetchProducteurByPk($pk)
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
        $model = new QSTPRODProducteurModel();
        $result = $model->findProducteurByPk($pk);
        return $result;
    }

    public function fetchLieuByPkProducteur($pk)
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
        $model = new QSTPRODProducteurModel();
        $result = $model->findLieuByProducteurByPk($pk);
        return $result;
    }
    public function fetchProduitByPkProducteur($pk)
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
        $model = new QSTPRODProducteurModel();
        $result = $model->findProduitByPkProducteur($pk);
        return $result;
    }

    public function fetchCategorieProduitByPkProducteur($pk)
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
        $model = new QSTPRODProducteurModel();
        $result = $model->findCategoriesProduitsByPkProducteur($pk);
        return $result;
    }

    public function fetchAllLieuDistByPkProducteur($pk)
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.lieuxdist.model.php');
        $model = new QSTPRODLieuModel();
        $result = $model->selectAllLieuxDistByPkProducteur($pk);
        return $result;
    }

    public function fetchProducteursDerniersInscrit($limit)
    {
        require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.producteurs.model.php');
        $model = new QSTPRODProducteurModel();
        $result = $model->fetchProducteursDerniersInscrit($limit);
        return $result;
    }

}






