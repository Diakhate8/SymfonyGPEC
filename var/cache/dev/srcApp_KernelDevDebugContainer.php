<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerPeRWDMl\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerPeRWDMl/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerPeRWDMl.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerPeRWDMl\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerPeRWDMl\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'PeRWDMl',
    'container.build_id' => 'c67fbb4e',
    'container.build_time' => 1615541790,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerPeRWDMl');