<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/src/app/utils/cet.qstprod.utils.httpdataprocessor.php');
$dataProcessor = new HTTPDataProcessor();
$status = isset($_GET['status']) ? $dataProcessor->processHttpFormData($_GET['status']) : '';
$status = $status === '' ? 'login' : $status;
$ticketUtlr = null;
$refutlrCdc = isset($_GET['refutlr']) ? $dataProcessor->processHttpFormData($_GET['refutlr']) : '';