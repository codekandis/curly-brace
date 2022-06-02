<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Queries;

use function trim;

/**
 * Represents a post argument name preparator.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class PostArgumentNamePreparator implements PostArgumentNamePreparatorInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function prepare( string $postArgumentName ): string
	{
		return trim( $postArgumentName );
	}
}
