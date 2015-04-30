<?php

/**
 * Class ServiceTab
 */
class ServiceTab extends ProductTab {

    private static $has_many = array (
        'Rows' => 'ServiceRow'
    );

}