<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

use function trim;

/**
 * Represents a header value preparator.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class HeaderValuePreparator implements HeaderValuePreparatorInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function prepare( string $headerValue ): string
	{
		return trim( $headerValue );
	}
}
