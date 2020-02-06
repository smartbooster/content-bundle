<?php

namespace Smart\ContentBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class SmartContentExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(sprintf('%s/../Resources/config', __DIR__)));
        $loader->load('admin.xml');
        $loader->load('service.xml');
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('sonata_admin', [
            'extensions' => [
                'smart_content.admin.extension.nameable' => [
                    'uses' => ['Smart\ContentBundle\Entity\Traits\NameableTrait'],
                    'priority' => 100
                ],
                'smart_content.admin.extension.content' => [
                    'uses' => ['Smart\ContentBundle\Entity\Traits\ContentTrait'],
                    'priority' => 80
                ],
                'smart_content.admin.extension.image' => [
                    'uses' => ['Smart\ContentBundle\Entity\Traits\ImageTrait'],
                    'priority' => 60
                ],
                'smart_content.admin.extension.seo' => [
                    'uses' => ['Smart\ContentBundle\Entity\Traits\SeoTrait'],
                    'priority' => 40
                ],
            ]
        ]);
        $container->prependExtensionConfig('twig', [
            'form_theme' => [
                '@SonataCore/Form/datepicker.html.twig'
            ]
        ]);

        $container->prependExtensionConfig('vich_uploader', [
            'db_driver' => 'orm',
            'mappings' => [
                'smart_content_image' => [
                    'namer' => 'smart_content.upload.content_image_namer',
                    'directory_namer' => 'smart_content.upload.content_image_directory_namer',
                    'uri_prefix' => '/upload/content',
                    'upload_destination' => '%kernel.root_dir%/../public/upload/content',
                ]
            ]
        ]);

        $container->prependExtensionConfig('liip_imagine', [
            'filter_sets' => [
                'smart_content_list_thumb' => [
                    'filters' => [
                        'thumbnail' => ['size' => [32, 32], 'mode' => 'outbound']
                    ]
                ],
                'smart_content_show_thumb' => [
                    'filters' => [
                        'thumbnail' => ['size' => [300, 300], 'mode' => 'inset']
                    ]
                ]
            ]
        ]);
    }
}
