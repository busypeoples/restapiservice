<?php

namespace RestExample\Exception;

class ResourceNotFound extends \Exception {
    protected $code = 404;
    protected $message = 'Resource not found.';
}
