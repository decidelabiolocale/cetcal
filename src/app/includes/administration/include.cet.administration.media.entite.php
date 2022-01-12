<!-- commentaire test -->
<link rel="stylesheet" href="/src/scripts/js/dropzone-5.7.0/dist/dropzone.css">
<div id="data-media-admin-entite-container" style="display: none;">
  <p style="margin-bottom: 2px; color: #6C3012 !important;">
    &#160;<i class="fas fa-folder-open"></i>&#160; images/photos associées :
  </p>
  <div class="row" id="espace-entite-media-listing">
    <p style="margin: 12px; color: rgb(30,40,30) !important;">Aucune image pour le moment...</p>
  </div>
  <div class="row justify-content-lg-start" id="cet-file-upload-dropzone-bloc-imgentite-container">
    <div class="col-12 cet-file-upload-dropzone-bloc">
      <form action="/src/app/controller/media/cet.qstprod.controller.media.form.php" 
        enctype="multipart/form-data"
        class="dropzone cet-file-upload-dropzone"
        id="cetFileDropzoneImgentite">
        <div class="dz-message" data-dz-message>
          <span>
            &#160;<i class="fas fa-file-upload"></i>&#160;
            Glisser-déposer ou cliquer pour ajouter des images...
          </span>
        </div>
        <div class="fallback">
          <input name="file" type="file" multiple />
        </div>
      </form>
    </div>
  </div>
</div>
<input type="text" name="entite-media-pkent-value" id="entite-media-pkent-value" value="" hidden="hidden">
<script src="/src/scripts/js/dropzone-5.7.0/dist/dropzone.js"></script>