<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace;

/**
 * Represents a request error.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class RequestError implements RequestErrorInterface
{
	/**
	 * Stores the error code.
	 * @var int
	 */
	private int $code;

	/**
	 * {@inheritDoc}
	 */
	public function getCode(): int
	{
		return $this->code;
	}

	/**
	 * Stores the error message.
	 * @var string
	 */
	private string $message;

	/**
	 * {@inheritDoc}
	 */
	public function getMessage(): string
	{
		return $this->message;
	}

	/**
	 * Constructor method.
	 * @param int $code The error code.
	 * @param string $message The error message.
	 */
	public function __construct( int $code, string $message )
	{
		$this->code    = $code;
		$this->message = $message;
	}
}
