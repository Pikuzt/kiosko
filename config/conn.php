<?php
//phpinfo();


class DB
{
          private $host = '192.168.3.98'; //1433
          private $database = 'ZERO_Tesoreria';
          private $user = 'sa';
          private $password = 'C0ntp4c';
          // private $user = 'soporte';
          // private $password = '123456';
          private $pdo;
          private $query;
          private $bConnected = false;
          private $parameters;

          /**
           * DB constructor..
           */



          public function conn()
          {




                    // $dbh = new PDO("sqlsrv:server=PIKUZT\SQLEXPRESS;
                    // Database=adSOLORO_SA_DE_CV", $this->user , $this->password,
                    // array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));


                    $dbh = new PDO(
                              "sqlsrv:Server=25.69.105.242\CONTPAC; 
                              Database=adSOLORO_SA_DE_CV",
                              $this->user,
                              $this->password,

                    );

                    $dbh->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);

                    return $dbh;
          }


          public function Base2()
          {




                    // $dbh = new PDO("sqlsrv:server=PIKUZT\SQLEXPRESS;
                    // Database=adSOLORO_SA_DE_CV", $this->user , $this->password,
                    // array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));


                    $dbh = new PDO(
                              "sqlsrv:Server=25.69.105.242\CONTPAC; 
                              Database=adSOLORO_SA_DE_CV2021",
                              $this->user,
                              $this->password,

                    );

                    $dbh->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);

                    return $dbh;
          }
}
