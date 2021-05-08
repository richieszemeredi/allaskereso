<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/model/Ceg.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/model/Felhasznalo.php';

if (!isset($_SESSION)) {
    session_start();
}

class AuthController
{

    private static ?AuthController $instance = null;

    private function __construct()
    {

    }

    public static function getInstance(): AuthController{
        if (self::$instance == null) {
            self::$instance = new AuthController();
        }
        return self::$instance;
    }

    /**
     * @throws Exception
     */

    public function __clone() {
        throw new Exception("Can't clone a singleton");
    }

    public function isFelhasznaloLoggedIn(): bool {
        return isset($_SESSION['felhasznalo']);
    }

    public function setCurrentFelhasznalo(Felhasznalo $felhasznalo): void {
        $_SESSION['felhasznalo'] = serialize($felhasznalo);
    }

    public function logOutCurrentFelhasznalo(): void{
        unset($_SESSION['felhasznalo']);
    }

    public function getCurrentFelhasznalo(): Felhasznalo | null {
        if ($this->isFelhasznaloLoggedIn()) {
            return unserialize($_SESSION['felhasznalo']);
        }
        return null;
    }

    public function isCegLoggedIn(): bool {
        return isset($_SESSION['ceg']);
    }

    public function setCurrentCeg(Ceg $ceg): void {
        $_SESSION['ceg'] = serialize($ceg);
    }

    public function logoutCurrentCeg(): void {
        unset($_SESSION['ceg']);
    }

    public function getCurrentCeg(): Ceg | null {
        if ($this->isCegLoggedIn()) {
            return unserialize($_SESSION['ceg']);
        }
        return null;
    }


}