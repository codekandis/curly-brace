<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Queries;

/**
 * Represents the interface of any post argument.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface PostArgumentInterface
{
	/**
	 * Gets the post argument name.
	 * @return string The post argument name.
	 */
	public function getName(): string;

	/**
	 * Gets the post argument value.
	 * @return string The post argument value.
	 */
	public function getValue(): string;

	/**
	 * Returns the stringified post argument.
	 * @return string The stringified post argument.
	 */
	public function getFullPostArgumentString():string;
}
