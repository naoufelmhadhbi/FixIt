<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'argument_resolver.service' shared service.

include_once $this->targetDirs[3].'\\vendor\\symfony\\symfony\\src\\Symfony\\Component\\HttpKernel\\Controller\\ArgumentValueResolverInterface.php';
include_once $this->targetDirs[3].'\\vendor\\symfony\\symfony\\src\\Symfony\\Component\\HttpKernel\\Controller\\ArgumentResolver\\ServiceValueResolver.php';

return $this->services['argument_resolver.service'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\ServiceValueResolver(new \Symfony\Component\DependencyInjection\ServiceLocator(['AppBundle\\Controller\\DefaultController:updatePost' => function () {
    return ${($_ = isset($this->services['service_locator.3qmptsx']) ? $this->services['service_locator.3qmptsx'] : $this->load('getServiceLocator_3qmptsxService.php')) && false ?: '_'};
}, 'AppBundle\\Controller\\DemandeurController:updatePost' => function () {
    return ${($_ = isset($this->services['service_locator.qgay0fs']) ? $this->services['service_locator.qgay0fs'] : $this->load('getServiceLocator_Qgay0fsService.php')) && false ?: '_'};
}, 'PortfolioBundle\\Controller\\DefaultController:updateImage' => function () {
    return ${($_ = isset($this->services['service_locator.ol3yfvt']) ? $this->services['service_locator.ol3yfvt'] : $this->load('getServiceLocator_Ol3yfvtService.php')) && false ?: '_'};
}, 'AppBundle\\Controller\\DefaultController::updatePost' => function () {
    return ${($_ = isset($this->services['service_locator.3qmptsx']) ? $this->services['service_locator.3qmptsx'] : $this->load('getServiceLocator_3qmptsxService.php')) && false ?: '_'};
}, 'AppBundle\\Controller\\DemandeurController::updatePost' => function () {
    return ${($_ = isset($this->services['service_locator.qgay0fs']) ? $this->services['service_locator.qgay0fs'] : $this->load('getServiceLocator_Qgay0fsService.php')) && false ?: '_'};
}, 'PortfolioBundle\\Controller\\DefaultController::updateImage' => function () {
    return ${($_ = isset($this->services['service_locator.ol3yfvt']) ? $this->services['service_locator.ol3yfvt'] : $this->load('getServiceLocator_Ol3yfvtService.php')) && false ?: '_'};
}]));