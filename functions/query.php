<?php
    require_once 'useragent.php';
    function query($sql, $params = [], $types = "") {
        global $conn;
        $stmt = $conn->prepare($sql);

        if ($params && $types) {
            $stmt->bind_param($types, ...$params);
        }

        $success = $stmt->execute();

        if (stripos(trim($sql), "SELECT") === 0) {
            $result = $stmt->get_result();
            $query = $result->num_rows === 1 ? $result->fetch_assoc() : $result->fetch_all(MYSQLI_ASSOC);
        } elseif (stripos(trim($sql), "INSERT") === 0) {
            $query = $conn->insert_id;
        } else {
            $query = $stmt->affected_rows;
        }

        $stmt->close();
        return $query;
    }
?>