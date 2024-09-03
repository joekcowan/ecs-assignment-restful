<?php
include '../config/config.php';

/**
 * Gets orders items and customer details from firebase for a specific order.
 * @param {string} $orderNo - the order number to get items from.
 * @return {array} $user - returns the user data if any in an array of assoc arrays.
 */
function getOrderDetails($orderNo)
{
  // Fetch order items
  $orderItems = fetchFirebaseData('order-items');
  // Fetch order data to get cust_name and cust_abbr
  $orders = fetchFirebaseData('orders');

  $orderDetails = [];

  // Find the relevant order based on order_no
  $orderInfo = null;
  foreach ($orders as $order) {
    if ($order['order_no'] === $orderNo) {
      $orderInfo = $order;
      break;
    }
  }

  if ($orderInfo === null) {
    return null; // No matching order found
  }

  // Find order items associated with the given order_no
  foreach ($orderItems as $item) {
    if ($item['order_no'] === $orderNo) {
      $item['cust_name'] = $orderInfo['cust_name'];
      $item['cust_abbr'] = $orderInfo['cust_abbr'];
      $orderDetails[] = $item;
    }
  }

  return $orderDetails;
}

/**
 * Gets orders from firebase for a specific user.
 * @param {string} $userId - the user id to search orders by.
 * @param {string} $password - the username password to search for.
 * @return {array} $user - returns the user data if any in an array of assoc arrays.
 */
function getOrdersByUserId($userId)
{
  $orders = fetchFirebaseData('orders');
  $userOrders = [];
  foreach ($orders as $order) {
    if ($order['user_id'] === $userId) {
      $userOrders[] = $order;
    }
  }

  return $userOrders;
}

/**
 * Gets users from firebase by username and password.
 * @param {string} $username - the username to search for.
 * @param {string} $password - the username password to search for.
 * @return {array | null} $user - returns the user data in an assoc array if present | returns null if no user matches.
 */
function getUser($username, $password)
{
  $users = fetchFirebaseData('users'); // Assuming your user data is stored under 'users'

  foreach ($users as $user) {
    if ($user['username'] === $username && $user['password'] === $password) {
      return $user;
    }
  }

  return null;
}

/**
 * Fetches data from firebase real time database.
 * @param {string} $resource - the resource to fetch.
 * @return {array} $data - returns the data.
 */
function fetchFirebaseData($resource)
{
  $url = FIREBASE_URL . $resource . '.json';

  $options = [
    'http' => [
      'method'  => 'GET',
      'header'  => 'Accept: application/json',
    ],
  ];

  $context  = stream_context_create($options);
  $response = file_get_contents($url, false, $context);

  if ($response === FALSE) {
    throw new Exception('Error fetching data from Firebase.');
  }

  $data = json_decode($response, true);

  return $data;
}