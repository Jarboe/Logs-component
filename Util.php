<?php

namespace Jarboe\Component\Logs;

use App;
use Route;
use Cache;
use File;
use Schema;
use Request;
use Session;
use Input;
use DB;
use Sentinel;


class Util extends \Yaro\Jarboe\Component\AbstractUtil
{
    
    public static function install($command)
    {
        self::copyIfNotExist($command, 'resources/definitions/logs.php', __DIR__);
        
        if (Schema::hasTable('logs')) {
            $command->info(' - Logs table already exists.');
        } else {
            Schema::create('logs', function($table) {
                $table->increments('id')->unsigned();
                
                $table->char('url', 255);
                
                $table->char('exception', 255);
                $table->char('message', 255);
                $table->char('file', 255);
                $table->char('method', 255);
                $table->text('trace');
                $table->tinyInteger('line');
                
                $table->text('server');
                $table->text('headers');
                $table->text('request');
                $table->text('old_request');
                $table->text('file_request');
                $table->text('session');
                $table->text('cookie');
                
                $table->timestamps();
            });
            $command->info(' - Logs table created.');
        }
    } // end install
    
    public static function getNavigationMenuItem() 
    {
        return array(
            'title' => 'Логи приложения', 
            'icon'  => 'bug',
            'link'  => '/logs',
            'check' => function() {
                return true;
            }
        );
    } // end getNavigationMenuItem
    
    public static function check()
    {
        $errors = [];
        if (!Schema::hasTable('logs')) {
            $errors[] = ' - Logs table is missing: run install to create.';
        }
        
        return $errors;
    } // end check
    
    public static function add($exception)
    {
        $data = [
            'url'          => Request::fullUrl(),
            'exception'    => get_class($exception),
            'trace'        => $exception->getTraceAsString(),
            'message'      => $exception->getMessage(),
            'file'         => $exception->getFile(),
            'line'         => $exception->getLine(),
            'method'       => Request::method(),
            'server'       => print_r(Request::server(), true),
            'headers'      => print_r(Request::header(), true),
            'request'      => print_r(Input::all(), true),
            'old_request'  => print_r(Request::hasSession() ? Request::old() : [], true),
            'file_request' => print_r(Request::file(), true),
            'session'      => print_r(Request::hasSession() ? Session::all() : [], true),
            'cookie'       => print_r(Request::cookie(), true),
            'created_at'   => date('Y-m-d H:i:s'),
        ];
        
        DB::table('logs')->insert($data);
        
        self::cleanLogsTable();
    } // end add
    
    private static function cleanLogsTable()
    {
        $count = DB::table('logs')->count();
        $extra = $count - config('jarboe.c.logs.max_count');
        if ($extra > 0) {
            DB::table('logs')->orderBy('id', 'asc')->limit($extra)->delete();
        }
    } // end cleanLogsTable

}

