<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost;dbname=hairsalon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
            Stylist::deleteAll();
        }
        function test_getName()
        {
            //Arrange
            $name="Patty";
            $client_id = null;
            $test_client = new Client($name, $client_id);

            //Act
            $result = $test_client->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Patty";
            $id = 1;
            $test_client = new Client($name, $id);

            //Act
            $result = $test_client->getId();
            var_dump($result);
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Jess";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $client_name = "Patty";
            $client_id = $test_stylist->getId();
            $test_client = new Client($name, $client_id, $id);

            //Act
            $test_client->save();

            //Assert
            $result = Client::getAll();
            $this->assertEquals($test_client, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Jess";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $client_name = "Patty";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name2 = "Bri";
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Patty";
            $id = null;
            $name2 = "Bri";
            $test_client = new Client($name, $id);
            $test_client->save();
            $test_client2 = new Client($name2, $id);
            $test_client2->save();

            //Act
            Client::deleteAll();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Jess";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $client_name = "Patty";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id, $id);
            $test_client->save();

            $client_name2 = "Bri";
            $stylist_id = $test_stylist->getId();
            $test_client2 = new Client($client_name2, $stylist_id, $id);
            $test_client2->save();

            //Act
            $result = Client::find($test_client->getId());

            //Assert
            $this->assertEquals($test_client, $result);
        }

        function test_update()
        {
            $name = "Patty";
            $id = null;
            $test_client = new Client($name, $id);
            $test_client->save();

            $new_name = "Pat";

            //Act
            $test_client->update($new_name);

            //Assert
            $this->assertEquals("Pat", $test_client->getName());
        }

    }





?>
