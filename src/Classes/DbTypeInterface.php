<?php
namespace App\Classes;

use App\Classes\DbInterface;
/**
 * The interface for the different db types for e.g., MySQL, MongoDB, etc...
 */
interface DbTypeInterface extends DbInterface
{
    public static function getInstance();
}