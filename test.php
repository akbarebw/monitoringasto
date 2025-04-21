<?php
$result = file_put_contents('test_debug_log.txt', "This is a test log\n", FILE_APPEND);
echo $result ? 'Log Created' : 'Failed to create log';
?>

<html>
<table border="1">
    <tr valign="middle">
        <th style="width:5%;" rowspan="2">NO</th>
        <th colspan="2">OVERHAUL COMPONENT</th>
        <th rowspan="2">REMOVE FROM</th>
        <th rowspan="2">DATE REMOVE</th>
        <th rowspan="2">SN/PN</th>
        <th rowspan="2">DATE INSTALL</th>
        <th rowspan="2">INSTALL TO</th>
        <th rowspan="2">HOUR METER</th>
        <th rowspan="2">MAN POWER OF OVH</th>
        <th rowspan="2">MAN POWER OF INSTALL</th>
        <th rowspan="2">REMAKS</th>
        <th rowspan="2">STATUS</th>
        <th rowspan="2" colspan="3" style="width:10%;">AKSI</th>
    </tr>
    <tr valign="middle">
        <th>EGI</th>
        <th>TYPE COMPONENT</th>
    </tr>
    <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>7</td>
        <td>8</td>
        <td>9</td>
        <td>10</td>
        <td>11</td>
        <td>12</td>
        <td>13</td>
        <td>14</td>
    </tr>
</table>
</html>
