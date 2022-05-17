<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\PostFields;

/**
 * Represents the interface of any post field name preparator.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface PostFieldNamePreparatorInterface
{
	/**
	 * Prepares the post field name into a lowercase post field name without surrounding white spaces.
	 * @param string $postFieldName The post field name to prepare.
	 * @return string The prepared post field name.
	 */
	public function prepare( string $postFieldName ): string;
}
