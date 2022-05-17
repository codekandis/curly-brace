<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\PostFields;

use Countable;
use Iterator;

/**
 * Represents the interface of any post field collection.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface PostFieldCollectionInterface extends Countable, Iterator
{
	/**
	 * Gets the amount of post fields in the collection.
	 * @return int The amount of post fields in the collection.
	 */
	public function count(): int;

	/**
	 * Gets the current post field.
	 * @return PostFieldInterface The current post field.
	 */
	public function current(): PostFieldInterface;

	/**
	 * Moves the internal pointer to the next post field.
	 */
	public function next(): void;

	/**
	 * Gets the name of the current post field.
	 * @return ?string The name of the current post field, null if the internal pointer does not point to any post field.
	 */
	public function key(): ?string;

	/**
	 * Determines if the current internal pointer position is valid.
	 * @return bool True if the current internal pointer position is valid, otherwise false.
	 */
	public function valid(): bool;

	/**
	 * Rewinds the internal pointer.
	 */
	public function rewind(): void;

	/**
	 * Converts the collection into an array.
	 * @return array The converted array.
	 */
	public function toArray(): array;

	/**
	 * Gets the full post field string of the whole post field collection.
	 * @return string The full post field string of the whole post field collection.
	 */
	public function getFullPostFieldString(): string;

	/**
	 * Adds post fields to the collection.
	 * @param PostFieldInterface[] $postFields The post fields to add.
	 */
	public function add( PostFieldInterface ...$postFields ): void;
}
