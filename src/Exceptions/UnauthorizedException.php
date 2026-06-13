<?php

namespace EnricoDeLazzari\Wethod\Exceptions;

/**
 * Thrown on a 401 response: the API token is missing, invalid or expired.
 */
class UnauthorizedException extends WethodRequestException {}
