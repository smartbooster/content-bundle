<?php

namespace Smart\ContentBundle\Admin\Block;

use Smart\ContentBundle\Entity\Repository\PostRepository;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractAdminBlockService;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Nicolas Bastien <nicolas.bastien@smartbooster.io>
 */
class RecentPostBlock extends AbstractAdminBlockService
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @param string                $name
     * @param EngineInterface       $templating
     * @param PostRepository        $postRepository
     */
    public function __construct($name, EngineInterface $templating, PostRepository $postRepository)
    {
        parent::__construct($name, $templating);

        $this->postRepository = $postRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefault('template', '@SmartContent/admin/block/recent_posts.html.twig');
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $date = $this->postRepository->getLastPublishedPostDate();
        $today = new \DateTime();

        $interval = 0;
        if (null !== $date) {
            $interval = $today->diff($date)->days;
        }

        return $this->renderPrivateResponse(
            $blockContext->getTemplate(),
            [
                'block'        => $blockContext->getBlock(),
                'settings'     => $blockContext->getSettings(),
                'posts'        => $this->postRepository->getLastPublishedPosts(),
                'interval'    => $interval
            ],
            $response
        );
    }
}
