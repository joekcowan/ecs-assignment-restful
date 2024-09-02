<?php
include '../config/config.php';

/**
 * Creates a msqli connection object and returns it.
 * @return {object} $conn - Connection object.
 */
function create_conn()
{
  // Create connection
  $conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } else {
    return $conn;
  }
}

/**
 * Gets order data.
 * @param {string} $userId - The user id to bind to the qry.
 * @return {array} $userData - The returned data from the qry.
 */
function getOrders($userId)
{
  $conn = create_conn();
  // Prepare the SQL statement
  // Prepare the SQL statement
  $sql = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
  $sql->bind_param("i", $userId);

  // Execute the query
  $sql->execute();

  // Get the result
  $result = $sql->get_result();

  // Fetch the data as an associative array
  $userData = $result->fetch_all(MYSQLI_ASSOC);

  // Close the connection
  $sql->close();
  $conn->close();

  // Return the fetched data
  return $userData;
}

/**
 * Gets the item data for any one order.
 * @param {string} $orderNo - The user order umber to bind to the qry.
 * @return {array} $orderData - The returned data from the qry.
 */
function getOrderDetails($orderNo)
{
  $conn = create_conn();
  // Prepare the SQL statement
  // Prepare the SQL statement
  $sql = $conn->prepare("SELECT od.*, o.cust_name, o.cust_abbr FROM order_details as od INNER JOIN orders as o ON od.order_no = o.order_no  WHERE od.order_no = ?");
  $sql->bind_param("i", $orderNo);

  // Execute the query
  $sql->execute();

  // Get the result
  $result = $sql->get_result();

  // Fetch the data as an associative array
  $orderData = $result->fetch_all(MYSQLI_ASSOC);

  // Close the connection
  $sql->close();
  $conn->close();

  // Return the fetched data
  return $orderData;
}
