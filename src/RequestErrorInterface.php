<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace;

/**
 * Represents the interface of any request error.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
interface RequestErrorInterface
{
	/**
	 * Gets the error code.
	 * @return int The error code.
	 */
	public function getCode(): int;

	/**
	 * Gets the error message.
	 * @return string The error message.
	 */
	public function getMessage(): string;
}
