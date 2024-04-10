<?php

declare(strict_types=1);

namespace Jacuzzi\Psi\User;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;

class FrontendUser
{
    public function render($c, $a, ServerRequestInterface $request)
    {
        $frontendUser = $request->getAttribute('frontend.user');

        if (!$frontendUser instanceof FrontendUserAuthentication
            || !GeneralUtility::makeInstance(Context::class)->getPropertyFromAspect('frontend.user', 'isLoggedIn')
        ) {
            return '';
        }

        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->assign('user', $frontendUser->user);
        $view->setTemplateSource(
            '<div class="user-info-container">
                <div class="user-info-avatar">
                    <p class="fe-user-name">{user.name}</p>
                </div>
                <div class="user-infos">
                    {user.title}
                    <div class="user-info-name">
                        <p class="fe-user-name">{user.username}</p>
                        <p class="fe-user-lastname">{user.lastname}</p>
                    </div>
                </div>
            </div>'
        );

        return $view->render();
    }
}