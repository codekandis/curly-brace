<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Queries;

use function trim;

/**
 * Represents a get argument name preparator.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class GetArgumentNamePreparator implements GetArgumentNamePreparatorInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function prepare( string $getArgumentName ): string
	{
		return trim( $getArgumentName );
	}
}
