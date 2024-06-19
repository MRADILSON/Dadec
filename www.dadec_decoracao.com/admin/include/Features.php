<?php

class Features extends DB_Object
{
    protected static $db_table = "tbl_caracteristica";
    protected static $db_table_fields = array(
        'feature_id',
        'category_id',
        'title',
        'descricao'
    );

    public $feature_id;
    public $category_id;
    public $title;
    public $description;
    public $wedding_type;

    public static function getAllfeatures() {
    	global $db;
    	$sql = "SELECT * FROM tbl_caracteristica INNER JOIN tbl_decoracao_categoria ON tbl_caracteristica.category_id = tbl_decoracao_categoria.id";
    	$result_set = $db->query($sql);

        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;
    }

    // public static function getAllfeaturesEventsUser($booking_id) {
    //     global $db;
    //     $sql = "SELECT * FROM tbl_features INNER JOIN tblweddingcategories ON tblweddingcategories.id = tbl_features.category_id";
    //     $result_set = $db->query($sql);

    //     $the_object_array = array();

    //     while($row = mysqli_fetch_array($result_set)) {
    //         $the_object_array[] = static::instantiation($row);
    //     }
    //     return $the_object_array;
    // }
    

}

?>


