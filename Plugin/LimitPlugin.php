<?php

declare(strict_types=1);

/*
 * This file is part of the Geocoder package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace Geocoder\Plugin\Plugin;

use Geocoder\Plugin\Plugin;
use Geocoder\Query\Query;

/**
 * Add limit on the query.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class LimitPlugin implements Plugin
{
    /**
     * @var int
     */
    private $limit;

    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }

    public function handleQuery(Query $query, callable $next, callable $first)
    {
        $limit = $query->getLimit();
        if (null !== $limit && $limit > 0) {
            $query = $query->withLimit($this->limit);
        }

        return $next($query);
    }
}
