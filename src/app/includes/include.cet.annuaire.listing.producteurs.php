<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/controller/cet.annuaire.annuaire.controller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.annuaire.utils.format.php');
$utils = new FormatUtils();
$dataProcessor = new HTTPDataProcessor();
$filtre = isset($_GET['q']) ? $dataProcessor->processHttpFormData($_GET['q']) : false; 
$controller = new AnnuaireController();
$data_non_filtre = $controller->fetchAllFrontEndDTOArray();
$data = (isset($_GET['q'])) ? 
	$controller->filtrerProducteurs($filtre, $data_non_filtre) : $data_non_filtre;
?>

<div class="row">
  <div class="col-lg-12">
  	<h4>Parcourir et rechercher vos Producteur.e.s BIO.</h4>
		<p class="text-muted">Liste complète des Producteur.e.s répertoriés sur la région du Castillonnais depuis mai 2019. <b>Un total de <?= count($data_non_filtre); ?> producteur.e.s </b>répertoriés ou inscrits au <?= $utils->getDateTimeFr(); ?>.</p>
  </div>
</div>

<?php if (isset($_GET['q'])): ?>
<div class="row">
  <div class="col-lg-6">
  	<p class="cet-p">
  	<i class="fa fa-info-circle" aria-hidden="true"> </i> Total de <b><?= count($data); ?> producteur.e.s trouvé(e.s)</b> pour le mot clé "<span class="cet-r-q"><?= $dataProcessor->processHttpFormData($filtre) ?></span>".
  	</p>
  </div>
</div>
<?php endif; ?>

