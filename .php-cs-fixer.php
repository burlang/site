<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

return
    (new Config())
        ->setCacheFile(__DIR__ . '/var/.php_cs')
        ->setFinder(
            Finder::create()
                ->in([
                    __DIR__ . '/bin',
                    __DIR__ . '/config',
                    __DIR__ . '/src',
                    __DIR__ . '/tests',
                ])
                ->exclude([
                ])
                ->append([
                    __DIR__ . '/public/index.php',
                    __FILE__,
                ])
        )
        ->setRiskyAllowed(true)
        ->setRules([
            '@PSR12' => true,
            '@PSR12:risky' => true,
            '@PHP81Migration' => true,
            '@PhpCsFixer' => true,
            '@PhpCsFixer:risky' => true,

            'declare_strict_types' => true,

            'ordered_imports' => ['imports_order' => ['class', 'function', 'const']],

            'concat_space' => ['spacing' => 'one'],
            'cast_spaces' => ['space' => 'none'],
            'binary_operator_spaces' => [
                'default' => 'single_space',
            ],

            'phpdoc_to_comment' => false,
            'phpdoc_separation' => false,
            'phpdoc_types_order' => ['null_adjustment' => 'always_last'],
            'phpdoc_align' => false,

            'operator_linebreak' => false,

            'global_namespace_import' => true,

            'blank_line_before_statement' => false,
            'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],

            'fopen_flags' => ['b_mode' => true],

            'yoda_style' => false,

            'static_lambda' => false,

            'echo_tag_syntax' => ['format' => 'short'],
            'no_alternative_syntax' => false,
        ]);
