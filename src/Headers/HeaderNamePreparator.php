<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

use function strtolower;
use function trim;

/**
 * Represents a header name preparator.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class HeaderNamePreparator implements HeaderNamePreparatorInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function prepare( string $headerName ): string
	{
		return strtolower( trim( $headerName ) );
	}
}