<div id="recherche-producteur-zone" class="row justify-content-lg-center cetcal-producteur-listing">
	<table class="table table-sm table-bordered overflow-auto" style="table-layout: fixed; width: 100%;">			
		<tr class="bg-light">
			<th scope="col" colspan="6">
				<div class="row cetcal-producteur-listing cetcal-producteur-listing-search" style="margin-top: 14px;">
					<div class="col-lg-6">
						<div class="input-group mb-3">
					  	<input type="text" class="form-control" placeholder="Entrer un critère de recherche: nom, commune, type de production, code postal..." aria-label="Entrer un critère de recherche" id="cet-annuaire-recherche-filtre" name="cet-annuaire-recherche-filtre" value="<?= !$filtre ? '' : $filtre; ?>" />			  
				    	<div class="input-group-append">
				    		<a class="btn" type="button" id="cet-annuaire-recherche-filtrer" 
                  href="/?statut=listing.producteurs&anr=true&q="
                  style="color: white !important; font-family: 'Signika' !important; background-color: #DD4215 !important;">
                  Rechercher <i class="fa fa-search" aria-hidden="true"></i>
                </a>
				    	</div>
				    	<div class="input-group-append">
				    		<a class="btn" type="button" 
                  href="/?statut=listing.producteurs&anr=true"
                  style="color: white !important; font-family: 'Signika' !important; background-color: #DD4215 !important;">
                  Supprimer le critère de recherche
                </a>
				    	</div>
				    </div>
				  </div>
				</div>
			</th>
		</tr>
		<thead>
	    <tr class="cetcal-producteur-listing-head-tr bg-light">
	      <th scope="col" style="width:15%; text-align: center;">Ferme</th>
	      <th scope="col" style="width:30%; text-align: center;">Informations produits</th>
	      <th scope="col" style="width:18%; text-align: center;">Adresse</th>
	      <th scope="col" style="width:15%; text-align: center;">Email</th>
	      <th scope="col" style="width:15%; text-align: center;">Liens</th>
	      <th scope="col" style="width:7%; text-align: center;">Directions</th>
	    </tr>
  	</thead>
	  <tbody>
	  	<?php foreach ($data as $prdDto): ?>
	  		<tr class="cetcal-producteur-listing-datarow">
	  			<td class="prd-listing-nom-ferme">
	  				<span class="prd-listing-mat-prd"><?= $prdDto->getPk(); ?></span>
	  				<?= $prdDto->nomferme; ?>
	  			</td>
	  			<td>
	  					<?php if ($prdDto->prodInscrit === 'true'): ?>
	  						<ul>
			  					<?php $types = explode('µ', $prdDto->typeDeProduction); ?>
					  			<?php foreach ($types as $type): ?>
					  				<?php if (empty($type)) continue; ?>
					  				<li><?= $type; ?></li>
					  			<?php endforeach; ?>
				  			</ul>
				  		<?php endif; ?>
			  			<?php if($prdDto->prodInscrit === 'false'): ?>
				  			<?= $prdDto->produitsLtrl; ?>
				  		<?php endif; ?>
		  		</td>
	  			<?php
			      $adr = $prdDto->prodInscrit === 'false' ? $prdDto->adrfermeLtrl : str_replace("  ", " ", $prdDto->adrNumvoie.' '.$prdDto->adrRue.' '.$prdDto->adrLieudit.' '.$prdDto->adrCommune.' '.$prdDto->adrCodePostal.' '.$prdDto->adrComplementAdr);
			      $adrcrt = str_replace(" ", "%20", $adr);
			    ?>
	  			<td><?= $adr; ?></td>
	  			<td>
	  				<?php if ($prdDto->prodInscrit === 'true'): ?>
	  					<a href="mailto:<?= $prdDto->email; ?>"><?= $prdDto->email; ?></a>
	  				<?php else: ?>
	  					<span class="text-muted"><i>non renseigné</i></span>
	  				<?php endif; ?>
	  			</td>
	  			<td>
	  				<ul>
		  				<?php if ($prdDto->prodInscrit === 'true'): ?>
		  					<?php if (!empty($prdDto->pageFB)): ?>
		  						<li><a href="<?= $prdDto->pageFB; ?>" target="_blank"><?= $prdDto->pageFB; ?></a></li>
		  					<?php endif; ?>
		  					<?php if (!empty($prdDto->pageIG)): ?>
		  						<li><a href="<?= $prdDto->pageIG; ?>" target="_blank"><?= $prdDto->pageIG; ?></a></li>
		  					<?php endif; ?>
		  					<?php if (!empty($prdDto->groupeCagette)): ?>	
		  						<li><a href="<?= $prdDto->groupeCagette; ?>" target="_blank"><?= $prdDto->groupeCagette; ?></a></li>
		  					<?php endif; ?>
		  					<?php if (!empty($prdDto->siteWebUrl)): ?>
		  						<li><a href="<?= $prdDto->siteWebUrl; ?>" target="_blank"><?= $prdDto->siteWebUrl; ?></a></li>
		  					<?php endif; ?>
		  					<?php if (!empty($prdDto->boutiqueEnLigneUrl)): ?>
		  						<li><a href="<?= $prdDto->boutiqueEnLigneUrl; ?>" target="_blank"><?= $prdDto->boutiqueEnLigneUrl; ?></a></li>
		  					<?php endif; ?>
		  					<?php if (!empty($prdDto->pageTwitter)): ?>
		  						<li><a href="<?= $prdDto->pageTwitter; ?>" target="_blank"><?= $prdDto->pageTwitter; ?></a></li>
		  					<?php endif; ?>
		  				<?php elseif ($prdDto->prodInscrit === 'false'): ?>
		  					<?php $urlsmtpl = explode(";", $prdDto->urlMultiplesLtrl); ?>
		  					<?php foreach ($urlsmtpl as $url): ?>
				  				<?php if (empty($url)) continue; ?>
				  				<li><a href="<?= $url; ?>" target="_blank"><?= $url; ?></a></li>
				  			<?php endforeach; ?>
		  				<?php endif; ?>
	  				</ul>
	  			</td>
	  			<td style="vertical-align: middle; text-align: center;">
	  				<?php $lL = explode('/', $prdDto->getLatLng()); ?>
	  				<a href="https://www.google.com/maps?q=<?= $lL[1] ?>,<?= $lL[0] ?>&zoom=30" target="_blank">
	  					<i class="fas fa-street-view" style="font-size:38px; color: #DD4215"></i>
	  				</a>
	  			</td>
	  		</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<?php if ($filtre !== false && count($data) === 0):?>
		<div class="row justify-content-lg-center" style="margin-bottom: 80px; margin-top: -100px; z-index: 100;">
		  <div class="col-md-12">
		    <div class="alert alert-danger alert-dismissible fade show" role="alert">
		      <p>
		        Aucun résultat pour le mot clé "<span class="cet-r-q"><?= $dataProcessor->processHttpFormData($filtre) ?></span>".<br>
		        <i class="fa fa-info-circle" aria-hidden="true"> </i> Essayer avec le nom d'une commune, un code postal, le nom ou prénom du producteur.e recherché(e), un nom de produit...
		      </p>
		      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">&times;</span>
		      </button>
		    </div>
		  </div>
		</div>
	<?php endif; ?>
</div>
<script src="/src/scripts/js/cetcal/cetcal.recherche.min.js"></script>