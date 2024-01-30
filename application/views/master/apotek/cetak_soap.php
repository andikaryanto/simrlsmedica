<html>
<body onload="window.print()">
<div style="text-align: center; width: 380px;">
    <strong style="font-size: 20px"><u><?=$klinik->nama?></u></strong><br>
    <small><?=$klinik->alamat?></small><br>
    <small><?=$klinik->telepon?></small><br>
    <hr style="width: 380px;">
    <strong style="font-size: 20px"><u>SOAP APOTEKER</u></strong><br>
</div>
<div style="width: 380px;">
    <br>
    <b>Subjective</b>
    <p><?=$soap->subjective?></p>
    <b>Objective</b>
    <p><?=$soap->objective?></p>
    <b>Assessment</b>
    <p><?=$soap->analysis?></p>
    <b>Planning</b>
    <p><?=$soap->planning?></p>
</div>
</body>
</html>