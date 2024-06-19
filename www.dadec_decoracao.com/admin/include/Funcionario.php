<?php

class Funcionario extends DB_Object
{
    protected static $db_table = "tbl_funcionario";
    protected static $db_table_fields = array(
        'id',
        'nome',
        'idade',
        'contacto',
        'endereco',
        'funcao',
        'salario',
    );

    public $id;
    public $nome;
    public $idade;
    public $contacto;
    public $endereco;
    public $funcao;
    public $salario;

    public $errors = array();

    public $upload_errors_array = array(
    UPLOAD_ERR_OK         => "There is no error",
    UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds the upload_max_filesize disc",
    UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the MAX_FILE_SIZE directives",
    UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded.",
    UPLOAD_ERR_NO_FILE    => "No file was uploaded",
    UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
    UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
    UPLOAD_ERR_EXTENSION  => "A PHP extension stopped the file upload."
    );

}

?>


