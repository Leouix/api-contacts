<?php

require_once ROOT . '/models/Contacts.php';

class ContactsController {

    public function index() {

        if( isset( $_POST['array'] ) && !empty($_POST['array']) ) {
            $result = $this->addRows();
        } else if ( isset($_GET['phone']) && !empty($_GET['phone']) ) {
            $result = $this->getRows();
        }

        include ROOT . '/views/Contacts.php';

    }

    private function addRows() {

        $json_data = $_POST['array'];
        $array = json_decode( $json_data, true);

        if( Contacts::checkDateToday( $array['source_id'] )  ) {
            echo 'Для каждого источника данные добавляются максимум 1 раз в сутки';
            return false;
        }

        $count_items = count($array['items']);

        $option = '';
        for( $i=0; $i<$count_items; $i++ ) {
            if($option) $option .= ', ';
            $option .= '(?, ?, ?, ?)';
        }

        $dataToInsert = array();
        foreach ($array['items'] as $row => $data) {

            $dataToInsert[] = $array['source_id'];

            if( strlen($data['phone']) > 10  ) {
                $data['phone'] = substr($data['phone'], -10);
            }

            foreach($data as $val) {
                $dataToInsert[] = $val;
            }
        }

        return $result = Contacts::insertContacts( $option, $dataToInsert );

    }

    private function getRows() {

        $phone = $_GET['phone'];
        return Contacts::getRowsByPhone( $phone );

    }

}