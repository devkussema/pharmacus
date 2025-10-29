<?php
// scripts/add_migration_idempotency.php
// Roda no workspace: php scripts/add_migration_idempotency.php

$dir = __DIR__ . '/../database/migrations';
$files = glob($dir . '/*.php');
$modified = [];
foreach ($files as $file) {
    $orig = file_get_contents($file);
    $content = $orig;

    // Add idempotency for Schema::create(..., function(...) { ... });
    // matches first arg and function body
    $pattern = '/Schema::create\(\s*([^,]+)\s*,\s*function\s*\([^)]*\)\s*\{([\s\S]*?)\}\s*\)\s*;/m';
    $content = preg_replace_callback($pattern, function($m) {
        $arg = trim($m[1]);
        $body = $m[2];
        // Build replacement: if (!Schema::hasTable(ARG)) { Schema::create(ARG, function(...) { BODY }); }
        // Keep indentation by prefixing with 8 spaces
        $replacement = "if (!Schema::hasTable({$arg})) {\n        Schema::create({$arg}, function (\$table) {{$body}});\n        }";
        return $replacement;
    }, $content, -1, $count);

    // Add idempotency for Schema::drop('table'); -> if (Schema::hasTable('table')) { Schema::drop('table'); }
    $patternDrop = '/Schema::drop\(\s*([^\)]+)\s*\)\s*;/m';
    $content = preg_replace_callback($patternDrop, function($m){
        $arg = trim($m[1]);
        // if it's already dropIfExists keep
        if (strpos($m[0], 'dropIfExists') !== false) return $m[0];
        return "if (Schema::hasTable({$arg})) { Schema::drop({$arg}); }";
    }, $content, -1, $countDrop);

    // Only write if changed
    if ($content !== $orig) {
        // backup
        copy($file, $file . '.bak');
        file_put_contents($file, $content);
        $modified[] = [
            'file' => $file,
            'createsWrapped' => ($count ?? 0),
            'dropsWrapped' => ($countDrop ?? 0)
        ];
    }
}

echo "Processed " . count($files) . " migration files.\n";
if (count($modified) === 0) {
    echo "No changes necessary.\n";
} else {
    echo "Modified files:\n";
    foreach ($modified as $m) {
        echo " - " . $m['file'] . " (create wrapped: " . $m['createsWrapped'] . ", drop wrapped: " . $m['dropsWrapped'] . ")\n";
    }
}

return 0;
