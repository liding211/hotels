<?php
/*
 * Plugin class
 *
 */
abstract class PluginsfGuardPermission extends BasesfGuardPermission
{

    public function __toString()
    {
        return $this->get( 'name' );
    }

    private function _getAllModulesAndActionsNames() {
        sfLoader::loadHelpers(array("MyCache"));
        if (!get_my_common_cache("all_modules_and_actions_for_permission_".md5($this->id))) {
            set_my_common_cache("all_modules_and_actions_for_permission_".md5($this->id),
                Doctrine_Manager::connection()->fetchAll("
                    SELECT m.module_name, m.action_name
                    FROM sf_guard_modules m
                    INNER JOIN sf_guard_modules_permission mp ON m.id = mp.module_id
                    WHERE mp.permission_id = ?", array($this->id)
                )
            );
        }
        return get_my_common_cache("all_modules_and_actions_for_permission_".md5($this->id));
    }

    public function getModuleList() {
        $output = array();
        $modules = $this->_getAllModulesAndActionsNames();
        foreach ($modules as $module) {
            $output[] = $module["module_name"].".".$module["action_name"];
        }
        return implode(", ", $output);
    }
}
