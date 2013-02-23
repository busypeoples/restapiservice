<?php

namespace RestExample\Exception;

class MethodNotAllowed extends \Exception {
    protected $code = 405;
    protected $message = 'Method not allowed.';
}
