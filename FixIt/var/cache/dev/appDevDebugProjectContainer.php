<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerQf0ozid\appDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerQf0ozid/appDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerQf0ozid.legacy');

    return;
}

if (!\class_exists(appDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerQf0ozid\appDevDebugProjectContainer::class, appDevDebugProjectContainer::class, false);
}

return new \ContainerQf0ozid\appDevDebugProjectContainer([
    'container.build_hash' => 'Qf0ozid',
    'container.build_id' => 'aca8faff',
    'container.build_time' => 1593993331,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerQf0ozid');