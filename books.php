<?php

include("connection.php");

header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('Asia/Singapore');

$db = new dbConnection();
$connection = $db->getConnectionstring();
$request_method = $_SERVER["REQUEST_METHOD"];

/* Request method */
switch ($request_method) {

        // Insert Book
    case 'POST':
        addBook();
        break;

        // Retrive Book
    case 'GET':
        if (!empty($_GET["title"])) {
            $title = $_GET["title"];
            getBookByTitle($title);
        } else {
            getAllBooks();
        }
        break;
    default:

        // Update Book
    case 'PUT':
        $id = $_GET["id"];
        updateBookById($id);
        break;

        // Delete Book by id
    case 'DELETE':
        $id = $_GET["id"];
        deleteBookById($id);
        break;

        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

/* add book x-www-form-urlencoded*/
function addBook()
{
    global $connection;

    $id = uniqid();
    $title = $_POST["title"];
    $author = $_POST["author"];
    $year = $_POST["year"];
    $publisher = $_POST["publisher"];
    $summary = $_POST["summary"];
    $inserted_at = date("Y-m-d H:i:s");
    $updated_at = $inserted_at;

    if (!$title || !$author || !$year || !$publisher || !$summary) {
        header("Status: 400 Bad Request");
        echo json_encode(array(
            'status' => 'fail',
            'status_message' => 'Required field is empty.'
        ));
    } else {

        $query = "INSERT INTO books VALUES ('$id','$title','$author','$year','$publisher','$summary','$inserted_at','$updated_at')";

        if (mysqli_query($connection, $query)) {
            header("Status: 200 OK");
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Book data successfully added.'
            ));
        } else {
            header("Status: 502 Bad Gateway");
            echo json_encode(array(
                'status' => 'fail',
                'message' => 'Oops, add book failed. There is somethings wrong when trying to executing your command :('
            ));
        }
    }
}

/* get all books */
function getAllBooks()
{
    global $connection;

    $stmt = $connection->prepare("SELECT * FROM books ORDER BY inserted_at DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    $response = $result->fetch_all(MYSQLI_ASSOC);

    if (mysqli_num_rows($result) > 0) {
        header("Status: 200 OK");
        echo json_encode($response);
    } else {
        header("Status: 404 Not Found");
        echo json_encode(array(
            'status' => 'fail',
            'message' => 'Oops, there is no book data added yet :('
        ));
    }
}

/* get specific book by title params */
function getBookByTitle($title)
{
    global $connection;

    $stmt = $connection->prepare("SELECT * FROM books WHERE title LIKE '%" . $title . "%'");
    $stmt->execute();
    $result = $stmt->get_result();
    $response = $result->fetch_all(MYSQLI_ASSOC);

    if (mysqli_num_rows($result) > 0) {
        header("Status: 200 OK");
        echo json_encode($response);
    } else {
        header("Status: 404 Not Found");
        echo json_encode(array(
            'status' => 'fail',
            'message' => 'Book data not found.'
        ));
    }
}

/* update book by id params and item x-www-form-urlencoded*/
function updateBookById($id)
{
    global $connection;

    //check if book exist
    $stmt = $connection->prepare("SELECT * FROM books WHERE id LIKE '%" . $id . "%'");
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        parse_str(file_get_contents("php://input"), $post_vars);
        $title = $post_vars["title"];
        $author = $post_vars["author"];
        $year = $post_vars["year"];
        $publisher = $post_vars["publisher"];
        $summary = $post_vars["summary"];
        $updated_at = date("Y-m-d H:i:s");

        if (!$title || !$author || !$year || !$publisher || !$summary) {
            header("Status: 400 Bad Request");
            $response = array(
                'status' => 'fail',
                'status_message' => 'Required field is empty.'
            );
        } else {

            $query = "UPDATE books SET title='" . $title . "', author='" . $author . "', year='" . $year . "', publisher='" . $publisher . "', summary='" . $summary . "', updated_at='" . $updated_at . "' WHERE id LIKE '%" . $id . "%'";

            if (mysqli_query($connection, $query)) {
                header("Status: 200 OK");
                $response = array(
                    'status' => 'success',
                    'status_message' => 'Book successfully updated.'
                );
            } else {
                header("Status: 502 Bad Gateway");
                $response = array(
                    'status' => 'fail',
                    'status_message' => 'Oops, update book failed. There is somethings wrong when trying to executing your command :('
                );
            }
        }
    } else {
        header("Status: 404 Not Found");
        $response = array(
            'status' => 'fail',
            'status_message' => 'Book updating failed. Book id not found.'
        );
    }
    echo json_encode($response);
}

/* delete specific book by id */
function deleteBookById($id)
{
    global $connection;

    //check if book exist
    $stmt = $connection->prepare("SELECT * FROM books WHERE id LIKE '%" . $id . "%'");
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {

        $query = "DELETE FROM books WHERE id LIKE '%" . $id . "%'";

        if (mysqli_query($connection, $query)) {
            header("Status: 200 OK");
            $response = array(
                'status' => 'success',
                'status_message' => 'Book successfully deleted.'
            );
        } else {
            header("Status: 502 Bad Gateway");
            $response = array(
                'status' => 'fail',
                'status_message' => 'Oops, Book deletion failed. There is somethings wrong when trying to executing your command :('
            );
        }
    } else {
        header("Status: 404 Not Found");
        $response = array(
            'status' => 'fail',
            'status_message' => 'Book deletion failed. Book id not found.'
        );
    }

    echo json_encode($response);
}
