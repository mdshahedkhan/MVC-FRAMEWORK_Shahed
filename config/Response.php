<?php

namespace App\Config;

class Response
{

    public final const Created = 201;
    public final const Accepted = 202;
    public final const NonAuthoritativeInformation = 203;
    public final const HttpOk = 200;
    public final const NoContent = 204;
    public final const ResetContent = 205;
    public final const PartialContent = 206;
    public final const MultiStatus = 207;
    public final const AlreadyReported = 208;
    public final const IMUsed = 226;
    public final const MultipleChoices = 300;
    public final const MovedPermanently = 301;
    public final const Found = 302;
    public final const SeeOther = 303;
    public final const NotModified = 304;
    public final const UseProxy = 305;
    public final const SwitchProxy = 306;
    public final const TemporaryRedirect = 307;
    public final const PermanentRedirect = 308;
    public final const Unauthorized = 401;
    public final const Forbidden = 403;
    public final const NotFound = 404;
    public final const BadRequest = 400;
    public final const PaymentRequired = 402;
    public final const MethodNotAllowed = 405;
    public final const NotAcceptable = 406;
    public final const ProxyAuthenticationRequired = 407;
    public final const RequestTimeout = 408;
    public final const Conflict = 409;
    public final const Gone = 410;
    public final const LengthRequired = 411;
    public final const PreconditionFailed = 412;
    public final const RequestEntityTooLarge = 413;
    public final const RequestURITooLong = 414;
    public final const UnsupportedMediaType = 415;
    public final const RequestedRangeNotSatisfiable = 416;
    public final const ExpectationFailed = 417;
    public final const UnprocessableEntity = 422;
    public final const Locked = 423;
    public final const FailedDependency = 424;
    public final const UnorderedCollection = 425;
    public final const UpgradeRequired = 426;
    public final const PreconditionRequired = 428;
    public final const TooManyRequests = 429;
    public final const RequestHeaderFieldsTooLarge = 431;
    public final const NoResponse = 444;
    public final const RetryWith = 449;
    public final const BlockedByWindowsParentalControls = 450;
    public final const UnavailableForLegalReasons = 451;
    public final const ClientClosedRequest = 499;
    public final const InternalServerError = 500;
    public final const NotImplemented = 501;
    public final const BadGateway = 502;
    public final const ServiceUnavailable = 503;
    public final const GatewayTimeout = 504;
    public final const HTTPVersionNotSupported = 505;
    public final const VariantAlsoNegotiates = 506;
    public final const InsufficientStorageWebDAV = 507;
    public final const LoopDetected = 508;
    public final const BandwidthLimitExceeded = 509;
    public final const NotExtended = 510;
    public final const NetworkAuthenticationRequired = 511;
    public final const NetworkReadTimeoutError = 598;
    public final const NetworkConnectTimeoutError = 599;


    public function setStatusCode(int $code): bool
    {
        return http_response_code($code);
    }
}