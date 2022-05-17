<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

use Countable;
use Iterator;

/**
 * Represents the interface of any response header collection.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ResponseHeaderCollectionInterface extends Countable, Iterator
{
	/**
	 * Gets the amount of response headers in the collection.
	 * @return int The amount of response headers in the collection.
	 */
	public function count(): int;

	/**
	 * Gets the current response header.
	 * @return ResponseHeaderInterface The current response header.
	 */
	public function current(): ResponseHeaderInterface;

	/**
	 * Moves the internal pointer to the next response header.
	 */
	public function next(): void;

	/**
	 * Gets the name of the current response header.
	 * @return ?string The name of the current response header, null if the internal pointer does not point to any response header.
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
	 * Adds response headers to the collection.
	 * @param ResponseHeaderInterface[] $responseHeaders The response headers to add.
	 */
	public function add( ResponseHeaderInterface ...$responseHeaders ): void;

	/**
	 * Gets the first response header in line by its specified name.
	 * @param string $name The name of the response header.
	 * @return ?ResponseHeaderInterface The response header if found, otherwise null.
	 */
	public function findFirst( string $name ): ?ResponseHeaderInterface;

	/**
	 * Gets the last response header in line by its specified name.
	 * @param string $name The name of the response header.
	 * @return ?ResponseHeaderInterface The response header if found, otherwise null.
	 */
	public function findLast( string $name ): ?ResponseHeaderInterface;

	/**
	 * Gets all response headers by a specified name.
	 * @param string $name The name of the response headers.
	 * @return ?ResponseHeaderCollectionInterface The found response headers.
	 */
	public function findAll( string $name ): self;
}
