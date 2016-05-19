<?php


namespace App\Provider;

use Aura\SqlQuery\QueryFactory;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use PDO;
use App\DB\PDOWrapper;

class PDOServiceProvider implements ServiceProviderInterface
{

    public function register(Container $c)
    {
        $c['db'] = function ($c) {
            $settings = $c->get('settings')['pdo'];
            $queryFactory = new QueryFactory('mysql');
            $pdo = new PDOWrapper($settings['driver'] . ":host=" . $settings['host'] . ";dbname=" . $settings['dbname'], $settings['username'], $settings['password'], null, $queryFactory);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $pdo;
        };
    }
}
