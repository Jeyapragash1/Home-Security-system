<?php
require_once 'classes/DbConnector.php';
require_once 'classes/DataExporter.php';

$dbConnector = new DbConnector();
$pdo = $dbConnector->getConnection();

$exporter = new DataExporter($pdo);
$exporter->exportToPDF();
?>