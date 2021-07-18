<?php
    include("../inc/dbh.inc.php");
    session_start();

    class Model extends Connect{
        

        protected function createPost($userId,$post){
            $myConn = $this->conn();
            
                $stmt =  $myConn->prepare("INSERT INTO posts (`userId`,`post`) VALUES (?,?);");
                $stmt->bind_param("ss", $userId,$post);
                $stmt->execute();
                $allPost = $this->getPosts();
                return array(
                    'status'=>1,
                     $allPost
                );
        }

        protected function createComment($postId,$comment){
            $myConn = $this->conn();
            
                $stmt =  $myConn->prepare("INSERT INTO comments (`postId`,`comment`) VALUES (?,?);");
                $stmt->bind_param("ss", $postId,$comment);
                $stmt->execute();
                return array(
                    'status'=>1,
                    'msg'=>'comment made successfull'
                );
        }

       
    

        protected function getPosts(){
            $myConn = $this->conn();

            $data = array();

            $sql = "SELECT `first_name`,`last_name`,`post` FROM (posts INNER JOIN users ON posts.userId=users.id)";

            //         SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
            // FROM Orders
            // INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID;

            $result =  $myConn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                $data[]=$row;
                }
                return $data;

            }
            else{
                $data[] = array(
                    'status'=>0,
                    'msg' => 'no post yet'
                );
                return $data;
            }

        }



        protected function getSinglePosts($userId){
            $myConn = $this->conn();
            $data = array();

            $sql = "SELECT `post`,`postId`,`comment` FROM comments INNER JOIN posts ON comments.postId=posts.id WHERE posts.userId='$userId'";


            $result =  $myConn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                $data[]=$row;
                }
                return $data;

            }
            else{
                $data[] = array(
                    'status'=>0,
                    'msg' => 'no comment yet'
                );
                return $data;
            }

        }
       
    }

//     $conn = new Model();
//   var_dump($conn->getSinglePosts(1));
// $conin = new Model();
// $conin->addMedicine('olu','jos','emzor','pcs','100','400','5');

?>