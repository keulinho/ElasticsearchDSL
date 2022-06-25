<?php declare(strict_types=1);

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenSearchDSL\Tests\Unit\Query\FullText;

use OpenSearchDSL\Query\FullText\MatchPhraseQuery;

/**
 * @internal
 */
class MatchPhraseQueryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Tests toArray().
     */
    public function testToArray(): void
    {
        $query = new MatchPhraseQuery('message', 'this is a test', ['test' => 1,]);
        $expected = [
            'match_phrase' => [
                'message' => [
                    'query' => 'this is a test',
                    'test' => 1,
                ],
            ],
        ];

        static::assertEquals($expected, $query->toArray());
    }
}
