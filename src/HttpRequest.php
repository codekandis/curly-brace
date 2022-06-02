<?php declare( strict_types = 1 );
namespace CodeKandis\CurlyBrace;

use CodeKandis\CurlyBrace\Headers\Cookies\Cookie;
use CodeKandis\CurlyBrace\Headers\Cookies\CookieJar;
use CodeKandis\CurlyBrace\Headers\Cookies\CookieJarInterface;
use CodeKandis\CurlyBrace\Headers\HeaderNamePreparator;
use CodeKandis\CurlyBrace\Headers\HeaderValuePreparator;
use CodeKandis\CurlyBrace\Headers\RequestHeaderCollection;
use CodeKandis\CurlyBrace\Headers\RequestHeaderCollectionInterface;
use CodeKandis\CurlyBrace\Headers\RequestHeaderInterface;
use CodeKandis\CurlyBrace\Headers\ResponseHeader;
use CodeKandis\CurlyBrace\Headers\ResponseHeaderCollection;
use CodeKandis\CurlyBrace\Headers\ResponseHeaderCollectionInterface;
use CodeKandis\CurlyBrace\Queries\GetArgumentCollection;
use CodeKandis\CurlyBrace\Queries\GetArgumentCollectionInterface;
use CodeKandis\CurlyBrace\Queries\PostArgumentCollection;
use CodeKandis\CurlyBrace\Queries\PostArgumentCollectionInterface;
use function array_map;
use function array_merge;
use function count;
use function curl_close;
use function curl_errno;
use function curl_error;
use function curl_exec;
use function curl_init;
use function curl_setopt;
use function explode;
use function sprintf;
use function strlen;
use function strtolower;
use const CURLOPT_CUSTOMREQUEST;
use const CURLOPT_HEADERFUNCTION;
use const CURLOPT_HTTPHEADER;
use const CURLOPT_POSTFIELDS;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_URL;

/**
 * Represents a HTTP request.
 * @package codekandis/curly-brace
 * @author Christian Ramelow <info@codekandis.net>
 */
class HttpRequest implements HttpRequestInterface
{
	/**
	 * Stores the request headers.
	 * @var RequestHeaderCollectionInterface
	 */
	private RequestHeaderCollectionInterface $headers;

	/**
	 * Stores the cookie jar.
	 * @var CookieJarInterface
	 */
	private CookieJarInterface $cookieJar;

	/**
	 * Stores the URI to send the request to.
	 * @var string
	 */
	private string $uri;

	/**
	 * Stores the HTTP request method.
	 * @var string
	 */
	private string $httpRequestMethod = HttpRequestMethods::GET;

	/**
	 * Stores the get arguments.
	 * @var GetArgumentCollectionInterface
	 */
	private GetArgumentCollectionInterface $getArguments;

	/**
	 * Stores the post arguments.
	 * @var PostArgumentCollectionInterface
	 */
	private PostArgumentCollectionInterface $postArguments;

	/**
	 * Stores the additional cURL options.
	 * @var array[]
	 */
	private array $curlOptions = [];

