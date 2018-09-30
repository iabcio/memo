
<?php
   class Conn {
      const UNIX_DOMAIN = "/tmp/shadow.sock";
      const SOCKET_READ_LEN = 512;
      const HEAD_LEN = 4;
      private static $_instance = null;
      private $_conn = null;
      public $err = null;

      public function connect() {
         $socket = socket_create(AF_UNIX, SOCK_STREAM, 0); //第三个参数为0
         if ($socket < 0) {
            echo "socket_create() failed.\nReason: " . socket_strerror($socket) . "\n";
         }

         $result = socket_connect($socket, self::UNIX_DOMAIN); //这里只要两个参数即可
         if ($result < 0) {
            echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
         }
         $this->_conn = $socket;
      }

      public static function instance() {
         if (self::$_instance == null) {
            self::$_instance = new self();
         }
         return self::$_instance;
      }

      /**
      * 提交到Agent
      * @param $command string
      * @return array  TODO zhaoxi, if Exception
      */
      public function call($command = null) {
         try{
            $this->connect();
            if (null === $command) {
               return '';
            }
            if (!socket_write($this->_conn, $command, strlen($command))) {
               // echo "socket_write() failed, no bytes have been written.\n";
            }

            $len = socket_read($this->_conn, 5); // 读取前5位长度
            $data = Parser::parse($this->_conn, $len);
            // TODO zhaoxi like JAVA finally?
            $this->close();
            return $data;
         }catch(Exception $e){
            // echo $e;
            return false;
         }
      }

      /**
      * 支持Redis的multi模式
      * @param commands array
      * @return array
      */
      public function pipeline(array $commands) {
         try{
            $this->connect();

            $length = count($commands) - 1;
            for($i = 0; $i < $length; $i++) {
               $command = array_shift($commands);
               socket_write($this->_conn, $command, strlen($command));
               // echo "send:".$command."\n";
               socket_read($this->_conn, 1024, PHP_NORMAL_READ);
               socket_read($this->_conn, 1); // read the extra \n
            }
            $command = array_shift($commands);
            // echo "send EXEC\n".$command;
            socket_write($this->_conn, $command, strlen($command));
            $len = socket_read($this->_conn, 5); // 读取前5位长度
            $data = Parser::parse($this->_conn, $len);

            $this->close();
            return $data;
         }catch(Exception $e){
            // echo $e;
            return false;
         }
      }

      public function close() {
         if (is_resource($this->_conn)) {
            socket_close($this->_conn);
         }
      }
   }

