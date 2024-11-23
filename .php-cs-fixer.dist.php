<?php

/** @var PhpCsFixer\Finder $finder */
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude([
        'bootstrap',
        'node_modules',
        'storage',
        'vendor',
        'docker'
    ])
    ->name('*.php')
    ->notName('server.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

/** @var PhpCsFixer\Config $config */
$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        'indentation_type' => true,
        'binary_operator_spaces' => ['default' => 'align_single_space_minimal'],
        'braces' => ['allow_single_line_closure' => true], // Permitir cierre de una sola línea
        'no_blank_lines_before_namespace' => false,        
        'no_unused_imports' => true,
        'no_extra_blank_lines' => false, // Líneas adicionales al final del archivo
        'single_blank_line_at_eof' => false, // Línea en blanco simple al final
    ])
    // ->setCacheFile(null) // Desactiva el caché
    ->setIndent("  ") // Indentación a 2 espacios
    ->setLineEnding("\n")
    ->setFinder($finder);
