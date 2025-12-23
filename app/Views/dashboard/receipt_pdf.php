<!-- receipt_view.php -->
<!DOCTYPE html>
<html lang="te">
<head>
<meta charset="UTF-8">
<title>భూమి పన్ను రశీదు</title>

<style>
body {
    font-family: "Noto Sans Telugu", "Lohit Telugu", sans-serif;
    margin: 30px;
}
.receipt {
    border: 1px solid #000;
    padding: 20px;
}
h2 {
    text-align: center;
}
.print-btn {
    margin-top: 20px;
}
@media print {
    .print-btn { display:none; }
}
</style>
</head>
<body>

<div class="receipt">
<h2>భూమి పన్ను చెల్లింపు రశీదు</h2>

<p>ఖాతా నెం : <?= esc($r['khata_no']) ?></p>
<p>పట్టాదారు పేరు : <?= esc($r['pattadar_name']) ?></p>
<p>సర్వే నెం : <?= esc($r['old_survey_no']) ?></p>
<p>విస్తీర్ణం : <?= esc($r['lp_extent']) ?></p>
<p>చెల్లించిన మొత్తం : ₹ <?= esc($r['pay_amount']) ?></p>
<p>చెల్లించిన తేదీ : <?= date('d-m-Y') ?></p>

<p style="margin-top:30px;">
ఇది కంప్యూటర్ ద్వారా తయారైన రశీదు. సంతకం అవసరం లేదు.
</p>
</div>

<button onclick="window.print()" class="print-btn">
    ప్రింట్ చేయండి
</button>

</body>
</html>