	/**
	 * Constructor method.
	 * @param string $uri The URI to send the request to.
	 */
	public function __construct( string $uri )
	{
		$this->uri = $uri;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getHeaders(): RequestHeaderCollectionInterface
	{
		return $this->headers ?? $this->headers = new RequestHeaderCollection();
	}

	/**
	 * Sets the collection of request headers.
	 * @param RequestHeaderCollectionInterface $headers The collection of request headers.
	 */
	public function setHeaders( RequestHeaderCollectionInterface $headers ): void
	{
		$this->headers = $headers;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getCookieJar(): CookieJarInterface
	{
		return $this->cookieJar ?? $this->cookieJar = new CookieJar();
	}

	/**
	 * Sets the cookie jar.
	 * @param CookieJarInterface $cookieJar The cookie jar.
	 */
	public function setCookieJar( CookieJarInterface $cookieJar ): void
	{
		$this->cookieJar = $cookieJar;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getHttpRequestMethod(): string
	{
		return $this->httpRequestMethod;
	}

	/**
	 * Sets the HTTP request method.
	 * @param string $httpRequestMethod The HTTP method.
	 */
	public function setHttpRequestMethod( string $httpRequestMethod ): void
	{
		$this->httpRequestMethod = $httpRequestMethod;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getGetArguments(): GetArgumentCollectionInterface
	{
		return $this->getArguments ?? $this->getArguments = new GetArgumentCollection();
	}

	/**
	 * Sets the collection of get arguments.
	 * @param GetArgumentCollectionInterface $getArguments The collection of get arguments.
	 */
	public function setGetArguments( GetArgumentCollectionInterface $getArguments ): void
	{
		$this->getArguments = $getArguments;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getPostArguments(): PostArgumentCollectionInterface
	{
		return $this->postArguments ?? $this->postArguments = new PostArgumentCollection();
	}

	/**
	 * Sets the collection of post arguments.
	 * @param PostArgumentCollectionInterface $postArguments The collection of post arguments.
	 */
	public function setPostArguments( PostArgumentCollectionInterface $postArguments ): void
	{
		$this->postArguments = $postArguments;
	}

	/**
	 * {@inheritDoc}
	 */
	public function addCurlOptions( array $curlOptions ): void
	{
		$this->curlOptions = $this->curlOptions + $curlOptions;
	}

	/**
	 * Applies the cookie jar and the request headers to a cURL handle.
	 * @param resource $curlHandle The cURL handle to apply the cookie jar and the request headers to.
	 */
	private function applyHeaders( $curlHandle ): void
	{
		$headers = array_merge(
			[
				sprintf(
					'cookie: %s',
					$this->getCookieJar()
						 ->getRequestHeaderValue()
				)
			],
			array_map(
				function ( RequestHeaderInterface $requestHeader )
				{
					return $requestHeader->getFullHeaderString();
				},
				$this->getHeaders()
					 ->toArray()
			)
		);

		curl_setopt( $curlHandle, CURLOPT_HTTPHEADER, $headers );
	}

	/**
	 * Applies the URI with additional get arguments to a cURL handle.
	 * @param resource $curlHandle The cURL handle to apply the URI with additional get arguments to.
	 */
	private function applyUriWithGetArguments( $curlHandle ): void
	{
		curl_setopt(
			$curlHandle,
			CURLOPT_URL,
			0 === count( $this->getGetArguments() )
				? $this->uri
				: sprintf(
				'%s?%s',
				$this->uri,
				$this->getGetArguments()
					 ->getFullGetArgumentString()
			)
		);
	}

	/**
	 * Applies the post arguments to a cURL handle.
	 * @param resource $curlHandle The cURL handle to apply the post arguments to.
	 */
	private function applyPostArguments( $curlHandle ): void
	{
		curl_setopt(
			$curlHandle,
			CURLOPT_POSTFIELDS,
			$this->getPostArguments()
				 ->getFullPostArgumentString()
		);
	}

	/**
	 * Applies the closure used to parse the fetched response headers to a cURL handle.
	 * @param resource $curlHandle The cURL handle to apply the response header function to.
	 * @param ResponseHeaderCollectionInterface $responseHeaders The response headers.
	 */
	private function applyResponseHeaderFunction( $curlHandle, ResponseHeaderCollectionInterface $responseHeaders ): void
	{
		$headerNamePreparator  = new HeaderNamePreparator();
		$headerValuePreparator = new HeaderValuePreparator();

		$responseHeaderFunction = function ( $curlHandle, string $fetchedHeader ) use ( $responseHeaders, $headerNamePreparator, $headerValuePreparator )
		{
			$headerLength   = strlen( $fetchedHeader );
			$splittedHeader = explode( ':', $fetchedHeader, 2 );
			if ( count( $splittedHeader ) < 2 )
			{
				return $headerLength;
			}

			$headerName  = $headerNamePreparator->prepare( $splittedHeader[ 0 ] );
			$headerValue = $headerValuePreparator->prepare( $splittedHeader[ 1 ] );

			if ( 'set-cookie' === strtolower( $headerName ) )
			{
				$this->getCookieJar()
					 ->add( Cookie::fromCookieHeaderValue( $headerValue ) );
			}
			else
			{
				$responseHeaders->add(
					new ResponseHeader( $headerName, $headerValue )
				);
			}

			return $headerLength;
		};

		curl_setopt( $curlHandle, CURLOPT_HEADERFUNCTION, $responseHeaderFunction );
	}

	/**
	 * Applies the additional cURL options to a cURL handle.
	 * @param resource $curlHandle The cURL handle to apply the cURL options to.
	 */
	private function applyAdditionalCurlOptions( $curlHandle ): void
	{
		foreach ( $this->curlOptions as $curlOption => $curlOptionValue )
		{
			curl_setopt( $curlHandle, $curlOption, $curlOptionValue );
		}
	}

	/**
	 * Gets the request error, if an error occured.
	 * @param resource $curlHandle The handle of the request.
	 * @return ?RequestErrorInterface The request error, if an error occured, otherwise null.
	 */
	private function getRequestError( $curlHandle ): ?RequestErrorInterface
	{
		$curlErrorCode    = curl_errno( $curlHandle );
		$curlErrorMessage = curl_error( $curlHandle );

		return 0 !== $curlErrorCode
			? new RequestError(
				$curlErrorCode,
				$curlErrorMessage
			)
			: null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function send(): HttpRequestResultInterface
	{
		$curlHandle = curl_init();

		curl_setopt( $curlHandle, CURLOPT_CUSTOMREQUEST, $this->getHttpRequestMethod() );
		curl_setopt( $curlHandle, CURLOPT_RETURNTRANSFER, true );

		$this->applyHeaders( $curlHandle );
		$this->applyUriWithGetArguments( $curlHandle );
		$this->applyPostArguments( $curlHandle );

		$responseHeaders = new ResponseHeaderCollection();
		$this->applyResponseHeaderFunction( $curlHandle, $responseHeaders );

		$this->applyAdditionalCurlOptions( $curlHandle );

		$curlResponse = curl_exec( $curlHandle );
		$error        = $this->getRequestError( $curlHandle );
		curl_close( $curlHandle );

		if ( null !== $error )
		{
			return new HttpRequestResult( $error, null );
		}

		$response = new HttpResponse();
		$response->setHeaders( $responseHeaders );
		$response->setCookieJar( $this->getCookieJar() );

		if ( false !== $curlResponse )
		{
			$response->setPayload( $curlResponse );
		}

		return new HttpRequestResult( null, $response );
	}
}
