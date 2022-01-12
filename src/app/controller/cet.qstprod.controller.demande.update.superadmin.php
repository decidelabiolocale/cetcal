<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
$sup_admin_pk = $dataProcessor->processHttpFormData($_GET['sau_pk']);
$cetcal_session_id = $dataProcessor->processHttpFormData($_GET['sau_sitkn']);
$pk_producteur = $dataProcessor->processHttpFormData($_GET['sau_pkprd']);

var_dump([$sup_admin_pk, $cetcal_session_id, $pk_producteur]);

require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/model/cet.qstprod.build.form.questionnaire.post.model.php');
$model = new QSTPRODProducteurPOSTModel();
$forms_questionnaire = $model->reloadForms($pk_producteur);

require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.sessionshelper.php');
$sessionHelper = new SessionHelper($_SERVER['DOCUMENT_ROOT']);
$sessionHelper->setSessionUpdateContext($cetcal_session_id, $forms_questionnaire, $pk_producteur);
$sessionHelper->activateSessionUpdateContextSuperAdmin($cetcal_session_id);

// Apply navigation :
header('Location: /?statut=signupgen.form&sitkn='.$cetcal_session_id);
exit();