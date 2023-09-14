<?php declare(strict_types=1);

namespace App\GraphQL\Scalars;

use Carbon\Carbon;
use Error;
use GraphQL\Language\AST\Node;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;

/** Read more about scalars here: https://webonyx.github.io/graphql-php/type-definitions/scalars. */
final class DateDMY extends ScalarType
{
    /** Serializes an internal value to include in a response. */
    public function serialize(mixed $value): mixed
    {
        if ($value instanceof Carbon) {
            return $value->format('d-m-Y');
        }
        return $value;
    }

    /** Parses an externally provided value (query variable) to use as an input. */
    public function parseValue($value)
    {
        // Validate the date format (d-m-Y)
        $parsedDate = Carbon::createFromFormat('d-m-Y', $value);

        if (!$parsedDate) {
            throw new Error('Invalid date format. Use "d-m-Y".');
        }

        return $parsedDate;
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input.
     *
     * Should throw an exception with a client friendly message on invalid value nodes, @see \GraphQL\Error\ClientAware.
     *
     * @param  \GraphQL\Language\AST\ValueNode&\GraphQL\Language\AST\Node  $valueNode
     * @param  array<string, mixed>|null  $variables
     */
    public function parseLiteral($valueNode, ?array $variables = null)
    {
        if ($valueNode instanceof StringValueNode) {
            return $this->parseValue($valueNode->value);
        }

        throw new Error('Query error: Can only parse strings for date.');
    }
}
