<?php

class Users extends DB_Object
{
    protected static $db_table = "tbl_usuarios";
    protected static $db_table_fields = array(
        'id',
        'nome',
        'genero',
        'usuario',
        'password',
        'email',
        'designacao',
        'endereco',
        'nivel_acesso',
        'foto',
        'data_criacao'
    );

    public $id;
    public $nome;
    public $genero;
    public $usuario;
    public $password;
    public $email;
    public $designacao;
    public $nivel_acesso;
    public $endereco;
    public $foto;
    public $data_criacao;

    public $upload_directory = "upload/users";
    public $image_placeholder = "http://placehold.it/64x64&text=images";
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

     public function set_file($file)
    {
        if(empty($file) || !$file || !is_array($file))
        {
           
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->foto_perfil = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    public function profile_picture_picture() {
        return empty($this->foto) ? $this->image_placeholder : $this->upload_directory. '/' .$this->foto;
    }
    
    public function picture_path() {
        return $this->upload_directory . '/' . $this->foto;
    }


    public function delete_photo() {
        if($this->delete())
        {
            $target_path = SITE_ROOT.DS.$this->upload_directory.DS.$this->foto;
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }

    // saving image
    public function save_image()
    {
            if(!empty($this->errors))
            {
                return false;
            }

            if(empty($this->foto) || empty($this->tmp_path))
            {
                $this->errors[] = "The file was not available";
                return false;
            }
            
            $target_path =  SITE_ROOT . DS .  $this->upload_directory . DS . $this->foto;
                     
            if(file_exists($target_path))
            {
                $this->errors[] = "The file {$this->foto} already exists";
                return false;
            }

            if(move_uploaded_file($this->tmp_path, $target_path))
            {
                unset($this->tmp_path);
                return true;
            } else {
                $this->errors[] = "The File directory probably does not have permession";
                return false;
            }
    }
    
    

    public function save() {
        if ($this->id) {

            $this->update();

        } else {

            if (!empty($this->errors)) {
                return false;
            }

            if (empty($this->foto_perfil) || empty($this->tmp_path)) {
                $this->errors[] = "The file was not available";
                return false;
            }

            $target_path = SITE_ROOT . '/'  . $this->upload_directory . '/' . $this->foto;

            if (file_exists($target_path)) {
                $this->errors[] = "The file {$this->foto} already exists";
                return false;
            }

            if (move_uploaded_file($this->tmp_path, $target_path)) {
                if ($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
                
            } else {
                $this->errors[] = "The File directory probably does not have permession";
                return false;
            }

        }

    }

    public static function user_account_login($email, $password)
    {
        global $db;
        $email = $db->escape_string($email);
        $password = $db->escape_string($password);
        $password = md5($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE email = '{$email}' AND password='{$password}'";
        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function email_exists($email) {
        global $db;
        $sql = "SELECT user_id FROM " . self::$db_table . " WHERE email = '$email'";
        $result = $db->query($sql);
        if(mysqli_num_rows($result) == 1) {
            return true;
        } else {
            return false;
        }
    }

}

?>


