<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 05/12/16
 * Time: 22:03
 */

namespace AppBundle;


use Skeleton\ConfigLoader\DirectoryConfigLoader;
use Skeleton\Skeleton;
use Squid\MySql;

class Scope
{
    /** @var Skeleton */
    private static $skeleton = null;

    /** @var  MySql */
    private static $mysql = null;


    public static function skeleton()
    {
        if (is_null(self::$skeleton))
        {
            self::$skeleton = new Skeleton();
            self::$skeleton
                ->enableKnot()
                ->useGlobal()
                ->setConfigLoader(
                    new DirectoryConfigLoader(__DIR__ . '/../../skeleton')
                );
        }

        return self::$skeleton;
    }

    /**
     * @return MySql|MySql\IMySqlConnector
     */
    public static function connector()
    {
        if(is_null(self::$mysql)){
            self::$mysql = new MySql();
            self::$mysql
                ->config()
                ->setConfig([
                    'host'  => 'localhost',
                    'pass'  => 'rootroot',
                    'user'  => 'root',
                    'db'    => 'college_app'
                ]);
        }

        return self::$mysql->getConnector();
    }


}