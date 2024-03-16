<?php
function get_user_bets(int $id, mysqli $conn): array
{
    $sql = "
    SELECT id_bet FROM usersbets WHERE id_user = $id;
    ";
    $res = $conn->query($sql);
    $return_array = array();
    $i = 0;
    while ($row = $res->fetch_assoc()) {
        $return_array[$i] = $row["id_bet"];
        $i++;
    }
    return $return_array;
}

function existUserLogin($username,$password,$conn): bool
{
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $query = $conn->prepare($sql);
    $query->bind_param("ss", $username,$password);
    $query->execute();
    $result = $query->get_result();

    if (mysqli_num_rows($result))
    {
        return true;
    }
    return false;
}
function getUserIdByUsername($username,$conn):int
{
    $sql = "SELECT * FROM users WHERE username = ?";
    $query = $conn->prepare($sql);
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $row['id'];
}

function getMinPointsValue($conn):int
{
    $sql = "SELECT * FROM const WHERE id = 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['min_points'];
}
function getMaxPointsValue($conn):int
{

    $sql = "SELECT * FROM const WHERE id = 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['max_points'];
}
function insertBet($description,$points,$id_creator,$conn):bool
{
    $sql = "INSERT INTO bets (description,points,id_creator)
            VALUES 
            ('$description','$points','$id_creator')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {

        return false;
    }
}