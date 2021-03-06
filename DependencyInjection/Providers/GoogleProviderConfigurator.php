<?php

namespace KnpU\OAuth2ClientBundle\DependencyInjection\Providers;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;

class GoogleProviderConfigurator implements ProviderConfiguratorInterface
{
    public function buildConfiguration(NodeBuilder $node)
    {
        // todo - add the comments as help text, and render in README
        $node
            ->scalarNode('access_type')
                ->info('Optional value for sending hd parameter. More detail: https://developers.google.com/accounts/docs/OAuth2Login#hd-param')
            ->end()
            ->scalarNode('hosted_domain')
                ->info('Optional value for sending access_type parameter. More detail: https://developers.google.com/identity/protocols/OAuth2WebServer#offline')
            ->end()
            ->arrayNode('user_fields')
                ->prototype('scalar')->end()
                ->info('Optional value for additional fields to be requested from the user profile. If set, these values will be included with the defaults. More details: https://developers.google.com/+/web/api/rest/latest/people')
            ->end()
        ;
    }

    public function getProviderClass(array $config)
    {
        return 'League\OAuth2\Client\Provider\Google';
    }

    public function getProviderOptions(array $config)
    {
        return array(
            'clientId' => $config['client_id'],
            'clientSecret' => $config['client_secret'],
            'accessType' => $config['access_type'],
            'hostedDomain' => $config['hosted_domain'],
            'userFields' => $config['user_fields']
        );
    }

    public function getPackagistName()
    {
        return 'league/oauth2-google';
    }

    public function getLibraryHomepage()
    {
        return 'https://github.com/thephpleague/oauth2-google';
    }

    public function getProviderDisplayName()
    {
        return 'Google';
    }

    public function getClientClass(array $config)
    {
        return 'KnpU\OAuth2ClientBundle\Client\Provider\GoogleClient';
    }
}
