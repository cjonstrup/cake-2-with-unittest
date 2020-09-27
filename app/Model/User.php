<?php
App::uses('AppModel', 'Model');

/**
 * Class User
 */
class User extends AppModel
{
    /**
     * Get online status
     */
    public function getOnline()
    {
        return true;
    }
}