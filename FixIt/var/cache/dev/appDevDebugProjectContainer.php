<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container9ykm7u3\appDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container9ykm7u3/appDevDebugProjectContainer.php') {
    touch(__DIR__.'/Container9ykm7u3.legacy');

    return;
}

if (!\class_exists(appDevDebugProjectContainer::class, false)) {
    \class_alias(\Container9ykm7u3\appDevDebugProjectContainer::class, appDevDebugProjectContainer::class, false);
}

return new \Container9ykm7u3\appDevDebugProjectContainer([
    'container.build_hash' => '9ykm7u3',
    'container.build_id' => 'dcfd3081',
    'container.build_time' => 1595186445,
], __DIR__.\DIRECTORY_SEPARATOR.'Container9ykm7u3');
