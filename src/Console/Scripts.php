<?php
/**
 * This file is part of `oanhnn/slim-skeleton` project.
 *
 * (c) Oanh Nguyen <oanhnn.bk@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace App\Console;

use \Composer\Script\Event;
use \Composer\IO\IOInterface;

/**
 * Provides installation hooks for when this application is installed via
 * composer. Customize this class to suit your needs.
 */
class Scripts
{
    /**
     * Path to config directory
     *
     * @var string
     */
    protected static $configDir = '/app/config';

    /**
     * List writable directories
     *
     * @var array
     */
    protected static $writableDirs = ['/tmp'];

    /**
     * Does some tasks after create project by composer.
     *
     * @param Event $event The composer event object.
     * @return void
     */
    public static function postCreateProject(Event $event)
    {
        $io = $event->getIO();
        $rootDir = dirname(dirname(__DIR__));

        static::setWritableDirs($rootDir, $io);
        static::createAppConfig($rootDir, $io);
        static::setSecuritySalt($rootDir, $io);
    }

//    public static function doTest();
//    public static function deploy();
//    public static function startServer();
//    public static function stopServer();
//
//    public static function runUnitTest();
//    public static function checkCodingStyle();
//    public static function installGulp();
//    public static function installDeployer();

    /**
     * Create the application's config file if it does not exist.
     *
     * @param string $dir The application's root directory.
     * @param IOInterface $io IO interface to write to console.
     * @return void
     */
    protected static function createAppConfig($dir, $io)
    {
        $io->write("=> Create the application's config file");

        $appConfig     = $dir . self::$configDir . '/app.php';
        $defaultConfig = $dir . self::$configDir . '/app.default.php';
        if (file_exists($appConfig)) {
            $io->write("   - File `{$appConfig}` already exists", true, IOInterface::VERBOSE);
            return;
        }

        if (copy($defaultConfig, $appConfig)) {
            $io->write("   + File `{$appConfig}` is created", true, IOInterface::VERBOSE);
        } else {
            $io->write("   - Unable to create file `{$appConfig}`", true, IOInterface::VERBOSE);
        }
    }

    /**
     * Set globally writable permissions on the "tmp" and "logs" directory.
     *
     * This is not the most secure default, but it gets people up and running quickly.
     *
     * @param string $dir The application's root directory.
     * @param \Composer\IO\IOInterface $io IO interface to write to console.
     * @return void
     */
    protected static function setWritableDirs($dir, $io)
    {
        $io->write("=> Set globally writable permissions");

        $changedDirs = [];
        $writablePerms = bindec('0000000111');
        foreach (self::$writableDirs as $path) {
            array_merge($changedDirs, self::chmodDir($writablePerms, $dir . DIRECTORY_SEPARATOR . $path));
        }

        if (empty($changedDirs)) {
            $io->write("   - No directory is changed permission", true, IOInterface::VERBOSE);
        } else {
            foreach ($changedDirs as $path) {
                $io->write("   + Set writable on '{$path}'", true, IOInterface::VERBOSE);
            }
        }
    }

    /**
     * Set the security.salt value in the application's config file.
     *
     * @param string $dir The application's root directory.
     * @param IOInterface $io IO interface to write to console.
     * @return void
     */
    protected static function setSecuritySalt($dir, $io)
    {
        $io->write("=> Set the security.salt value");

        $config  = $dir . self::$configDir . '/app.php';
        $content = file_get_contents($config);

        $newKey  = hash('sha256', $dir . php_uname() . microtime(true));
        $content = str_replace('__@@KEY@@__', $newKey, $content, $count);

        if ($count == 0) {
            $io->write("   - No Security.salt placeholder to replace.", true, IOInterface::VERBOSE);
            return;
        }

        $result = file_put_contents($config, $content);
        if ($result) {
            $io->write("   + Updated Security.salt value in application's config file", true, IOInterface::VERBOSE);
            return;
        }
        $io->write("   - Unable to update Security.salt value.", true, IOInterface::VERBOSE);
    }

    /**
     * Change permission of a directory and sub-directories
     *
     * @param number $perms
     * @param string $dir
     * @return array List directories are changed permission
     */
    protected static function chmodDir($perms, $dir)
    {
        $changedDirs = [];
        // chmod for current directory
        $currentPerms = octdec(substr(sprintf('%o', fileperms($dir)), -4));
        if (($currentPerms & $perms) !== $perms) {
            $res = chmod($dir, $currentPerms | $perms);
            if ($res) {
                $changedDirs[] = $dir;
            }
        }
        // chmod for sub-directories
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;

            if (!is_dir($path)) {
                continue;
            }

            array_merge($changedDirs, self::chmodDir($perms, $path));
        }

        return $changedDirs;
    }

    /**
     *
     * @param type $cmd
     * @return type
     */
    protected function runCommand($cmd)
    {
        exec(escapeshellcmd($cmd), $output, $code);

        return [$code, $output];
    }
}
