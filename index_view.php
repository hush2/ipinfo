<!doctype html>
<html>

<head>
  <title>hushywushy</title>
  <link rel='stylesheet' type='text/css' href='css/style.css'>
</head>

<body>
    <form action='/' method='get'>
    <p><label>Check IP:</label><input type='text' name='host'><input type='submit' value='Go'><p>
    </form>
    <h2>Your IP</h2>

    <p><label>IP:</label><span class='ip'><?= $ip ?></span></p>
    <p><label>Country:</label><?= $country_name ?>&nbsp;&nbsp;
    <?php if ($country_name !== $na): ?>
        <img src='images/<?= strtolower($country_code) ?>.png'>
    <?php endif ?>
    </p>
    <p><label>Country Code:</label><?= $country_code ?></p>
    <p><label>Organization/ISP:</label><?= $org ?><?php if (!empty($isp)) echo " ($isp)" ?></p>
    <p><label>Area Code:</label><?= $area_code ?></p>
    <p><label>City:</label><?= $city ?></p>
    <p><label>Region:</label><?= $region ?></p>
    <p><label>Continental Code:</label><?= $cont_code ?></p>
    <p><label>Latitude</label><?= $lat ?></p>
    <p><label>Longitude</label><?= $long ?></p>

    <?php if (!isset($_GET['host'])): ?>
        <h2>Your Request Headers</h2>
        <table>
        <?php foreach($headers as $key => $val): ?>
            <tr><td class='key'><?= $key ?></td><td><?= $val ?></tr>
        <?php endforeach ?>
        </table>
    <?php endif ?>

</body>

</html>
