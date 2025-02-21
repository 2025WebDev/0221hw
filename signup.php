<?php

$bg_color = "#0ab3fd";
$text_color = "#ffffff";

function gender_to_text($gender)
{
    switch ($gender)
    {
        case "male":
            return "先生";
        case "female":
            return "小姐";
        default:
            return "";
    }
}

$plans = array(
    array("行程A", "迎新活動行程A", 500),
    array("行程B", "迎新活動行程B", 700),
    array("行程C", "迎新活動行程C", 1000),
);

$is_submission = $_SERVER["REQUEST_METHOD"] === "POST" &&
                 isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["gender"]) && (isset($_POST["plan"]) && intval($_POST["plan"]) >= 0 && intval($_POST["plan"]) < count($plans));

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>迎新活動行程與報名表</title>
<script>
<?php
if ($is_submission)
{
    $gender_text = gender_to_text($_POST["gender"]);
    $plan_text = $plans[intval($_POST["plan"])][0];
    echo "alert(\"{$_POST["name"]} {$gender_text} 您已成功報名「{$plan_text}」！\\n行前須知及繳費資訊會以簡訊及電子郵件通知您！\\n\\n您的手機號碼：{$_POST["phone"]}\\n您的電子郵件：{$_POST["email"]}\");\n";
}
?>
</script>
<style>
a:link, a:visited {
  color: <?php echo $text_color; ?>;
}
table, th, td {
  border: 1px solid white;
  border-collapse: collapse;
  font-size: 30px;
  color: <?php echo $text_color; ?>;
</style>
</head>
<body bgcolor="<?php echo $bg_color; ?>"><font face="微軟正黑體" size="4" color="<?php echo $text_color; ?>">
<h1>迎新活動行程與報名表</h1>
<hr color="yellow"><br>

<table>
  <tr>
    <th>行程</th>
    <th>簡介</th>
    <th>價格</th>
  </tr>
<?php for ($i = 0; $i < count($plans[0]); $i++) { ?>
  <tr>
<?php for ($j = 0; $j < count($plans); $j++) { ?>
    <td align="<?php echo $j === 2 ? "right" : "left"; ?>"><?php echo $plans[$i][$j]; ?></td>
<?php } ?>
  </tr>
<?php } ?>
</table>

<h2>填寫下方表單立即報名！</h2>
<form action="" method="POST">
<label for="name">真實姓名：</label>
<input type="text" id="name" name="name" required>
<br>
<label for="phone">手機號碼：</label>
<input type="text" id="phone" name="phone" required>
<br>
<label for="email">電子郵件：</label>
<input type="email" id="email" name="email" required>
<br>
性別：
<label for="male">男</label>
<input type="radio" id="male" name="gender" value="male" required>
&nbsp;&nbsp;
<label for="female">女</label>
<input type="radio" id="female" name="gender" value="female" required>
<br>
<label for="plan">行程：</label>
<select id="plan" name="plan">
<?php for ($i = 0; $i < count($plans); $i++) { ?>
<option value="<?php echo $i; ?>"><?php echo $plans[$i][0]; ?></option>
<?php } ?>
</select>
<br>
<input type="submit" value="報名">
<input type="reset" value="清除">
</form>
<br><a href="index.php">回首頁</a>
</font></body>
</html>