<?php declare(strict_types=1);

namespace ONGR\ElasticsearchDSL\Tests\Unit\SearchEndpoint;

use ONGR\ElasticsearchDSL\Aggregation\Bucketing\MissingAggregation;
use ONGR\ElasticsearchDSL\SearchEndpoint\AbstractSearchEndpoint;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class AbstractSearchEndpointTest extends TestCase
{
    public function testItThrowsExceptionOnDuplicateBuilderKeys(): void
    {
        $agg = $this->getMockForAbstractClass(AbstractSearchEndpoint::class);
        $agg->add(new MissingAggregation('acme', 'foo'), 'bar');

        $this->expectException(\OverflowException::class);

        $agg->add(new MissingAggregation('acme', 'bar'), 'bar');
    }

    public function testItThrowsExceptionOnAddToBool(): void
    {
        $agg = $this->getMockForAbstractClass(AbstractSearchEndpoint::class);

        $this->expectException(\BadFunctionCallException::class);

        $agg->addToBool(new MissingAggregation('acme', 'foo'));
    }

    public function testItThrowsExceptionOnGetBool(): void
    {
        $agg = $this->getMockForAbstractClass(AbstractSearchEndpoint::class);

        $this->expectException(\BadFunctionCallException::class);

        $agg->getBool();
    }

    public function testRemove(): void
    {
        $agg = $this->getMockForAbstractClass(AbstractSearchEndpoint::class);
        $agg->add(new MissingAggregation('acme', 'foo'), 'bar');

        static::assertInstanceOf(MissingAggregation::class, $agg->get('bar'));
        static::assertTrue($agg->has('bar'));

        $agg->remove('bar');

        static::assertNull($agg->get('bar'));
        static::assertFalse($agg->has('bar'));
    }
}
