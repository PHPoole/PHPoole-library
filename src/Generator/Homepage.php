<?php
/*
 * Copyright (c) Arnaud Ligny <arnaud@ligny.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPoole\Generator;

use Dflydev\DotAccessData\Data;
use PHPoole\Page\Collection as PageCollection;
use PHPoole\Page\NodeTypeEnum;
use PHPoole\Page\Page;

/**
 * Class Homepage.
 */
class Homepage implements GeneratorInterface
{
    /* @var Data $options */
    protected $options;

    /**
     * Homepage constructor.
     *
     * @param Data $options
     */
    public function __construct(Data $options)
    {
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(PageCollection $pageCollection)
    {
        if (!$pageCollection->has('index')) {
            $filteredPages = $pageCollection->filter(function (Page $page) {
                return $page->getNodeType() === null
                    && $page->getSection() == $this->options->get('paginate.homepage.section');
            });
            $pages = $filteredPages->sortByDate()->toArray();

            /* @var $page Page */
            $page = (new Page())
                ->setId('index')
                ->setNodeType(NodeTypeEnum::HOMEPAGE)
                ->setPathname(Page::urlize(''))
                ->setTitle('Home')
                ->setVariable('pages', $pages)
                ->setVariable('menu', [
                    'main' => ['weight' => 1],
                ]);
            $pageCollection->add($page);
        }

        return $pageCollection;
    }
}