// check user for permision to new dashboard 
function isAllUsers()
{
    global $current_user;
    $user = get_userdata($current_user->ID);
    $roles = array(
        'administrator',
        'subscriber',
        'student',
        'customer',
        'productionteam',
        'admin',
        'developer',
        'accounts',
        'coursemaintenance'
    );
    $permission = 0;
    foreach ($roles as $role) {
        if (in_array($role, (array) $user->roles)) {
            $permission = true;
            return $permission;
        }
    }
    return $permission;
}
