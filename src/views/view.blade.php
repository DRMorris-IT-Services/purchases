@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'purchases'
])

@section('content')
@foreach ($purchases as $inv)

    <div class="content">
        @include('purchases::layouts.alerts')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" href="{{route('purchases')}}" role="tab" aria-controls="home" aria-selected="true">List</a>
  </li>
  @if (AUTH::user()->purchases_edit == "on")
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" href="{{route('purchases.edit',['id' => $inv->invoice_id])}}" role="tab" aria-controls="profile" aria-selected="false">Edit</a>
  </li>
  @endif
</ul>
    
        <div class="row">
            
            <div class="col-md-12 text-white">
                
                        <h2>Purchase Invoice - Ref: {{$inv->invoice_ref}}</h2>
                   
            </div>
        </div>
        
        <div class="row">

        
        <div class="col-md-4 text-white">
                
                        <h5>Supplier</h5>
                    
                        @foreach ($supplier as $c) 
                        {{ $c->company }} <br>
                        {{ $c->address }} <br>
                        {{ $c->town }} <br>
                        {{ $c->county }} <br>
                        {{ $c->postcode }} <br>
                        {{ $c->country }} <br>
                        <br>
                        Tax ID: {{ $c->vat_no }}
                        <br>
                        @endforeach
                        

                        <br><br>
                        <h6>Purchase Reference: {{$inv->invoice_ref}}</h6>

                   
            </div>

        <div class="col-md-4 text-white">
                
                        <h5 >Dates</h5>
                        
                    
                        <h6>Purchase Date: {{ date('d/m/y', strtotime($inv->invoice_date)) }}</h6>
                        <h6>Purchase Due: {{ date('d/m/y', strtotime($inv->invoice_due)) }}</h6>
                        <h6>Created On: {{ date('d/m/y H:i', strtotime($inv->created_at)) }}</h6>
                        <h6>Updated On: {{ date('d/m/y H:i', strtotime($inv->updated_at)) }}</h6>
                        
                   
            </div>

            <div class="col-md-4 text-white">
               
                        <h5 class="card-title">Status</h5>
                        
                 

                        <h6>{{ $inv->status}}</h6>
                        
                  
            </div>

        </div>

        <br><br>
        <div class="row">
        <div class="col-md-12 text-white">
               
                        <h5>Purchase Items</h5>
                        
                   

                        <table class="table">
                            <thead>
                        <tr>
                        <th>Qty</th>
                        <th>Description</th>
                        <th>Unit Price</th>
                        <th>Net Total</th>
                        <th>Tax </th>
                        <th>Tax Exempt</th>
                        <th>Gross Total</th>
                        </tr>
                            </thead>
                            <tbody>
                            @foreach ($purchases_lines as $ln)
                            
                            <tr>
                            <td width="100px">{{$ln->qty}}</td>
                            <td>{{$ln->description}}</td>
                            <td width="150px">{{$ln->line_price}}</td>
                            <td width="150px">{{$ln->line_net}}</td>
                            <td width="150px">{{$ln->line_tax}}</td>
                            <td width="80px">@if($ln->line_tax_exempt == "on") Yes @else No @endif</td>
                            <td width="150px">{{$ln->line_total}}</td>
                            </tr>
                            
                            @endforeach
                            </tbody>
                        </table>
                        
                        
                    
            </div>

        </div>

        <br><br>
        <div class="row justify-content-end">
            <div class="col-md-3 text-white">
                
                        <h5>Totals</h5>
                        
                   

                        <h6>Total Net: {{ number_format($inv->net_total,2,',','.')}}&euro;</h6>
                        <h6>Total Tax: {{ number_format($inv->tax_total,2,',','.')}}&euro;</h6>
                        <h6>Grand Total: {{ number_format($inv->grand_total,2,',','.')}}&euro;</h6>
                        
                    
            </div>
        </div>

</div>

@endforeach
@endsection

