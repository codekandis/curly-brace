<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

use Countable;
use Iterator;

/**
 * Represents the interface of any header collection.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface HeaderCollectionInterface extends Countable, Iterator
{
	/**
	 * Gets the amount of headers in the collection.
	 * @return int The amount of headers in the collection.
	 */
	public function count(): int;

	/**
	 * Gets the current header.
	 * @return HeaderInterface The current header.
	 */
	public function current(): HeaderInterface;

	/**
	 * Moves the internal pointer to the next header.
	 */
	public function next(): void;

	/**
	 * Gets the name of the current header.
	 * @return ?string The name of the current header, null if the internal pointer does not point to any header.
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
	 * Adds headers to the collection.
	 * @param HeaderInterface[] $headers The headers to add.
	 */
	public function add( HeaderInterface ...$headers ): void;

	/**
	 * Gets the first header in line by its specified name.
	 * @param string $name The name of the header.
	 * @return ?HeaderInterface The header if found, otherwise null.
	 */
	public function findFirst( string $name ): ?HeaderInterface;

	/**
	 * Gets the last header in line by its specified name.
	 * @param string $name The name of the header.
	 * @return ?HeaderInterface The header if found, otherwise null.
	 */
	public function findLast( string $name ): ?HeaderInterface;

	/**
	 * Gets all headers by a specified name.
	 * @param string $name The name of the headers.
	 * @return ?HeaderCollectionInterface The found headers.
	 */
	public function findAll( string $name ): self;
}
