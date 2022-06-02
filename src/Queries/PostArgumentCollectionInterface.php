<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Queries;

use Countable;
use Iterator;

/**
 * Represents the interface of any post argument collection.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface PostArgumentCollectionInterface extends Countable, Iterator
{
	/**
	 * Gets the amount of post arguments in the collection.
	 * @return int The amount of post arguments in the collection.
	 */
	public function count(): int;

	/**
	 * Gets the current post argument.
	 * @return PostArgumentInterface The current post argument.
	 */
	public function current(): PostArgumentInterface;

	/**
	 * Moves the internal pointer to the next post argument.
	 */
	public function next(): void;

	/**
	 * Gets the name of the current post argument.
	 * @return ?string The name of the current post argument, null if the internal pointer does not point to any post argument.
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
	 * Gets the full post argument string of the whole post argument collection.
	 * @return string The full post argument string of the whole post argument collection.
	 */
	public function getFullPostArgumentString(): string;

	/**
	 * Adds post arguments to the collection.
	 * @param PostArgumentInterface[] $postArguments The post arguments to add.
	 */
	public function add( PostArgumentInterface ...$postArguments ): void;
}
