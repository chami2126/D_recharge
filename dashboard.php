<?php
session_start();
$admin_user = "admin";
$admin_pass = "admin123"; // ඕන password එකක් දාගනින්

if(!isset($_SESSION['admin'])) {
    if(isset($_POST['login'])) {
        if($_POST['user']==$admin_user && $_POST['pass']==$admin_pass) {
            $_SESSION['admin'] = true;
        } else {
            $error = "Wrong password!";
        }
    }
    echo '<form method="post"><input name="user" placeholder="Username"><br>
    <input name="pass" type="password" placeholder="Password"><br>
    <button name="login">Login</button><br>'.$error.'</form>';
    exit;
}

// Approve button click උනාම
if(isset($_GET['approve'])) {
    $data = json_decode(file_get_contents('requests.json'), true);
    $data[$_GET['approve']]['status'] = 'approved';
    file_put_contents('requests.json', json_encode($data));
    header('Location: dashboard.php');
}

// Requests පෙන්නවා
$requests = file_exists('requests.json') ? json_decode(file_get_contents('requests.json'), true) : [];
echo '<h2>Recharge Requests</h2><table border="1">';
echo '<tr><th>Phone</th><th>Amount</th><th>Status</th><th>Action</th></tr>';
foreach($requests as $id => $r) {
    echo "<tr><td>{$r['phone']}</td><td>Rs {$r['amount']}</td><td>{$r['status']}</td>";
    if($r['status']=='pending') echo "<td><a href='?approve=$id'>Approve</a></td>";
    echo "</tr>";
}
echo '</table>';
?>
