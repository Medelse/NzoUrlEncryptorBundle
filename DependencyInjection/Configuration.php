<?php

/*
 * Configuration file.
 *
 * (c) Ala Eddine Khefifi <alakhefifi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nzo\UrlEncryptorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Nzo\UrlEncryptorBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('nzo_url_encryptor');
        // Keep compatibility with symfony/config < 4.2
        if (\method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            $rootNode = $treeBuilder->root('nzo_url_encryptor');
        }

        $rootNode
            ->children()
                ->scalarNode('secret_key')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('secret_iv')
                    ->defaultValue('')
                ->end()
                ->scalarNode('cipher_algorithm')
                    ->defaultValue('aes-128-ctr')
                ->end()
                ->booleanNode('base64_encode')
                    ->defaultValue(true)
                ->end()
                ->booleanNode('format_base64_output')
                    ->defaultValue(true)
                ->end()
                ->booleanNode('random_pseudo_bytes')
                    ->defaultValue(false)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
