<?php
namespace Crud\App;

class Database{
    private $filePath = __DIR__.'/../storage/database';
    private $data = [];
    private $isOpened = false;

    public function __construct()
    {
        $this->readFile();
    }

    public function readFile(){
        $readContent = file_get_contents($this->filePath);
        $this->data = (array) json_decode($readContent, true);
        return $this;
    }

    public function saveData($data)
    {
        $this->data[] = $data;
        $this->saveContent();
        echo '
            <script type = "text/javascript">
                alert("User Information Added Successfully !!!");
                window.location = "index.php";
            </script>
        ';
    }

    public function updateData($id, $name, $age, $email)
    {
        $existingData = $this->data;
        $data = array();
        $data['id'] = $id;
        $data['name'] = $name;
        $data['age'] = $age;
        $data['email'] = $email;


        $this->data = array_map(function ($user) use ($id, $data) {
            if ($user['id'] === $id){
                return $data;
            }
            return $user;
        }, $existingData);

        $this->saveContent();
        echo '
            <script type = "text/javascript">
                alert("User Information Update Successfully !!!");
                window.location = "index.php";
            </script>
        ';
    }

    public function search_user_info($id)
    {
        $takeId = $id;
        $existingData = $this->data;

        $found_info = array_search($takeId, array_column($existingData, 'id'));
        $found_info1 = $existingData[$found_info];

        return $found_info1;
    }

    public function saveContent()
    {
        $content = json_encode($this->data,JSON_PRETTY_PRINT);
        file_put_contents($this->filePath, $content);
    }

    public function getData(){
        return $this->data;
    }

    public function deleteInfo($id)
    {
        $takeId = $id;
        $existingData = $this->data;

        $found_info = array_search($takeId, array_column($existingData, 'id'));

        unset($existingData[$found_info]);

        $newUpdatedData = $existingData;

        $myfile = fopen($this->filePath, "w") or die("Unable to open file!");
        $content = json_encode($newUpdatedData,JSON_PRETTY_PRINT);
        fwrite($myfile, $content);
        fclose($myfile);

        echo '
            <script type = "text/javascript">
                alert("User Information Deleted Successfully !!!");
                window.location = "index.php";
            </script>
        ';
    }

}