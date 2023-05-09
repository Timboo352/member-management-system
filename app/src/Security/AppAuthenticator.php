<?php

namespace App\Security;

use App\Entity\Member;
use ContainerFUm5nMA\getMemberRepositoryService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class AppAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function authenticate(Request $request): Passport
    {
        $member = $request->request->get('member', '');

        $request->getSession()->set(Security::LAST_USERNAME, $member);

        return new Passport(
            new UserBadge($member),
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
//        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
//            return new RedirectResponse($targetPath);
//        }
        if (in_array('ADMIN', $token->getRoleNames())) {
            return new RedirectResponse($this->urlGenerator->generate('admin_panel'));
        } elseif(in_array('USER', $token->getRoleNames())) {
            $user = $token->getUser();
            return new RedirectResponse($this->urlGenerator->generate('users') . '/' . $user->getMember()->getId());
        }
        return new RedirectResponse($this->urlGenerator->generate('app_login'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
