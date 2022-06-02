<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Queries;

/**
 * Represents the interface of any get argument name preparator.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface GetArgumentNamePreparatorInterface
{
	/**
	 * Prepares the get argument name into a lowercase get argument name without surrounding white spaces.
	 * @param string $getArgumentName The get argument name to prepare.
	 * @return string The prepared get argument name.
	 */
	public function prepare( string $getArgumentName ): string;
}
