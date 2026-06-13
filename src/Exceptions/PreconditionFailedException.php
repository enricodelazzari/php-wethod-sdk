<?php

namespace EnricoDeLazzari\Wethod\Exceptions;

/**
 * Thrown on a 412 response: a request precondition was not met.
 */
class PreconditionFailedException extends WethodRequestException {}
