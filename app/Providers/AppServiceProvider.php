<?php

namespace App\Providers;

use App\Libraries\SQLLog;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function (QueryExecuted $event) {
            $sql      = $event->sql;
            $bind_sql = $sql;
            if (!empty($event->bindings)) {
                $sql = str_replace('?', "'?'", $sql);
                $sql = str_replace_array('?', $event->bindings, $sql);
            }
            SQLLog::write('db-listen', [
                'sql'      => $sql,
                'bind_sql' => $bind_sql,
                'consume'  => $event->time,
                'db_name'  => $event->connection->getDatabaseName(),
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
