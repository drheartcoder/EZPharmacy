<?php

/*namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Flash;
use Mail;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    
    public function report(Exception $e)
    {

        if(env('APP_ENV','local')!='local')
        {
           $error_severity = "Error";
           
            if (ExceptionHandler::isHttpException($e)) {
                $content = ExceptionHandler::toIlluminateResponse(ExceptionHandler::renderHttpException($e), $e);
            } else {
                $content = ExceptionHandler::toIlluminateResponse(ExceptionHandler::convertExceptionToResponse($e), $e);
            }

            $data['content'] = (!isset($content->original)) ? $e->getMessage() : $content->original;


            try
            {
                 
            }
            catch(\Exception $e)
            {
                dd($e);
            }
        }
        parent::report($e);
    }

    public function render($request, Exception $e)
    {

        if(env('APP_ENV','local')!='local')
        {
          if($e instanceof \Cartalyst\Sentinel\Checkpoints\ThrottlingException)
          {

            Flash::error($e->getMessage());
            return redirect()->back();
          }
          else
          { 
            parent::report($e);
            return response()->view('app_error',[],503); 
          }
        }

        return parent::render($request, $e);
    }
}*/



<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;


class OldHandler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    /*public function report(Exception $e)
    {
        parent::report($e);
        //NotFoundHttpException
    }*/
    
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    
    public function render($request, Exception $e)
    {

        /*$exception = FlattenException::create($e);
        $statusCode = $exception->getStatusCode($exception);
        dd($statusCode);*/
        /*return parent::render($request, $e);*/

        if($e instanceof NotFoundHttpException)
        {
            return parent::render($request, $e);
        }
        /*else if($e instanceof FatalThrowableError)
        {
            return parent::render($request, $e);
        }*/
        else
        {
            if(!empty($e->getMessage()))
            {

                /*echo '<pre>';*/
                /*echo '<br>****************'.$e->getMessage();*/
                /*echo '<br>****************'.$e->getCode();*/
                /*echo '<br>****************'.$e->getFile();*/
                /*echo '<br>****************'.$e->getLine();*/
                /*echo '<br>****************'.$e->getTrace();*/
                /*echo '<br>****************'.$e->getPrevious();*/
                /*echo '<br>****************'.$e->getTraceAsString();*/
                /*catch(\Illuminate\Database\QueryException $ex){
                if(isset($ex->errorInfo[2]))
                {
                    echo $ex->errorInfo[2].' : report error now @<a href="mailto:'.config('constants.ERROR_EMAIL').'">'.config('constants.EMAIL_NAME').'</a>';
                }
                else{
                    echo 'Unknown error, report error now <a href="mailto:'.config('constants.ERROR_EMAIL').'">'.config('constants.EMAIL_NAME').'</a>';
                }*/
                if(!empty($e->__toString()))
                {
                    echo stristr($e->__toString(), 'stack', true);
                }
                
                die;
            }
            else{
                /*return response()->view('common/errors/error_404',['message'=>'Invalid URL'],404);*/
                die;
            }
            
            
        }
    }
}
