<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace\Queries;

use Countable;
use Iterator;

/**
 * Represents the interface of any get argument collection.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface GetArgumentCollectionInterface extends Countable, Iterator
{
	/**
	 * Gets the amount of get arguments in the collection.
	 * @return int The amount of get arguments in the collection.
	 */
	public function count(): int;

	/**
	 * Gets the current get argument.
	 * @return GetArgumentInterface The current get argument.
	 */
	public function current(): GetArgumentInterface;

	/**
	 * Moves the internal pointer to the next get argument.
	 */
	public function next(): void;

	/**
	 * Gets the name of the current get argument.
	 * @return ?string The name of the current get argument, null if the internal pointer does not point to any get argument.
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
	 * Gets the full get argument string of the whole get argument collection.
	 * @return string The full get argument string of the whole get argument collection.
	 */
	public function getFullGetArgumentString(): string;

	/**
	 * Adds get arguments to the collection.
	 * @param GetArgumentInterface[] $getArguments The get arguments to add.
	 */
	public function add( GetArgumentInterface ...$getArguments ): void;
}
