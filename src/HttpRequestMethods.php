<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace;

/**
 * Represents an enumeration of HTTP request methods.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class HttpRequestMethods
{
	/**
	 * Represents the HTTP request method `GET`.
	 * @var string
	 */
	public const GET = 'GET';

	/**
	 * Represents the HTTP request method `CONNECT`.
	 * @var string
	 */
	public const CONNECT = 'CONNECT';

	/**
	 * Represents the HTTP request method `COPY`.
	 * @var string
	 */
	public const COPY = 'COPY';

	/**
	 * Represents the HTTP request method `DELETE`.
	 * @var string
	 */
	public const DELETE = 'DELETE';

	/**
	 * Represents the HTTP request method `HEAD`.
	 * @var string
	 */
	public const HEAD = 'HEAD';

	/**
	 * Represents the HTTP request method `HTTP`.
	 * @var string
	 */
	public const HTTP = 'HTTP';

	/**
	 * Represents the HTTP request method `LOCK`.
	 * @var string
	 */
	public const LOCK = 'LOCK';

	/**
	 * Represents the HTTP request method `MKCOL`.
	 * @var string
	 */
	public const MKCOL = 'MKCOL';

	/**
	 * Represents the HTTP request method `MOVE`.
	 * @var string
	 */
	public const MOVE = 'MOVE';

	/**
	 * Represents the HTTP request method `OPTIONS`.
	 * @var string
	 */
	public const OPTIONS = 'OPTIONS';

	/**
	 * Represents the HTTP request method `PATCH`.
	 * @var string
	 */
	public const PATCH = 'PATCH';

	/**
	 * Represents the HTTP request method `POST`.
	 * @var string
	 */
	public const POST = 'POST';

	/**
	 * Represents the HTTP request method `PROPFIND`.
	 * @var string
	 */
	public const PROPFIND = 'PROPFIND';

	/**
	 * Represents the HTTP request method `PROPPATCH`.
	 * @var string
	 */
	public const PROPPATCH = 'PROPPATCH';

	/**
	 * Represents the HTTP request method `PUT`.
	 * @var string
	 */
	public const PUT = 'PUT';

	/**
	 * Represents the HTTP request method `TRACE`.
	 * @var string
	 */
	public const TRACE = 'TRACE';

	/**
	 * Represents the HTTP request method `UNLOCK`.
	 * @var string
	 */
	public const UNLOCK = 'UNLOCK';
}
