<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\PostFields;

use function trim;

/**
 * Represents a post field name preparator.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class PostFieldNamePreparator implements PostFieldNamePreparatorInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function prepare( string $postFieldName ): string
	{
		return trim( $postFieldName );
	}
}
