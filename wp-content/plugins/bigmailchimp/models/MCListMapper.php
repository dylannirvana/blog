<?php

/**
 * Description of MCListMapper
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class MCListMapper {

    protected $_dbTable;

    public function setDbTable($dbTable) {
        global $wpdb;
        $this->_dbTable = $wpdb->prefix . $dbTable;
        return $this;
    }

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('big_mailchimp_lists');
        }
        return $this->_dbTable;
    }

    public function save(MCList $mcList) {
        global $wpdb;
        $data = array(
            'api_key' => $mcList->getApi_key(),
            'list_id' => $mcList->getList_id(),
            'double_opt_in' => $mcList->getDouble_opt_in(),
            'button_text' => $mcList->getButton_text(),
        );
        if (null === ($id = $mcList->getId())) {
            unset($data['id']);
            return $wpdb->insert($this->getDbTable(), $data);
        } else {
            return $wpdb->update($this->getDbTable(), $data, array('id' => $mcList->getId()));
        }
    }

    public function find($id, MCList $mcList) {
        global $wpdb;
        $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM `{$this->getDbTable()}` WHERE id =%d", $id));
        if (count($row)) {
            $mcList->setId($row->id)
                    ->setApi_key($row->api_key)
                    ->setList_id($row->list_id)
                    ->setDouble_opt_in($row->double_opt_in)
                    ->setButton_text($row->button_text);
            return $mcList;
        }

        return;
    }

    public function fetchAll() {
        global $wpdb;
        $resultSet = $wpdb->get_results("SELECT * FROM `{$this->getDbTable()}`");
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new MCList();
            $entry->setId($row->id)
                    ->setApi_key($row->api_key)
                    ->setList_id($row->list_id)
                    ->setDouble_opt_in($row->double_opt_in)
                    ->setButton_text($row->button_text);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function remove($id) {
        global $wpdb;
        return $wpdb->query($wpdb->prepare("DELETE FROM `{$this->getDbTable()}` WHERE id = %d", $id));
    }

}
