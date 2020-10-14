<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
    body{
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
    }
    .header{
      font-family: Arial, Helvetica, sans-serif;
      font-size: 36px;
      color: #3b3b3b;
      text-align:center;
    }
    .footer{
      font-family: Arial, Helvetica, sans-serif;
      font-size: 10px;
    }
    </style>
  </head>
  <body>
  <img src="../public/duncan_logo_low.png" width="350px" style="float:right" >
            <br><br><br><br><br><br><br><br><br>
            <div align="right">
            Duncan Robert Morris <br>
            Hauptstraße 14 <br>
            88167 Maierhöfen <br>
            Deutschland <br>
            <br>
            Tax ID: DE321597040</td>
    </div>

    <h1 class="header">Purchase Invoice</h1>

@foreach($invoice as $i)

{{ $i->company}} <br>
{{ $i->address}} <br>
{{ $i->town}} <br>
{{ $i->county}} <br>
{{ $i->postcode}} <br>
{{ $i->country}} <br>
<br>
Tax ID: {{ $i->vat_no}}
<br><br>

<br><hr><br>

<table width="100%">
<thead>
<tr>
<th align="center">QTY</th>
<th>Description</th>
<th align="right">Unit Price</th>
<th align="right">Net Total</th>
<th align="right">Tax</th>
<th align="right">Gross Total</th>
</tr>
<thead>
<tbody>
@foreach($lines as $ln)
<tr>
<td align="center">{{$ln->qty}}</td>
<td>{{$ln->description}}</td>
<td align="right">{{$ln->line_price}}</td>
<td align="right">{{$ln->line_net}}</td>
<td align="right">{{$ln->line_tax}}</td>
<td align="right">{{$ln->line_total}}</td>
</tr>
@endforeach
</tbody>
</table>

<br>
<br>
<h5>Notes</h5>



<br>
<br>

<table width="100%">
<tr>
<td width="50%">
&nbsp;
</td>
<td align="right">
<b>Net Total: {{ $i->net_total}}</b> <br>
<b>Tax Total: {{ $i->tax_total}}</b> <br>
<b>Grand Total: {{ $i->grand_total}}</b>
</td>
</tr>
</table>
 @endforeach 

 <br><hr>

<table width="100%">
<tr>
<td width="30%" align="center">
<p class="footer">d.morris@drmorris-itservices.de <br>
Tel: +49 (0)1520 2709055</p>
</td>
<td align="center">
<p class="footer">www.drmorris-itservices.de</p>
</td>
<td align="right">
<p class="footer">Duncan R Morris <br>
Hauptstraße 14 <br>
88167 Maierhöfen <br>
Deutschland</p>
</td>
</tr>
</table>
</body>
</html>