<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Queries;

/**
 * Represents the interface of any post argument name preparator.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface PostArgumentNamePreparatorInterface
{
	/**
	 * Prepares the post argument name into a lowercase post argument name without surrounding white spaces.
	 * @param string $postArgumentName The post argument name to prepare.
	 * @return string The prepared post argument name.
	 */
	public function prepare( string $postArgumentName ): string;
}
