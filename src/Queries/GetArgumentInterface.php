<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Queries;

/**
 * Represents the interface of any get argument.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface GetArgumentInterface
{
	/**
	 * Gets the get argument name.
	 * @return string The get argument name.
	 */
	public function getName(): string;

	/**
	 * Gets the get argument value.
	 * @return string The get argument value.
	 */
	public function getValue(): string;

	/**
	 * Returns the stringified get argument.
	 * @return string The stringified get argument.
	 */
	public function getFullGetArgumentString():string;
}
