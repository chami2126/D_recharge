<?php
if(isset($_POST['submit'])) {
    $req = ['phone'=>$_POST['phone'], 'amount'=>$_POST['amount'], 'status'=>'pending', 'time'=>date('Y-m-d H:i:s')];
    $data = file_exists('requests.json') ? json_decode(file_get_contents('requests.json'), true) : [];
    $data[] = $req;
    file_put_contents('requests.json', json_encode($data));
    echo "Request sent! Admin will approve soon.";
}
?>
<form method="post">
Phone: <input name="phone" required><br>
Amount: <input name="amount" type="number" required><br>
<button name="submit">Send Request</button>
</form>
