<?php namespace App\Exceptions;
use Exception;

class InsufficientChange extends Exception
{
    /**
     * @param mixed $message
     */
    protected $message;

    /**
     * InsufficientChange constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Report the exception.
     *
     * @return void
     */

    public function report()
    {
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
            'message'=>$this->message
        ]);
    }
}