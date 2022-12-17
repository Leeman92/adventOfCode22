<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->in(__DIR__)
;

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@PSR12' => true,
    '@Symfony' => true,
    'strict_param' => true,
    'array_syntax' => ['syntax' => 'short'],
    'align_multiline_comment' => ['comment_type' => 'phpdocs_like'],
    'array_indentation' => true,
])
    ->setFinder($finder)
    ;