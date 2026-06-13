<?php

namespace EnricoDeLazzari\Wethod\Exceptions;

/**
 * Thrown on a 403 response: the token lacks the required permissions.
 */
class ForbiddenException extends WethodRequestException {}
