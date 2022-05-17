<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

/**
 * Represents the interface of any header name preparator.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface HeaderNamePreparatorInterface
{
	/**
	 * Prepares the header name into a lowercase header name without surrounding white spaces.
	 * @param string $headerName The header name to prepare.
	 * @return string The prepared header name.
	 */
	public function prepare( string $headerName ): string;
}
