<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hairsalon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }
        function test_getName()
        {
            //Arrange
            $name = "Sally";
            $test_stylist = new Stylist($name);

            //Act
            $result = $test_stylist->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Sally";
            $id = 1;
            $test_stylist = new Stylist($name, $id);

            //Act
            $result = $test_stylist->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Sally";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($test_stylist, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Sally";
            $id = null;
            $name2 = "Jess";
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $test_stylist2 = new Stylist($name2, $id);
            $test_stylist2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_deleteAll()
        {
            $name = "Sally";
            $id = null;
            $name2 = "Jess";
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $test_stylist2 = new Stylist($name2, $id);
            $test_stylist2->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Sally";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name2 = "Jess";
            $id = null;
            $test_stylist2 = new Stylist($name2, $id);
            $test_stylist2->save();

            //Act
            $result = Stylist::find($test_stylist->getId());

            //Assert
            $this->assertEquals($test_stylist, $result);
        }

        function test_getClients()
        {
            //Arrange
            $name = "Sally";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $test_stylist_id = $test_stylist->getId();

            $client_name = "Patty";
            $test_client = new Client($client_name, $test_stylist_id, $id);
            $test_client->save();

            $client_name2 = "Bri";
            $test_client2 = new Client($client_name2, $test_stylist_id, $id);
            $test_client2->save();

            //Act
            $result = $test_stylist->getClients();
            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_update()
        {
            $name = "Jess";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $new_name = "Jessica";

            //Act
            $test_stylist->update($new_name);

            //Assert
            $this->assertEquals("Jessica", $test_stylist->getName());
        }

    }

?>
