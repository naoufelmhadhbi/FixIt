<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = [];
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => '_wdt']), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if ('/_profiler' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not__profiler_home;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', '_profiler_home'));
                    }

                    return $ret;
                }
                not__profiler_home:

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ('/_profiler/search' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ('/_profiler/search_bar' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_phpinfo
                if ('/_profiler/phpinfo' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_search_results']), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler_open_file
                if ('/_profiler/open' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:openAction',  '_route' => '_profiler_open_file',);
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler']), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_router']), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_exception']), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_exception_css']), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => '_twig_error_test']), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        // portfolio_default_index
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'PortfolioBundle\\Controller\\DefaultController::indexAction',  '_route' => 'portfolio_default_index',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_portfolio_default_index;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'portfolio_default_index'));
            }

            return $ret;
        }
        not_portfolio_default_index:

        if (0 === strpos($pathinfo, '/p')) {
            if (0 === strpos($pathinfo, '/portfolio')) {
                if (0 === strpos($pathinfo, '/portfolio/add')) {
                    // add_image
                    if (0 === strpos($pathinfo, '/portfolio/addImage') && preg_match('#^/portfolio/addImage/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, ['_route' => 'add_image']), array (  '_controller' => 'PortfolioBundle\\Controller\\DefaultController::addImageAction',));
                    }

                    // add_metier
                    if (0 === strpos($pathinfo, '/portfolio/addmetier') && preg_match('#^/portfolio/addmetier/(?P<id_prof>[^/]++)/(?P<id_metier>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, ['_route' => 'add_metier']), array (  '_controller' => 'PortfolioBundle\\Controller\\DefaultController::addMetierAction',));
                    }

                    // add_deplacement
                    if (0 === strpos($pathinfo, '/portfolio/addDeplacement') && preg_match('#^/portfolio/addDeplacement/(?P<id_prof>[^/]++)/(?P<id_dep>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, ['_route' => 'add_deplacement']), array (  '_controller' => 'PortfolioBundle\\Controller\\DefaultController::addDeplacementAction',));
                    }

                }

                elseif (0 === strpos($pathinfo, '/portfolio/delete')) {
                    // delete_image
                    if (0 === strpos($pathinfo, '/portfolio/deleteImage') && preg_match('#^/portfolio/deleteImage/(?P<id_image>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, ['_route' => 'delete_image']), array (  '_controller' => 'PortfolioBundle\\Controller\\DefaultController::deleteIamge',));
                    }

                    // delete_metier
                    if (0 === strpos($pathinfo, '/portfolio/deleteMetier') && preg_match('#^/portfolio/deleteMetier/(?P<id_prof>[^/]++)/(?P<id_metier>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, ['_route' => 'delete_metier']), array (  '_controller' => 'PortfolioBundle\\Controller\\DefaultController::deleteMetier',));
                    }

                    // delete_deplacement
                    if (0 === strpos($pathinfo, '/portfolio/deleteDeplacement') && preg_match('#^/portfolio/deleteDeplacement/(?P<id_prof>[^/]++)/(?P<id_dep>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, ['_route' => 'delete_deplacement']), array (  '_controller' => 'PortfolioBundle\\Controller\\DefaultController::deleteDeplacement',));
                    }

                }

                // update_image
                if (0 === strpos($pathinfo, '/portfolio/editImage') && preg_match('#^/portfolio/editImage/(?P<id_image>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => 'update_image']), array (  '_controller' => 'PortfolioBundle\\Controller\\DefaultController::updateImage',));
                }

                if (0 === strpos($pathinfo, '/portfolio/get')) {
                    // listimages
                    if (0 === strpos($pathinfo, '/portfolio/getImages') && preg_match('#^/portfolio/getImages/(?P<id_prof>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, ['_route' => 'listimages']), array (  '_controller' => 'PortfolioBundle\\Controller\\DefaultController::getImagesPerProf',));
                    }

                    // listMetier
                    if (0 === strpos($pathinfo, '/portfolio/getMetier') && preg_match('#^/portfolio/getMetier/(?P<id_prof>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, ['_route' => 'listMetier']), array (  '_controller' => 'PortfolioBundle\\Controller\\DefaultController::getMetierPerProf',));
                    }

                    // listDeplacement
                    if (0 === strpos($pathinfo, '/portfolio/getDeplacement') && preg_match('#^/portfolio/getDeplacement/(?P<id_prof>[^/]++)$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, ['_route' => 'listDeplacement']), array (  '_controller' => 'PortfolioBundle\\Controller\\DefaultController::getDeplamcementPerProf',));
                    }

                }

                // update_metier
                if (0 === strpos($pathinfo, '/portfolio/Updatemetier') && preg_match('#^/portfolio/Updatemetier/(?P<id_prof>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => 'update_metier']), array (  '_controller' => 'PortfolioBundle\\Controller\\DefaultController::UpdateMetierAction',));
                }

                // update_deplacement
                if (0 === strpos($pathinfo, '/portfolio/UpdateDeplacement') && preg_match('#^/portfolio/UpdateDeplacement/(?P<id_prof>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => 'update_deplacement']), array (  '_controller' => 'PortfolioBundle\\Controller\\DefaultController::UpdateDeplacementAction',));
                }

            }

            elseif (0 === strpos($pathinfo, '/publication')) {
                // publication_index
                if ('/publication' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'PublicationBundle\\Controller\\PublicationController::indexAction',  '_route' => 'publication_index',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not_publication_index;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', 'publication_index'));
                    }

                    return $ret;
                }
                not_publication_index:

                // publication_show
                if (preg_match('#^/publication/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => 'publication_show']), array (  '_controller' => 'PublicationBundle\\Controller\\PublicationController::showAction',));
                }

            }

            // add_professionnel
            if ('/professionnel/add' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\ProfessionnelController::addArticleAction',  '_route' => 'add_professionnel',);
            }

            if (0 === strpos($pathinfo, '/profile')) {
                // fos_user_profile_show
                if ('/profile' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'fos_user.profile.controller:showAction',  '_route' => 'fos_user_profile_show',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not_fos_user_profile_show;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', 'fos_user_profile_show'));
                    }

                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_fos_user_profile_show;
                    }

                    return $ret;
                }
                not_fos_user_profile_show:

                // fos_user_profile_edit
                if ('/profile/edit' === $pathinfo) {
                    $ret = array (  '_controller' => 'fos_user.profile.controller:editAction',  '_route' => 'fos_user_profile_edit',);
                    if (!in_array($canonicalMethod, ['GET', 'POST'])) {
                        $allow = array_merge($allow, ['GET', 'POST']);
                        goto not_fos_user_profile_edit;
                    }

                    return $ret;
                }
                not_fos_user_profile_edit:

                // fos_user_change_password
                if ('/profile/change-password' === $pathinfo) {
                    $ret = array (  '_controller' => 'fos_user.change_password.controller:changePasswordAction',  '_route' => 'fos_user_change_password',);
                    if (!in_array($canonicalMethod, ['GET', 'POST'])) {
                        $allow = array_merge($allow, ['GET', 'POST']);
                        goto not_fos_user_change_password;
                    }

                    return $ret;
                }
                not_fos_user_change_password:

            }

        }

        elseif (0 === strpos($pathinfo, '/de')) {
            if (0 === strpos($pathinfo, '/deplacement')) {
                // deplacement_index
                if ('/deplacement' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'PortfolioBundle\\Controller\\DeplacementController::indexAction',  '_route' => 'deplacement_index',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not_deplacement_index;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', 'deplacement_index'));
                    }

                    return $ret;
                }
                not_deplacement_index:

                // deplacement_show
                if (preg_match('#^/deplacement/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => 'deplacement_show']), array (  '_controller' => 'PortfolioBundle\\Controller\\DeplacementController::showAction',));
                }

            }

            // delete_post
            if (0 === strpos($pathinfo, '/delete') && preg_match('#^/delete/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => 'delete_post']), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::deletePost',));
            }

            if (0 === strpos($pathinfo, '/demandeur')) {
                // demandeur_by_id
                if ('/demandeur/byId' === $pathinfo) {
                    return array (  '_controller' => 'AppBundle\\Controller\\DemandeurController::getArticleByidAction',  '_route' => 'demandeur_by_id',);
                }

                // add_demandeur
                if ('/demandeur/add' === $pathinfo) {
                    return array (  '_controller' => 'AppBundle\\Controller\\DemandeurController::addArticleAction',  '_route' => 'add_demandeur',);
                }

                // app_demandeur_warri
                if ('/demandeur/warri' === $pathinfo) {
                    return array (  '_controller' => 'AppBundle\\Controller\\DemandeurController::warriAction',  '_route' => 'app_demandeur_warri',);
                }

                // update_demandeur
                if (0 === strpos($pathinfo, '/demandeur/edit') && preg_match('#^/demandeur/edit/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => 'update_demandeur']), array (  '_controller' => 'AppBundle\\Controller\\DemandeurController::updatePost',));
                }

            }

        }

        // messagerie_default_index
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'MessagerieBundle\\Controller\\DefaultController::indexAction',  '_route' => 'messagerie_default_index',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_messagerie_default_index;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'messagerie_default_index'));
            }

            return $ret;
        }
        not_messagerie_default_index:

        // msg
        if ('/msg/sendMessage' === $pathinfo) {
            return array (  '_controller' => 'MessagerieBundle\\Controller\\DefaultController::sendMessage',  '_route' => 'msg',);
        }

        if (0 === strpos($pathinfo, '/get')) {
            // listMessageByUser
            if ('/getMessagesByUser' === $pathinfo) {
                return array (  '_controller' => 'MessagerieBundle\\Controller\\DefaultController::getMessagesByUser',  '_route' => 'listMessageByUser',);
            }

            // listAllUSR
            if (0 === strpos($pathinfo, '/getAllUsr') && preg_match('#^/getAllUsr/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => 'listAllUSR']), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::getAllUserOrById',));
            }

            // createUser
            if (0 === strpos($pathinfo, '/getByUsername') && preg_match('#^/getByUsername/(?P<username>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => 'createUser']), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::showByUsername',));
            }

        }

        // evaluation_default_index
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'EvaluationBundle\\Controller\\DefaultController::indexAction',  '_route' => 'evaluation_default_index',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_evaluation_default_index;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'evaluation_default_index'));
            }

            return $ret;
        }
        not_evaluation_default_index:

        // reclamation_default_index
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'ReclamationBundle\\Controller\\DefaultController::indexAction',  '_route' => 'reclamation_default_index',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_reclamation_default_index;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'reclamation_default_index'));
            }

            return $ret;
        }
        not_reclamation_default_index:

        if (0 === strpos($pathinfo, '/re')) {
            if (0 === strpos($pathinfo, '/reclamation')) {
                // add_reclamation
                if ('/reclamation/add' === $pathinfo) {
                    return array (  '_controller' => 'ReclamationBundle\\Controller\\DefaultController::addReclamationAction',  '_route' => 'add_reclamation',);
                }

                // find_all_reclamation
                if ('/reclamation/findAll' === $pathinfo) {
                    return array (  '_controller' => 'ReclamationBundle\\Controller\\DefaultController::findAll',  '_route' => 'find_all_reclamation',);
                }

                // find_by_user_reclamation
                if (0 === strpos($pathinfo, '/reclamation/findByUser') && preg_match('#^/reclamation/findByUser/(?P<user_id>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => 'find_by_user_reclamation']), array (  '_controller' => 'ReclamationBundle\\Controller\\DefaultController::findReclamationByUser',));
                }

                // delete_by_user_reclamation
                if (0 === strpos($pathinfo, '/reclamation/deleteByRecId') && preg_match('#^/reclamation/deleteByRecId/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => 'delete_by_user_reclamation']), array (  '_controller' => 'ReclamationBundle\\Controller\\DefaultController::deleteReclamationAction',));
                }

            }

            elseif (0 === strpos($pathinfo, '/register')) {
                // fos_user_registration_register
                if ('/register' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'fos_user.registration.controller:registerAction',  '_route' => 'fos_user_registration_register',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not_fos_user_registration_register;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', 'fos_user_registration_register'));
                    }

                    if (!in_array($canonicalMethod, ['GET', 'POST'])) {
                        $allow = array_merge($allow, ['GET', 'POST']);
                        goto not_fos_user_registration_register;
                    }

                    return $ret;
                }
                not_fos_user_registration_register:

                // fos_user_registration_check_email
                if ('/register/check-email' === $pathinfo) {
                    $ret = array (  '_controller' => 'fos_user.registration.controller:checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_fos_user_registration_check_email;
                    }

                    return $ret;
                }
                not_fos_user_registration_check_email:

                if (0 === strpos($pathinfo, '/register/confirm')) {
                    // fos_user_registration_confirm
                    if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'fos_user_registration_confirm']), array (  '_controller' => 'fos_user.registration.controller:confirmAction',));
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_fos_user_registration_confirm;
                        }

                        return $ret;
                    }
                    not_fos_user_registration_confirm:

                    // fos_user_registration_confirmed
                    if ('/register/confirmed' === $pathinfo) {
                        $ret = array (  '_controller' => 'fos_user.registration.controller:confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_fos_user_registration_confirmed;
                        }

                        return $ret;
                    }
                    not_fos_user_registration_confirmed:

                }

            }

            elseif (0 === strpos($pathinfo, '/resetting')) {
                // fos_user_resetting_request
                if ('/resetting/request' === $pathinfo) {
                    $ret = array (  '_controller' => 'fos_user.resetting.controller:requestAction',  '_route' => 'fos_user_resetting_request',);
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_fos_user_resetting_request;
                    }

                    return $ret;
                }
                not_fos_user_resetting_request:

                // fos_user_resetting_reset
                if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'fos_user_resetting_reset']), array (  '_controller' => 'fos_user.resetting.controller:resetAction',));
                    if (!in_array($canonicalMethod, ['GET', 'POST'])) {
                        $allow = array_merge($allow, ['GET', 'POST']);
                        goto not_fos_user_resetting_reset;
                    }

                    return $ret;
                }
                not_fos_user_resetting_reset:

                // fos_user_resetting_send_email
                if ('/resetting/send-email' === $pathinfo) {
                    $ret = array (  '_controller' => 'fos_user.resetting.controller:sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_fos_user_resetting_send_email;
                    }

                    return $ret;
                }
                not_fos_user_resetting_send_email:

                // fos_user_resetting_check_email
                if ('/resetting/check-email' === $pathinfo) {
                    $ret = array (  '_controller' => 'fos_user.resetting.controller:checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_fos_user_resetting_check_email;
                    }

                    return $ret;
                }
                not_fos_user_resetting_check_email:

            }

        }

        // publication_default_index
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'PublicationBundle\\Controller\\DefaultController::indexAction',  '_route' => 'publication_default_index',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_publication_default_index;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'publication_default_index'));
            }

            return $ret;
        }
        not_publication_default_index:

        // homepage
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_homepage;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'homepage'));
            }

            return $ret;
        }
        not_homepage:

        if (0 === strpos($pathinfo, '/a')) {
            // createUseri
            if ('/api/create' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::createUser',  '_route' => 'createUseri',);
            }

            // api_login_check
            if ('/api/login_check' === $pathinfo) {
                return ['_route' => 'api_login_check'];
            }

            // add_user
            if ('/add' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::addUserAction',  '_route' => 'add_user',);
            }

        }

        // update_user
        if (0 === strpos($pathinfo, '/edit') && preg_match('#^/edit/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, ['_route' => 'update_user']), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::updatePost',));
        }

        if (0 === strpos($pathinfo, '/login')) {
            // fos_user_security_login
            if ('/login' === $pathinfo) {
                $ret = array (  '_controller' => 'fos_user.security.controller:loginAction',  '_route' => 'fos_user_security_login',);
                if (!in_array($canonicalMethod, ['GET', 'POST'])) {
                    $allow = array_merge($allow, ['GET', 'POST']);
                    goto not_fos_user_security_login;
                }

                return $ret;
            }
            not_fos_user_security_login:

            // fos_user_security_check
            if ('/login_check' === $pathinfo) {
                $ret = array (  '_controller' => 'fos_user.security.controller:checkAction',  '_route' => 'fos_user_security_check',);
                if (!in_array($requestMethod, ['POST'])) {
                    $allow = array_merge($allow, ['POST']);
                    goto not_fos_user_security_check;
                }

                return $ret;
            }
            not_fos_user_security_check:

        }

        // fos_user_security_logout
        if ('/logout' === $pathinfo) {
            $ret = array (  '_controller' => 'fos_user.security.controller:logoutAction',  '_route' => 'fos_user_security_logout',);
            if (!in_array($canonicalMethod, ['GET', 'POST'])) {
                $allow = array_merge($allow, ['GET', 'POST']);
                goto not_fos_user_security_logout;
            }

            return $ret;
        }
        not_fos_user_security_logout:

        if ('/' === $pathinfo && !$allow) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
