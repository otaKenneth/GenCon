<?php
include 'index.php';

$request = $_POST;

$contact = new Contact($db);
if (isset($_GET['update'])) {
    if ($_GET['update'] == "move to personal contacts") {
        $contact->update();
    }
}else{
    $contact->create($request);
}

class Contact {
    private $contacts;

    public function __construct($db)
    {
        $this->contacts = new Contacts($db);
    }

    public function all() {
        $res = $this->contacts->all();

        return $res;
    }

    public function create ($request) {
        $new_contact = [
            'user_id' => $request['user_id'],
            'name' => $request['name'],
            'cnum' => $request['cnum'],
            'in_gen' => ($request['in_gen'] == "on") ? true:false
        ];

        if ($new_contact['in_gen']) {
            if (count($this->contacts->where('in_gen')['data']) == 15) {
                header("Location: ../?err=meetmax");
            };
        }

        if ($this->contacts->create($new_contact)) {
            header("Location: ../");
        }
    }

    public function update () {
        $id = $_GET['contact_id'];

        if ($this->contacts->update($id,['in_gen' => false])) {
            header("Location: ../");
        }

    }
}

?>