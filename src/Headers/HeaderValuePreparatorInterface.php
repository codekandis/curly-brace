<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

/**
 * Represents the interface of any header value preparator.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface HeaderValuePreparatorInterface
{
	/**
	 * Prepares the header value into a header value without leading white spaces.
	 * @param string $headerValue The header value to prepare.
	 * @return string The prepared header value.
	 */
	public function prepare( string $headerValue ): string;
}
