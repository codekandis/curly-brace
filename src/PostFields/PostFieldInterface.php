<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\PostFields;

/**
 * Represents the interface of any post field.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface PostFieldInterface
{
	/**
	 * Gets the post field name.
	 * @return string The post field name.
	 */
	public function getName(): string;

	/**
	 * Gets the post field value.
	 * @return string The post field value.
	 */
	public function getValue(): string;

	/**
	 * Returns the stringified post field.
	 * @return string The stringified post field.
	 */
	public function getFullPostFieldString():string;
}
