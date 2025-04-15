<?php

require_once __DIR__ . '/src/Autoloader.php';
Dompdf\Autoloader::register();

// Use forward slashes for all paths
require_once __DIR__ . '/lib/Cpdf.php'; 

require_once __DIR__ . '/lib/HTML5.php'; 
require_once __DIR__ . '/lib/HTML5/Entities.php'; 
require_once __DIR__ . '/lib/HTML5/Parser/EventHandler.php'; 
require_once __DIR__ . '/lib/HTML5/Parser/CharacterReference.php'; 
require_once __DIR__ . '/lib/HTML5/Parser/TreeBuildingRules.php'; 
require_once __DIR__ . '/lib/HTML5/Parser/Scanner.php'; 
require_once __DIR__ . '/lib/HTML5/Parser/UTF8Utils.php'; 
require_once __DIR__ . '/lib/HTML5/Parser/Tokenizer.php'; 
require_once __DIR__ . '/lib/HTML5/Elements.php'; 
require_once __DIR__ . '/lib/HTML5/Serializer/RulesInterface.php'; 
require_once __DIR__ . '/lib/HTML5/Serializer/Traverser.php'; 
require_once __DIR__ . '/lib/HTML5/Serializer/OutputRules.php'; 
require_once __DIR__ . '/lib/HTML5/Parser/DOMTreeBuilder.php'; 
