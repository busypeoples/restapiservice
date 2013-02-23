<?php

namespace RestExample\Exception;

class RepresentationNotFound extends \Exception {
    protected $code = 406;
    protected $message = 'Representation not found';
    
}
