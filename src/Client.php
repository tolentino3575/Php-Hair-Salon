<?php

    Class Client
    {
        private $name;
        private $client_id;
        private $id;

        function __construct($name, $client_id, $id=null)
        {
            $this->name = $name;
            $this->client_id = $client_id;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getClientId()
        {
            return $this->client_id;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (name, client_id) VALUES ('{$this->getName()}', {$this->getClientId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients");
            $clients = array();
            foreach ($returned_clients as $client){
                $name = $client['name'];
                $client_id = $client['client_id'];
                $id = $client['id'];
                $new_client = new Client($name, $client_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

        static function find($search_id)
        {
            $found_client = null;
            $clients = Client::getAll();
            foreach ($clients as $client)
            {
                $client_id = $client->getId();
                if($client_id == $search_id)
                {
                    $found_client = $client;
                }
            }
            return $found_client;
        }

        function getStylist()
        {
            $found_stylist = null;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist)
                {
                    $stylist_id = $stylist->getId();
                    if($stylist_id == $this->getClientId())
                    {
                        $found_stylist = $stylist;
                    }
                }
                return $found_stylist;

        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
        }

    }




?>
