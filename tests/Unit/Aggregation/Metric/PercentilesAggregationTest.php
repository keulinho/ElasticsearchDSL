<?php declare(strict_types=1);

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Tests\Unit\Aggregation\Metric;

use ONGR\ElasticsearchDSL\Aggregation\Metric\PercentilesAggregation;

/**
 * @internal
 */
class PercentilesAggregationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Tests if PercentilesAggregation#getArray throws exception when expected.
     */
    public function testPercentilesAggregationGetArrayException(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Percentiles aggregation must have field or script set.');
        $aggregation = new PercentilesAggregation('bar');
        $aggregation->getArray();
    }

    /**
     * Test getType method.
     */
    public function testGetType(): void
    {
        $aggregation = new PercentilesAggregation('bar');
        static::assertEquals('percentiles', $aggregation->getType());
    }

    /**
     * Test getArray method.
     */
    public function testGetArray(): void
    {
        $aggregation = new PercentilesAggregation('bar', 'fieldValue', ['percentsValue']);
        static::assertSame(
            [
                'percents' => ['percentsValue'],
                'field' => 'fieldValue',
            ],
            $aggregation->getArray()
        );
    }
}
