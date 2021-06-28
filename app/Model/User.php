<?php
App::uses('AppModel', 'Model');

/**
* Class User
*/
class User extends AppModel
{

    /**
     * Get customer number
     *
     * @param int $userId
     * @return string
     */
    public function getCustomerNo($userId)
    {
        return 'Unit' . base_convert($userId, 10, 5);
    }

}
