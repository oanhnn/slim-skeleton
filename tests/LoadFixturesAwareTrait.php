<?php
/**
 * This file is part of `oanhnn/slim-skeleton` project.
 *
 * (c) Oanh Nguyen <oanhnn.bk@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace App\Tests;

trait LoadFixturesAwareTrait
{
    /**
     * @var \Slim\App
     */
    protected $app;

    /**
     * Load fixtures
     *
     * @param array $tables
     */
    protected function loadFixtures($tables = [])
    {
        $connection = $this->app->getContainer()->get('database');
        if (empty($connection)) {
            throw new \RuntimeException('DoctrineDBALServiceProvider registration required');
        }

        foreach ($tables as $table) {
            $filePath = __DIR__ . '/fixtures/' . $table . '.sql';

            if (!file_exists($filePath)) {
                throw new \InvalidArgumentException(sprintf("SQL file '%s' does not exist.", $filePath));
            } elseif (!is_readable($filePath)) {
                throw new \InvalidArgumentException(sprintf("SQL file '%s' does not have read permissions.", $filePath));
            }

            $sql = file_get_contents($filePath);

            //$connection->exec('TRUNCATE ' . $table);
            $connection->exec($sql);
        }
    }
}
