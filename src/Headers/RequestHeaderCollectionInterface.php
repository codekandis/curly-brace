<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Headers;

use Countable;
use Iterator;

/**
 * Represents the interface of any request header collection.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface RequestHeaderCollectionInterface extends Countable, Iterator
{
	/**
	 * Gets the amount of request headers in the collection.
	 * @return int The amount of request headers in the collection.
	 */
	public function count(): int;

	/**
	 * Gets the current request header.
	 * @return RequestHeaderInterface The current request header.
	 */
	public function current(): RequestHeaderInterface;

	/**
	 * Moves the internal pointer to the next request header.
	 */
	public function next(): void;

	/**
	 * Gets the name of the current request header.
	 * @return ?string The name of the current request header, null if the internal pointer does not point to any request header.
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
	 * Adds request headers to the collection.
	 * @param RequestHeaderInterface[] $requestHeaders The request headers to add.
	 */
	public function add( RequestHeaderInterface ...$requestHeaders ): void;

	/**
	 * Gets the first request header in line by its specified name.
	 * @param string $name The name of the request header.
	 * @return ?RequestHeaderInterface The request header if found, otherwise null.
	 */
	public function findFirst( string $name ): ?RequestHeaderInterface;

	/**
	 * Gets the last request header in line by its specified name.
	 * @param string $name The name of the request header.
	 * @return ?RequestHeaderInterface The request header if found, otherwise null.
	 */
	public function findLast( string $name ): ?RequestHeaderInterface;

	/**
	 * Gets all request headers by a specified name.
	 * @param string $name The name of the request headers.
	 * @return ?RequestHeaderCollectionInterface The found request headers.
	 */
	public function findAll( string $name ): self;
}
